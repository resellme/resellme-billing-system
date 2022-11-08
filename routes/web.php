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
use App\Http\Controllers\HostingController;
use App\Http\Controllers\ConfigureDomainController;
use App\Http\Controllers\Orders\CheckoutController;

// Protected routes
Route::middleware(['auth:sanctum', 'verified'])
->group(function () {
    // Home page / search page
    // Route::get('/', [SearchDomainController::class, 'index'])->name('search_domain_page');

    Route::get('/', function() {
        return redirect(route('hostings.create'));
    })->name('search_domain_page');

    // Search domain
    Route::get('/domains/search', [SearchDomainController::class, 'search'])->name('search_domain');

    // User Dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Contacts
    Route::get('/domains/{domain}/contacts', [ContactsController::class, 'create'])->name('create_contacts_page');
    Route::post('/contacts', [ContactsController::class, 'store'])->name('contacts.store');

    // Nameservers for domain
    Route::get('/domains/{domain}/nameservers', [NameserversController::class, 'create'])->name('nameservers.create');
    Route::post('nameservers', [NameserversController::class, 'store'])->name('create_nameservers');

    // Domains
    Route::resource('domains', DomainsController::class);
    Route::post('/domains/{domain}/register', RegisterDomainController::class)->name('domains.register');
    Route::get('/domains/{domain}/configure', [ConfigureDomainController::class, 'contact'])->name('domains.configure');

    // Hosting
    Route::resource('hostings', HostingController::class);

    // Order
    Route::resource('orders', OrderController::class);
    Route::post('orders/{order}/checkout', CheckoutController::class)->name('orders.checkout');
    // Route::post('orders/{order}/complete', [CompleteOrderController::class, 'complete'])->name('orders.complete');
    // Route::post('/paynow/callback', PaynowCallbackController::class)->name('paynow_callback');
    Route::post('/paynow/callback', [CompleteOrderController::class, 'callback')->name('paynow_callback');
    Route::get('/paynow/complete', [CompleteOrderController::class, 'complete'])->name('paynow_complete_order');
});
