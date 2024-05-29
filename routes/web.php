<?php

use App\Http\Controllers\AuthController as CustomAuthController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('newindex');
});

Route::get('/newindex', function () {
    return view('newindex');
})->name('newindex');

Route::get('/navbar', function () {
    return view('navbar');
})->name('navbar');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post("/register", [CustomAuthController::class, "userCreate"])->name('register');

Route::post("/login", [CustomAuthController::class, "login"])->name('login');

// Public login page accessible without authentication
Route::match(['get', 'post'], '/login-page', function () {
    return view('login-page');
})->name('login');

Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('/portfolio/{id}', [PropertyController::class, 'showPortfolio'])->name('property.portfolio');

Route::get('upload', function () {
    return view('upload');
})->name('upload'); // No middleware applied

Route::get('about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('contact-us', function () {
    return view('contact-us');
})->name('contact-us');


Route::get('/property/list', [PropertyController::class, 'getList'])->name('property.list');

Route::get('/list', [PropertyController::class, 'getList'])->name('list');

// routes/web.php
Route::post('/report', [ReportController::class, 'store'])->name('report.store');
Route::get('/newindex', [PropertyController::class, 'newindex'])->name('newindex');


// Property-related routes
Route::middleware(['auth'])->group(function () {
    Route::post('/property/upload', [PropertyController::class, 'postProperty'])->name('property.upload');
    Route::get('/property/{id}', [PropertyController::class, 'getPropertyDetails'])->name('property.details');
});
