<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\Auth\LoginController;

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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('users.login');
Route::post('/home', [LoginController::class, 'login'])->name('users.loginStore');
Route::get('/home', [LoginController::class, 'login'])->name('users.loginStore');
Route::get('/logout-user', [LoginController::class, 'logout'])->name('users.logout');

// Route::post('/login', [LoginController::class, 'login']);

Route::get('/create', [CreateController::class, 'create'])->name('create.post');
