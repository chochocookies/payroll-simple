<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Halaman Register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Semua route yang butuh login
Route::middleware(['auth', 'verified'])->group(function () {
    // Halaman Dashboard
    Route::get('/dashboard', [PayrollController::class, 'index'])->name('dashboard'); // Menggunakan controller

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Payroll
    Route::get('/payrolls/create', [PayrollController::class, 'create'])->name('payrolls.create');
    Route::post('/payrolls', [PayrollController::class, 'store'])->name('payrolls.store');
    Route::delete('/payrolls/{id}', [PayrollController::class, 'destroy'])->name('payrolls.destroy');
    Route::post('/payroll/overtime-late', [PayrollController::class, 'storeOvertimeLate'])->name('payroll.overtime-late');
    Route::get('/payroll/print', [PayrollController::class, 'printSlip'])->name('payroll.print');
    Route::post('/payroll/send', [PayrollController::class, 'sendSlipEmail'])->name('payroll.send');
    //cetak payroll
    Route::get('/payroll/cetak', [PayrollController::class, 'cetak'])->name('payroll.cetak');

});

// Route untuk membuat payroll baru
Route::get('/payroll/create', [PayrollController::class, 'create'])->name('payroll.create'); // Ini bisa dihapus jika sudah ada di atas
Route::post('/payroll', [PayrollController::class, 'store'])->name('payroll.store'); // Ini bisa dihapus jika sudah ada di atas

require __DIR__.'/auth.php';
