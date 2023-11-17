<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
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

Route::middleware('auth')->group( function () {
		Route::get('/profile', [UserController::class, 'profile'])->name('profile');
		Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
		Route::get('/add_record', [RecordController::class, 'add_record'])->name('add_record');
		Route::post('/record', [RecordController::class,'store'])->name('add_record_process');
	});

Route::middleware('guest')->group( function () {
	Route::get('/login', [AuthController::class, 'login_page'])->name('login');
	Route::post('/login', [AuthController::class, 'login'])->name('login_process');
	Route::get('/register', [AuthController::class, 'register_page'])->name('register');
	Route::post('/register', [AuthController::class, 'register'])->name('register_process');
});



Route::get('/', [CommonController::class, 'index']);
Route::get('/all_records', [RecordController::class, 'all_records']);
Route::get('/record/{id}', [RecordController::class, 'record']);

Route::get('/user/{id}', [UserController::class, 'get']);
