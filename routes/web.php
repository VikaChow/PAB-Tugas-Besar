<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [SubmissionController::class, 'index'])->name('dashboard');

    // KELOMPOK FITUR MAHASISWA
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/submissions/create', [SubmissionController::class, 'create'])->name('submissions.create');
        Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');
        Route::get('/submissions/{submission}/download', [SubmissionController::class, 'download'])->name('submissions.download');
    });

    // KELOMPOK FITUR KETUA PROGRAM STUDI (KAPRODI)
    Route::middleware(['role:kaprodi'])->group(function () {
        Route::post('/submissions/{submission}/approve', [SubmissionController::class, 'approve'])->name('submissions.approve');
        Route::post('/submissions/{submission}/reject', [SubmissionController::class, 'reject'])->name('submissions.reject');
    });

    // KELOMPOK FITUR TATA USAHA (TU) ATAU MANAGER
    Route::middleware(['role:tu,manager'])->group(function () {
        Route::post('/submissions/{submission}/upload', [SubmissionController::class, 'uploadFile'])->name('submissions.upload');
    });

    // PROFIL AKUN (BAWAAN BREEZE)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';