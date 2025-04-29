<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Slip Gaji - {{ $payroll->periode }}</title>
    <style>
        body { font-family: sans-serif; }
        h2 { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 8px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <h2>Slip Gaji - Periode {{ $payroll->periode }}</h2>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <table>
        <tr><th>Komponen</th><th>Jumlah</th></tr>
        <tr><td>Gaji Pokok</td><td>Rp {{ number_format($user->gaji_pokok, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Transport</td><td>Rp {{ number_format($payroll->tunjangan_transport, 0, ',', '.') }}</td></tr>
        <tr><td>Tunjangan Lain</td><td>Rp {{ number_format($payroll->tunjangan_lain, 0, ',', '.') }}</td></tr>
        <tr><td>Lembur</td><td>Rp {{ number_format($payroll->lembur, 0, ',', '.') }}</td></tr>
        <tr><td>Potongan Absensi</td><td>Rp {{ number_format($payroll->potongan_absensi, 0, ',', '.') }}</td></tr>
        <tr><td>Potongan Telat</td><td>Rp {{ number_format($payroll->potongan_telat, 0, ',', '.') }}</td></tr>
        <tr><th>Total Gaji</th><th>Rp {{ number_format($payroll->total_gaji, 0, ',', '.') }}</th></tr>
    </table>
</body>
</html>
