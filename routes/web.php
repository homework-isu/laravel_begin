<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CommentController;
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
	Route::get('/update_record/{id}', [RecordController::class, 'update_record'])->name('update_record');
	Route::post('/record', [RecordController::class,'store'])->name('add_record_process');
	Route::delete('/record', [RecordController::class, 'delete'])->name('record.delete');
	Route::put('/record', [RecordController::class, 'update'])->name('record.update');
	
	Route::put('/record/revome', [RecordController::class, 'remove_note_from_publication'])->name('record.remove');
	Route::put('/record/return', [RecordController::class, 'return_record_to_publication'])->name('record.return');

	Route::post('/comment', [CommentController::class, 'create_comment'])->name('comment.create');
	Route::delete('/comment', [CommentController::class, 'delete_comment'])->name('comment.delete');
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

Route::get('comments/{record_id}', [CommentController::class, 'get_comments_for_record'])->name('comments_for_record');
Route::get('comments/count/{record_id}', [CommentController::class, 'get_comments_count_for_record'])->name('comments_count_for_record');