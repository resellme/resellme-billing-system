<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterDomainController;
use App\Http\Controllers\SearchDomainController;
use App\Http\Controllers\LoadFundsController;
use App\Http\Controllers\NameserversController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\UserDashboardController;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/**
 *  Open routes
 */
// Home page / search page
Route::get('/', [SearchDomainController::class, 'index'])->name('search_domain_page');

// Search domain
Route::post('/domains/search', [SearchDomainController::class, 'search'])->name('search_domain');

// Protected routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Enter Contacts for Domain
    Route::get('/domains/{domain}/contacts', [ContactsController::class, 'create'])->name('contacts_page');

    // Enter Nameservers for domain
    Route::get('/domains/{domain}/nameservers', [NameserversController::class, 'create'])->name('nameservers_page');

    // Register domain
    Route::post('/domains/{domain}/register', RegisterDomainController::class)->name('register_domain');

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user_dashboard');

    // Order
    Route::get('/order/complete', [CompleteOrderController::class, 'index'])->name('complete_order_view');
    Route::post('/paynow/callback', PaynowCallbackController::class)->name('paynow_callback');
});
