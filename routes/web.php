<?php

use App\Http\Controllers\AuthController as CustomAuthController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('newindex');
})->name('home');

Route::get('/newindex', [PropertyController::class, 'newindex'])->name('newindex');
Route::get('/navbar', function () {
    return view('navbar');
})->name('navbar');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::match(['get', 'post'], '/login-page', function () {
    return view('login-page');
})->name('login-page'); // This route is named 'login-page'

Route::get('register', function () {
    return view('auth');
})->name('register');

Route::post('user-create', [CustomAuthController::class, 'userCreate'])->name('user-create');
Route::post('/login', [CustomAuthController::class, 'login'])->name('login');
Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');

Route::get('/portfolio/{id}', [PropertyController::class, 'showPortfolio'])->name('property.portfolio');
Route::get('upload', function () {
    return view('upload');
})->name('upload');
Route::get('about-us', function () {
    return view('about-us');
})->name('about-us');
Route::get('contact-us', function () {
    return view('contact-us');
})->name('contact-us');

Route::get('/property/list', [PropertyController::class, 'getList'])->name('property.list');
Route::post('/property/upload', [PropertyController::class, 'postProperty'])->name('property.upload');
Route::get('/properties/list', [PropertyController::class, 'getList'])->name('properties.list');
Route::get('/list', [PropertyController::class, 'getList'])->name('list');

Route::post('/report', [ReportController::class, 'store'])->name('report.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/property/{id}', [PropertyController::class, 'getPropertyDetails'])->name('property.details');
});

Route::post('/property/remove-photo', [PropertyController::class, 'removePhoto'])->name('property.removePhoto');
Route::delete('/property/{id}/remove-image', [PropertyController::class, 'removeImage'])->name('property.removeImage');

Route::get('/search', [PropertyController::class, 'search'])->name('search');
Route::get('/properties/search', [PropertyController::class, 'search'])->name('properties.search');
Route::middleware('auth')->group(function () {
Route::get('/agent/admin-dashboard', [CustomAuthController::class, 'adminDashboard'])->name('agent.admin-dashboard');
Route::get('/admin-property-list', [CustomAuthController::class, 'adminPropertyList'])->name('admin.property.list');
Route::get('/admin/property-list', [PropertyController::class, 'adminPropertyList'])->name('admin.property-list');
});
Route::get('/profile', [CustomAuthController::class, 'showProfile'])->middleware('auth')->name('admin.profile');
Route::middleware('auth')->group(function () {
    Route::get('/review', [CustomAuthController::class, 'showReviews'])->name('agent.review');
});

Route::get('/property/edit/{id}', [PropertyController::class, 'editProperty'])->name('property.edit');
Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');
Route::put('/properties/{id}', [PropertyController::class, 'update'])->name('property.update');


Route::post('/custom-login', [CustomAuthController::class, 'login'])->name('custom-login');
Route::get('/search', [PropertyController::class, 'search'])->name('properties.search');

// Define a route for editing the user profile

Route::get('/agent/{id}/edit', [CustomAuthController::class, 'editUser'])->name('user.edit');
Route::put('/agent/{id}', [CustomAuthController::class, 'updateUser'])->name('user.update');
// Route to show the edit form for a user
// Routes with 'profile' prefix
Route::get('/profile/{id}/edit', [CustomAuthController::class, 'editUser'])->name('profile.edit');
Route::put('/profile/{id}', [CustomAuthController::class, 'updateUser'])->name('profile.update');



// routes/web.php


