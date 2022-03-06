<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterDomainController;
use App\Http\Controllers\SearchDomainController;
use App\Http\Controllers\LoadFundsController;
use App\Http\Controllers\NameserversController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PaynowCallbackController;
use App\Http\Controllers\DomainsController;
use App\Http\Controllers\CompleteOrderController;
use App\Http\Controllers\OrderController;

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


/**
 *  Open routes
 */
// Home page / search page
Route::get('/', [SearchDomainController::class, 'index'])->name('search_domain_page');

// Search domain
Route::get('/domains/search', [SearchDomainController::class, 'search'])->name('search_domain');

// Protected routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // User Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Contacts
    Route::get('/domains/{domain}/contacts', [ContactsController::class, 'create'])->name('create_contacts_page');
    Route::post('/contacts', [ContactsController::class, 'store'])->name('create_contacts');

    // Nameservers for domain
    Route::get('/domains/{domain}/nameservers', [NameserversController::class, 'create'])->name('create_nameservers_page');
    Route::post('nameservers', [NameserversController::class, 'store'])->name('create_nameservers');

    // Domains
    Route::post('/domains', [DomainsController::class, 'store'])->name('create_domain');
    Route::post('/domains/{domain}/register', RegisterDomainController::class)->name('register_domain');

    // Order
    Route::get('/domains/{domain}/order', [OrderController::class, 'create'])->name('create_order_page');
    Route::post('/orders', [OrderController::class, 'store'])->name('create_order');
    Route::post('/paynow/callback', PaynowCallbackController::class)->name('paynow_callback');
    Route::get('/paynow/complete', CompleteOrderController::class)->name('paynow_complete_order');
});
