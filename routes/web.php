<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes untuk Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Routes untuk Konfirmasi Password
Route::middleware('auth')->group(function () {
    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);
});

// Route untuk Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Routes untuk Email Verification
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationPromptController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

// Routes untuk Reset Password
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// Routes yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    // Route untuk halaman beranda
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // CRUD Routes untuk kendaraan
    Route::prefix('vehicles')->group(function () {
        Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');
        Route::get('/data', [VehicleController::class, 'anyData'])->name('vehicles.data');
        Route::get('/create', [VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('/', [VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
        Route::put('/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
        Route::delete('/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
        Route::get('/ar', [ArController::class, 'index'])->name('ar');
        Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    });

    // Rute dinamis untuk berbagai level
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])
        ->name('third')
        ->where(['first' => '.*', 'second' => '.*', 'third' => '.*']); // Mengizinkan parameter apapun

    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])
        ->name('second')
        ->where(['first' => '.*', 'second' => '.*']); // Mengizinkan parameter apapun

    Route::get('{any}', [RoutingController::class, 'root'])
        ->name('any')
        ->where('any', '.*'); // Mengizinkan parameter apapun
});

// Route untuk halaman default
Route::get('/', [RoutingController::class, 'index'])->name('root');
