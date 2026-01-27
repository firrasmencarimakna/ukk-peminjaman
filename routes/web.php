<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('tools', \App\Http\Controllers\ToolController::class);
    Route::get('/logs', [\App\Http\Controllers\ActivityLogController::class, 'index'])->name('logs.index');

    // Admin Loan Management
    Route::get('/loans', [\App\Http\Controllers\LoanController::class, 'adminIndex'])->name('loans.index');
    Route::post('/loans/{loan}/approve', [\App\Http\Controllers\LoanController::class, 'approve'])->name('loans.approve');
    Route::post('/loans/{loan}/reject', [\App\Http\Controllers\LoanController::class, 'reject'])->name('loans.reject');
    Route::post('/loans/{loan}/return', [\App\Http\Controllers\LoanController::class, 'returnTool'])->name('loans.return');
});

// Petugas Routes
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    })->name('dashboard');
    
    Route::get('/loans', [\App\Http\Controllers\LoanController::class, 'index'])->name('loans.index');
    Route::get('/report', [\App\Http\Controllers\LoanController::class, 'report'])->name('report');
    Route::post('/loans/{loan}/approve', [\App\Http\Controllers\LoanController::class, 'approve'])->name('loans.approve');
    Route::post('/loans/{loan}/reject', [\App\Http\Controllers\LoanController::class, 'reject'])->name('loans.reject');
    Route::post('/loans/{loan}/return', [\App\Http\Controllers\LoanController::class, 'returnTool'])->name('loans.return');
});

// Peminjam Routes
Route::middleware(['auth', 'role:peminjam'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', function () {
        return view('peminjam.dashboard');
    })->name('dashboard');

    Route::get('/tools', [\App\Http\Controllers\LoanController::class, 'catalog'])->name('tools.index');
    Route::post('/loans', [\App\Http\Controllers\LoanController::class, 'store'])->name('loans.store');
    Route::get('/my-loans', [\App\Http\Controllers\LoanController::class, 'myLoans'])->name('loans.index');
    Route::post('/loans/{loan}/return-request', [\App\Http\Controllers\LoanController::class, 'requestReturn'])->name('loans.return-request');
});
