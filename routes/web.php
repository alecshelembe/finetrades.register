<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('/', function () {
    return view('login');
})->name('users.login');

Route::get('/register', [UserController::class, 'create'])->name('users.create');
Route::post('/register-user', [UserController::class, 'store'])->name('users.store');
// Route::match(['get', 'post'], '/register-user', [UserController::class, 'register']);