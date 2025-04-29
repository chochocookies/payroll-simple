@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Payroll</h1>
        <a href="{{ route('payrolls.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Slip Gaji
        </a>
    </div>

    <table class="min-w-full bg-white">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border-b">NIK</th>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Posisi</th>
                <th class="py-2 px-4 border-b">Gaji Pokok</th>
                <th class="py-2 px-4 border-b">Total Gaji</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payrolls as $payroll)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $payroll->nik }}</td>
                    <td class="py-2 px-4 border-b">{{ $payroll->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $payroll->position }}</td>
                    <td class="py-2 px-4 border-b">Rp{{ number_format($payroll->basic_salary, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border-b">Rp{{ number_format($payroll->total_salary, 0, ',', '.') }}</td>
                    <td class="py-2 px-4 border-b">
                        <!-- Aksi nanti: Lihat, Edit, Download PDF -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada data payroll.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
