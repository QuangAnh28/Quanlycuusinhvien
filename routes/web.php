<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AlumniImportController;
use App\Http\Controllers\RoleManageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatsController;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login'));

// Public: xem danh sách + chi tiết sự kiện
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])
    ->whereNumber('id')
    ->name('events.show');

/*
|--------------------------------------------------------------------------
| Guest routes (chưa đăng nhập)
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| Auth routes (đã đăng nhập)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | UC2 - Hồ sơ (chỉ cuusinh)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:cuusinh')->group(function () {
        Route::get('/ho-so', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/ho-so', [ProfileController::class, 'update'])->name('profile.update');
    });

    /*
    |--------------------------------------------------------------------------
    | UC7 - Thống kê (admin + canbokhoa + cuusinh)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,canbokhoa,cuusinh')->group(function () {
        Route::get('/thong-ke', [StatsController::class, 'index'])->name('stats.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    */
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    /*
    |--------------------------------------------------------------------------
    | Events - đăng ký / hủy (cần đăng nhập)
    |--------------------------------------------------------------------------
    */
    Route::post('/events/{id}/register', [RegistrationController::class, 'store'])
        ->whereNumber('id')
        ->name('events.register');

    Route::post('/events/{id}/cancel', [RegistrationController::class, 'cancel'])
        ->whereNumber('id')
        ->name('events.cancel');

    /*
    |--------------------------------------------------------------------------
    | Events - CRUD (admin + canbokhoa)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin,canbokhoa')->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');

        Route::get('/events/{id}/edit', [EventController::class, 'edit'])
            ->whereNumber('id')
            ->name('events.edit');

        Route::put('/events/{id}', [EventController::class, 'update'])
            ->whereNumber('id')
            ->name('events.update');

        Route::delete('/events/{id}', [EventController::class, 'destroy'])
            ->whereNumber('id')
            ->name('events.destroy');

        Route::patch('/events/{id}/toggle', [EventController::class, 'toggleStatus'])
            ->whereNumber('id')
            ->name('events.toggle');
    });

    /*
    |--------------------------------------------------------------------------
    | Alumni
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | Phân quyền
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::get('/phan-quyen', [RoleManageController::class, 'index'])->name('roles.index');
        Route::put('/phan-quyen/{user}', [RoleManageController::class, 'update'])->name('roles.update');
    });
});