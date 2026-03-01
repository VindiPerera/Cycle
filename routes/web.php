<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BicycleController;
use App\Http\Controllers\ServiceHistoryController;
use App\Http\Controllers\SearchController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Search
    Route::get('/search',        [SearchController::class, 'index'])->name('search.index');
    Route::get('/search/results',[SearchController::class, 'search'])->name('search.results');

    // Customers
    Route::resource('customers', CustomerController::class);

    // Bicycles
    Route::resource('bicycles', BicycleController::class);

    // Service History
    Route::resource('service-history', ServiceHistoryController::class);
});

