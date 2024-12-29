<?php

use App\Http\Controllers\AuthController as CustomAuthController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AgentController;
Route::get('/', function () {
    return redirect()->route('newindex');
})->name('home');

Route::get('/newindex', [PropertyController::class, 'newindex'])->name('newindex');
Route::get('/navbar', function () {
    return view('navbar');
})->name('navbar');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::match(['get', 'post'], '/login-page', function () {
    return view('login-page');
})->name('login-page'); // This route is named 'login-page'

Route::get('register', function () {
    return view('auth');
})->name('register');

Route::post('user-create', [CustomAuthController::class, 'userCreate'])->name('user-create');
Route::post('/login', [CustomAuthController::class, 'login'])->name('login');


Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');





Route::get('/PropertyDetail/{property_id}', [PropertyController::class, 'showPortfolio'])->name('property.PropertyDetail');

Route::get('/admin/property-list', [PropertyController::class, 'showUserProperties'])->name('admin.property-list');

Route::get('/user-properties', [PropertyController::class, 'userPropertyList'])->name('property.userPropertyList');


Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications.show');
Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/notifications/delete/{id}', [NotificationController::class, 'destroy'])->name('notifications.delete');


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

Route::post('property/{property_id}/remove-image', [PropertyController::class, 'removeImage'])->name('property.removeImage');




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

Route::get('/properties/{property_id}/edit', [PropertyController::class, 'editProperty'])->name('property.edit');

Route::put('/properties/{property_id}', [PropertyController::class, 'update'])->name('property.update');


Route::post('/custom-login', [CustomAuthController::class, 'login'])->name('custom-login');
Route::get('/search', [PropertyController::class, 'search'])->name('properties.search');

// Define a route for editing the user profile

Route::get('/agent/{id}/edit', [CustomAuthController::class, 'editUser'])->name('user.edit');

// Route to show the edit form for a user
// Routes with 'profile' prefix
Route::get('/profile/{id}/edit', [CustomAuthController::class, 'editUser'])->name('profile.edit');
Route::put('/profile/{id}', [CustomAuthController::class, 'updateUser'])->name('profile.update');





// tahas route

//Agent Router
Route::get('/agents', [AgentController::class, 'index']);
Route::post('/agents', [AgentController::class, 'store']);
Route::get('/agents/{id}', [AgentController::class, 'show']);
Route::put('/agents/{id}', [AgentController::class, 'update']);
Route::delete('/agents/{id}', [AgentController::class, 'destroy']);



// Retrieve all appointments or filter by user/agent/office
Route::get('/appointments', [AppointmentController::class, 'index']);
// Create a new appointment (protected by authentication)
Route::middleware('auth:sanctum')->post('/appointments', [AppointmentController::class, 'store']);
// Update an appointment (protected by authentication)
Route::middleware('auth:sanctum')->put('/appointments/{id}', [AppointmentController::class, 'update']);
// Cancel an appointment (protected by authentication)
Route::middleware('auth:sanctum')->delete('/appointments/{id}', [AppointmentController::class, 'destroy']);





// Retrieve all notifications for an office or agent (real estate office is required)
Route::get('/notifications', [NotificationController::class, 'index']);
// Create a new notification for an office or agent
Route::middleware('auth:sanctum')->post('/notifications', [NotificationController::class, 'store']);
// Mark a notification as read
Route::middleware('auth:sanctum')->post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
// Delete a notification
Route::middleware('auth:sanctum')->delete('/notifications/{id}', [NotificationController::class, 'destroy']);

// Retrieve all projects or filter by office
Route::get('/projects', [ProjectController::class, 'index']);
// Retrieve a specific project
Route::get('/projects/{id}', [ProjectController::class, 'show']);
// Create a new project (protected by authentication)
Route::middleware('auth:sanctum')->post('/projects', [ProjectController::class, 'store']);


//added routes 

Route::get('/schedule', [AppointmentController::class, 'showSchedule'])->name('schedule');

Route::get('/appointments/schedule-list', [AppointmentController::class, 'showScheduleList'])->name('appointments.scheduleList');


Route::get('/notifications', [NotificationController::class, 'showNotifications']);
Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications');


Route::get('/projects', [ProjectController::class, 'showProjects'])->name('projects');


Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');