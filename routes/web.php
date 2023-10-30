<?php

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

use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Home;

Route::middleware('theme:wowcms/default')
    ->group(function () {
        Route::get('/', Home::class)->name('home');
        Route::get('/login', Login::class)->name('login');
        Route::get('/logout', LogoutController::class)->name('logout');
    });
