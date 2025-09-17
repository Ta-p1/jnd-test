<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\AuthController;

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

Route::get('/admin', function () {
    return view('admin');
})->middleware('auth')->name('admin');

Route::get('/', function () {
    return view('index');
})->middleware('auth');

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/short-url',[LinkController::class, 'store'])->name('short-url');
Route::get('/{code}', [LinkController::class, 'redirect']);
Route::post('/remove', [LinkController::class, 'remove'])->name('remove');
Route::post('/show', [LinkController::class, 'show'])->name('show');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

