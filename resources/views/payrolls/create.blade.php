<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Payroll') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('payroll.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="periode" class="block text-sm font-medium text-gray-700">Periode</label>
                            <input type="text" name="periode" id="periode" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="tunjangan_transport" class="block text-sm font-medium text-gray-700">Tunjangan Transport</label>
                            <input type="number" name="tunjangan_transport" id="tunjangan_transport" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="tunjangan_lain" class="block text-sm font-medium text-gray-700">Tunjangan Lain</label>
                            <input type="number" name="tunjangan_lain" id="tunjangan_lain" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="lembur" class="block text-sm font-medium text-gray-700">Lembur</label>
                            <input type="number" name="lembur" id="lembur" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="potongan_absensi" class="block text-sm font-medium text-gray-700">Potongan Absensi</label>
                            <input type="number" name="potongan_absensi" id="potongan_absensi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                        <div class="mb-4">
                            <label for="potongan_telat" class="block text-sm font-medium text-gray-700">Potongan Telat</label>
                            <input type="number" name="potongan_telat" id="potongan_telat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Payroll</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
