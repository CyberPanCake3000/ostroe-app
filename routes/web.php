<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

Auth::routes([
    'registration' => false,
    'verify' => false,
    'reset' => false,
]);

//Route::match(['get', 'post', 'put', 'delete'], 'register', function () {
//    return redirect('/login');
//});

Route::get('/', function(){
    return redirect()->route('home');
})->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/support', [HomeController::class, 'support'])->name('support')->middleware('auth');
Route::post('/search', [SearchController::class, 'globalSearch'])->name('globalSearch')->middleware('auth');
Route::get('/suggestions', [SearchController::class, 'suggestions'])->name('suggestions')->middleware('auth');
Route::get('/customerSearch', [SearchController::class, 'customerSearch'])->name('customerSearch')->middleware('auth');
Route::get('/customersSearch', [SearchController::class, 'customersSearch'])->name('customersSearch')->middleware('auth');

Route::resource('customer', CustomerController::class)->middleware('auth')->except(['create']);
Route::resource('order', OrderController::class)->middleware('auth')->except(['create']);
