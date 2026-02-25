<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AlumniImportController;
use App\Http\Controllers\RoleManageController;

Route::get('/', fn () => redirect()->route('login'));
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware('role:admin,canbokhoa,cuusinh')->group(function () {
        Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
        Route::get('/alumni/{alumni}', [AlumniController::class, 'show'])->name('alumni.show');
    });
    Route::middleware('role:admin,canbokhoa')->group(function () {
        Route::get('/alumni/create', [AlumniController::class, 'create'])->name('alumni.create');
        Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');

        Route::get('/alumni/{alumni}/edit', [AlumniController::class, 'edit'])->name('alumni.edit');
        Route::put('/alumni/{alumni}', [AlumniController::class, 'update'])->name('alumni.update');

        Route::delete('/alumni/{alumni}', [AlumniController::class, 'destroy'])->name('alumni.destroy');
        Route::get('/alumni-import', [AlumniImportController::class, 'create'])->name('alumni.import.create');
        Route::post('/alumni-import', [AlumniImportController::class, 'store'])->name('alumni.import.store');
    });
    Route::middleware('role:admin')->group(function () {
        Route::get('/phan-quyen', [RoleManageController::class, 'index'])->name('roles.index');
        Route::put('/phan-quyen/{user}', [RoleManageController::class, 'update'])->name('roles.update');
    });
});