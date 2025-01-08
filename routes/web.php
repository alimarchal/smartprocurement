<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeliveryNoteController;
use App\Http\Controllers\DeliveryNoteItemController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuotationItemController;

Route::get('/', function () {
    return to_route('login');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resources([
        'customers' => CustomerController::class,
        'contacts' => ContactController::class,
        'items' => ItemController::class,
        'quotations' => QuotationController::class,
        'delivery-notes' => DeliveryNoteController::class,
        'invoices' => InvoiceController::class,
        'payments' => PaymentController::class,
    ]);

    Route::resource('companies', CompanyController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);


    Route::apiResource('quotation-items', QuotationItemController::class)->except(['index', 'show']);
    Route::apiResource('delivery-note-items', DeliveryNoteItemController::class)->except(['index', 'show']);
    Route::apiResource('invoice-items', InvoiceItemController::class)->except(['index', 'show']);
});
