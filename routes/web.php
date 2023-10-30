<?php

use App\Http\Controllers\RecordController;

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

Route::get('/', function () {
    return view('index');
});

Route::post('/from', function (Request $request) {
	$body = $request->json_decoded(); 
	return "aaaa";
});

Route::get('/add_record', [RecordController::class, 'add_record']);
Route::get('/all_records', [RecordController::class, 'all_records']);
Route::get('/record', [RecordController::class, 'record']);
Route::post('/record', [RecordController::class,'store']);