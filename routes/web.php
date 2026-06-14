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

    // KELOMPOK DATA MASTER (KAPRODI, TU, & MANAGER)
    Route::middleware(['role:kaprodi,tu,manager'])->group(function () {
        
        // --- SUB-MODUL: MANAJEMEN DATA MAHASISWA ---
        Route::get('/users/students', [SubmissionController::class, 'viewStudents'])->name('users.students');
        Route::get('/users/students/create', [SubmissionController::class, 'createStudent'])->name('users.students.create');
        Route::post('/users/students/store', [SubmissionController::class, 'storeStudent'])->name('users.storeStudent'); // Tetap users.storeStudent agar sinkron dengan form lama
        Route::get('/users/students/{user}/edit', [SubmissionController::class, 'editStudent'])->name('users.students.edit');
        Route::put('/users/students/{user}', [SubmissionController::class, 'updateStudent'])->name('users.students.update');
        Route::delete('/users/students/{user}', [SubmissionController::class, 'destroyStudent'])->name('users.students.destroy');

        // --- SUB-MODUL: MANAJEMEN DATA STAF (DOSEN & TU) ---
        Route::get('/users/staff', [SubmissionController::class, 'viewStaff'])->name('users.staff');
        Route::get('/users/staff/create', [SubmissionController::class, 'createStaff'])->name('users.staff.create');
        Route::post('/users/staff/store', [SubmissionController::class, 'storeStaff'])->name('users.staff.store');
        Route::get('/users/staff/{user}/edit', [SubmissionController::class, 'editStaff'])->name('users.staff.edit');
        Route::put('/users/staff/{user}', [SubmissionController::class, 'updateStaff'])->name('users.staff.update');
        Route::delete('/users/staff/{user}', [SubmissionController::class, 'destroyStaff'])->name('users.staff.destroy');
        
    });

    // PROFIL AKUN (BAWAAN BREEZE)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';