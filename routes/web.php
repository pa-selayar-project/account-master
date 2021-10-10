<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('login', [LoginController::class, 'authenticate']);

Route::group(['middleware'=>'auth'], function(){
    Route::resource('user', AccountController::class)->except('show','create');
    Route::get('user/get_data/{id}/hasil', [AccountController::class, 'get_data']);
    Route::resource('category', CategoryController::class)->except('show','edit','create');
    Route::resource('profil', ProfilController::class)->except('show','edit','create');
    Route::post('logout', [LoginController::class, 'logout']);
});