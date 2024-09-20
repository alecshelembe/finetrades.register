<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OcrController;

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

// Named GET route

Route::get('/register', [UserController::class, 'create'])->name('users.create');
Route::post('/register-user', [UserController::class, 'store'])->name('users.store');
// Route::match(['get', 'post'], '/register-user', [UserController::class, 'register']);

Route::get('/', [LoginController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login-user', [LoginController::class, 'login'])->name('users.the.login');
Route::get('/logout-user', [LoginController::class, 'logout'])->name('users.logout');

// Route::post('/login', [LoginController::class, 'login']);

Route::get('/create', [CreateController::class, 'create'])->name('create.post');
// Route::get('/create', [CreateController::class, 'create'])->name('show.upload.form');

Route::post('/process-image', [CreateController::class, 'processImage'])->name('process.image');

Route::get('/create-post', [CreateController::class, 'showPostForm'])->name('create.raw.post');
Route::post('/create-post', [CreateController::class, 'savePost'])->name('save.raw.post');