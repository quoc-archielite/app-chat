<?php

use App\Http\Controllers\MessagerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/list-friend', [MessagerController::class, 'getListFriend'])->middleware(['auth', 'verified'])->name('list-friend');
Route::get('/messager/{id_sender}/{id_receiver}', [MessagerController::class, 'getMessager'])->middleware(['auth', 'verified'])->name('messager');
Route::post('/send-messager', [MessagerController::class, 'sendMessager'])->middleware(['auth', 'verified'])->name('send-messager');
Route::get('/get-messager-realtime/{id_sender}/{id_receiver}', [MessagerController::class, 'getRealtimeMessager'])->middleware(['auth', 'verified'])->name('send-messager-realtime');
Route::post('/ajax-send-messager/{id_sender}/{id_receiver}/{content}', [MessagerController::class, 'ajaxSendMessager'])->middleware(['auth', 'verified'])->name('ajax-send-messager');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
