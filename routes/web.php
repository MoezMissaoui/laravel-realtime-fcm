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
Route::get('/fire-notification', [App\Http\Controllers\NotificationController::class, 'fire_notification'])->name('fire-notification');
Route::get('/show-notification', [App\Http\Controllers\NotificationController::class, 'show_notification'])->name('show-notification');
Route::post('/get-notification', [App\Http\Controllers\NotificationController::class, 'get_notification'])->name('get-notification');
