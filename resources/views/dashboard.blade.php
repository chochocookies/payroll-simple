<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Data Payroll</h3>
                    @if($payroll)
                        <ul class="space-y-1">
                            <div class="flex gap-4 mt-4">
                                <a href="{{ route('payroll.print', $payroll->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Cetak Slip</a>
                                {{-- <form action="{{ route('payroll.sendEmail', $payroll->id) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Kirim Slip ke Email</button>
                                </form> --}}
                            </div>
                            <li><strong>Periode:</strong> {{ $payroll->periode }}</li>
                            <li><strong>Tunjangan Transport:</strong> Rp {{ number_format($payroll->tunjangan_transport, 0, ',', '.') }}</li>
                            <li><strong>Tunjangan Lain:</strong> Rp {{ number_format($payroll->tunjangan_lain, 0, ',', '.') }}</li>
                            <li><strong>Lembur:</strong> Rp {{ number_format($payroll->lembur, 0, ',', '.') }}</li>
                            <li><strong>Potongan Absensi:</strong> Rp {{ number_format($payroll->potongan_absensi, 0, ',', '.') }}</li>
                            <li><strong>Potongan Telat:</strong> Rp {{ number_format($payroll->potongan_telat, 0, ',', '.') }}</li>
                            <li><strong>Total Gaji:</strong> <span class="text-green-400 font-semibold">Rp {{ number_format($payroll->total_gaji, 0, ',', '.') }}</span></li>
                        </ul>
                    @else
                        <p class="text-red-400">Tidak ada data payroll untuk karyawan ini.</p>
                    @endif

                    <h3 class="text-lg font-bold mt-8 mb-2">Rekap Presensi</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Hadir</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Telat</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($attendances as $attendance)
                                <tr>
                                    <td class="px-6 py-4">{{ $attendance->date }}</td>
                                    <td class="px-6 py-4">{{ $attendance->present ? 'Ya' : 'Tidak' }}</td>
                                    <td class="px-6 py-4">{{ $attendance->late ? 'Ya' : 'Tidak' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h3 class="text-lg font-bold mt-8 mb-2">Tambah Lembur atau Telat</h3>
                    <form action="{{ route('payroll.overtime-late') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="overtime" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lembur (Rp):</label>
                            <input type="number" name="overtime" id="overtime" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 dark:bg-gray-900 dark:text-white" min="0">
                        </div>
                        <div>
                            <label for="late" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telat (Rp):</label>
                            <input type="number" name="late" id="late" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 dark:bg-gray-900 dark:text-white" min="0">
                        </div>
                        <button type="submit" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Simpan</button>
                    </form>

                    <h3 class="text-lg font-bold mt-8 mb-2">Kalender Jam Kerja</h3>
                    <div id="calendar" class="bg-white rounded shadow p-4 dark:bg-gray-900"></div>

                    <h3 class="text-lg font-bold mt-8 mb-2">Rekap Lembur dan Potongan</h3>
                    <ul class="space-y-1">
                        <li><strong>Total Lembur:</strong> Rp {{ number_format($totalOvertime, 0, ',', '.') }}</li>
                        <li><strong>Total Potongan:</strong> Rp {{ number_format($totalDeductions, 0, ',', '.') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- FullCalendar JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: {!! json_encode($attendances->map(function($attendance) {
                        return [
                            'title' => ($attendance->present ? 'Hadir' : 'Tidak Hadir') . ($attendance->late ? ' - Telat' : ''),
                            'start' => $attendance->date,
                            'color' => $attendance->present ? '#16a34a' : '#ef4444'
                        ];
                    })) !!},
                    height: 500,
                    locale: 'id',
                    editable: false,
                    eventClick: function(info) {
                        alert('Status: ' + info.event.title);
                    }
                });
                calendar.render();
            }
        });
    </script>
</x-app-layout>
