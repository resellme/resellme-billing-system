<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterDomainController;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Open routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Home page
    Route::get('/', function () {
        return view('welcome');
    });

    // Search domain
    Route::get('/domains/search', [SearchDomainController::class, 'search'])->name('search_domain');
});

// Protected routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Register domain
    Route::post('/domains/{domain}/register', RegisterDomainController::class)->name('register_domain');

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user_dashboard');

    // Load funds
    Route::get('/load-funds', [LoadFundsController::class, 'load'])->name('user_dashboard');

});
