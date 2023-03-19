<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', function(){
    return redirect()->route('home');
})->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/support', [HomeController::class, 'support'])->name('support')->middleware('auth');

Route::resource('customer', CustomerController::class)->middleware('auth')->except(['create']);
Route::resource('order', OrderController::class)->middleware('auth');
