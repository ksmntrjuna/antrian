<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\QueueController;
use App\Http\Middleware\AdminAuth;

Route::get('/', function () {
    return view('welcome');
});


// Login routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Dashboard (protected)
// Route::middleware(AdminAuth::class)->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });

Route::middleware(AdminAuth::class)->prefix('admin')->group(function () {
    Route::get('/dashboard', [QueueController::class, 'index'])->name('admin.dashboard');
    Route::post('/queue/next', [QueueController::class, 'next'])->name('admin.queue.next');
    Route::post('/queue/prev', [QueueController::class, 'prev'])->name('admin.queue.prev');
});