<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payroll;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PayrollController extends Controller
{
    // Menampilkan data payroll terakhir untuk karyawan
    public function index()
    {
        $user = Auth::user();

        $payroll = Payroll::where('user_id', $user->id)->latest()->first();

        $attendances = Attendance::where('user_id', $user->id)
            ->whereMonth('date', now()->month)
            ->get();

        $overtimeAndDeductions = $this->calculateOvertimeAndDeductions($attendances);

        return view('dashboard', [
            'payroll' => $payroll,
            'attendances' => $attendances,
            'totalOvertime' => $overtimeAndDeductions['overtime'],
            'totalDeductions' => $overtimeAndDeductions['deductions'],
        ]);
    }

    // Menampilkan form untuk menambahkan payroll baru
    public function create()
    {
        return view('payroll.create');
    }

    // Menyimpan payroll baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'periode' => 'required|string|max:255',
            'tunjangan_transport' => 'nullable|integer',
            'tunjangan_lain' => 'nullable|integer',
            'lembur' => 'nullable|integer',
            'potongan_absensi' => 'nullable|integer',
            'potongan_telat' => 'nullable|integer',
        ]);

        $user = Auth::user();

        $payroll = Payroll::create([
            'user_id' => $user->id,
            'periode' => $request->periode,
            'tunjangan_transport' => $request->tunjangan_transport ?? 0,
            'tunjangan_lain' => $request->tunjangan_lain ?? 0,
            'lembur' => $request->lembur ?? 0,
            'potongan_absensi' => $request->potongan_absensi ?? 0,
            'potongan_telat' => $request->potongan_telat ?? 0,
            'total_gaji' => ($request->tunjangan_transport ?? 0) +
                            ($request->tunjangan_lain ?? 0) +
                            ($request->lembur ?? 0) -
                            ($request->potongan_absensi ?? 0) -
                            ($request->potongan_telat ?? 0),
        ]);

        return redirect()->route('dashboard')->with('success', 'Payroll berhasil ditambahkan.');
    }

    // Menghapus payroll berdasarkan ID
    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->delete();

        return redirect()->route('dashboard')->with('success', 'Payroll berhasil dihapus.');
    }

    // Menyimpan data lembur dan telat lalu hitung ulang gaji
    public function saveOvertimeAndLate(Request $request)
    {
        $request->validate([
            'overtime' => 'nullable|integer',
            'late' => 'nullable|integer',
        ]);

        $user = Auth::user();
        $payroll = Payroll::where('user_id', $user->id)->latest()->first();

        if ($payroll) {
            $lembur = $request->overtime ?? 0;
            $telat = $request->late ?? 0;

            $payroll->lembur = $lembur;
            $payroll->potongan_telat = $telat;

            $payroll->total_gaji = $this->calculateTotalGajiFromModel($payroll);
            $payroll->save();
        }

        return redirect()->route('dashboard')->with('success', 'Data lembur dan telat berhasil diperbarui.');
    }

    // Menghitung total gaji dari model payroll
    private function calculateTotalGajiFromModel(Payroll $payroll)
    {
        return ($payroll->tunjangan_transport ?? 0) +
               ($payroll->tunjangan_lain ?? 0) +
               ($payroll->lembur ?? 0) -
               ($payroll->potongan_absensi ?? 0) -
               ($payroll->potongan_telat ?? 0);
    }

    // Cetak dan kirim PDF slip gaji ke email
    // Method untuk cetak slip sebagai PDF (akses via route)
public function printSlip($id)
{
    $payroll = Payroll::with('user')->findOrFail($id);
    $user = $payroll->user;

    $pdf = Pdf::loadView('pdf.payroll', compact('payroll', 'user'));

    return $pdf->download('slip-gaji-' . $user->name . '.pdf');
}


public function sendSlipEmail($id)
{
    $payroll = Payroll::findOrFail($id);
    $user = User::findOrFail($payroll->user_id); // ambil email user dari payroll

    // Generate PDF dari view
    $pdf = Pdf::loadView('pdf.payroll', compact('user', 'payroll'));

    // Kirim email ke user
    Mail::send([], [], function ($message) use ($pdf, $user, $payroll) {
        $message->to($user->email)
                ->subject('Slip Gaji - ' . $payroll->periode)
                ->attachData($pdf->output(), 'slip-gaji.pdf');
    });

    return back()->with('success', 'Slip gaji berhasil dikirim ke email: ' . $user->email);
}

    // Menghitung total lembur dan potongan dari presensi
    private function calculateOvertimeAndDeductions($attendances)
    {
        $overtime = 0;
        $deductions = 0;

        foreach ($attendances as $attendance) {
            $normalHours = 8;
            $workedHours = $attendance->worked_hours ?? 0;
            $isLate = $attendance->late ?? false;

            if ($workedHours > $normalHours) {
                $overtime += ($workedHours - $normalHours);
            }

            if ($isLate) {
                $deductions += 1;
            }
        }

        return [
            'overtime' => $overtime,
            'deductions' => $deductions
        ];
    }
}
