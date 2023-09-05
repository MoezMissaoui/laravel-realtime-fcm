<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/notification/fire', [App\Http\Controllers\NotificationController::class, 'fire'])->name('fire-notification');
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'show'])->name('show-notifications');
Route::post('/notification/store', [App\Http\Controllers\NotificationController::class, 'store'])->name('store-notification');
