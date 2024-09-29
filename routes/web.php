<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\OcrController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;

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


Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Named GET route

Route::get('/register', [UserController::class, 'create'])->name('users.create');
Route::post('/register-user', [UserController::class, 'store'])->name('users.store');
// Route::match(['get', 'post'], '/register-user', [UserController::class, 'register']);

Route::get('/', [LoginController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/QrCodeLogin', [LoginController::class, 'showLoginFormQrCode'])->name('login.qrcode');

Route::post('/login-user', [LoginController::class, 'login'])->name('users.the.login');
Route::get('/logout-user', [LoginController::class, 'logout'])->name('users.logout');

// Route::post('/login', [LoginController::class, 'login']);

Route::get('/create', [CreateController::class, 'create'])->name('create.post');
// Route::get('/create', [CreateController::class, 'create'])->name('show.upload.form');

Route::post('/process-image', [CreateController::class, 'processImage'])->name('process.image');

Route::get('/create-post', [CreateController::class, 'showPostForm'])->name('create.raw.post');
Route::post('/create-post', [CreateController::class, 'savePost'])->name('save.raw.post');

Route::get('/qr-login', [LoginController::class, 'qrLogin'])->name('qr.login');

// routes/web.php


Route::middleware('auth')->group(function () {
    Route::get('/sessions', [BookingController::class, 'index']); // Show available sessions
    Route::post('/bookings', [BookingController::class, 'store']); // Make a booking
    Route::get('/bookings', [BookingController::class, 'show']); // View user bookings
    Route::put('/bookings/{id}', [BookingController::class, 'update']); // Modify booking
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']); // Cancel booking
});

Route::get('/calendar/events', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('/calendar/create', [CalendarController::class, 'store'])->name('calendar.store');

Route::get('/oauth2callback', [CalendarController::class, 'handleOAuthCallback'])->name('handleOAuthCallback');