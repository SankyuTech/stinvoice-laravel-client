<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sankyutech\StInvoiceClient\Http\Controllers\StInvoiceController;
use Sankyutech\StInvoiceClient\Http\Middleware\SaasApplicationMiddleware;

Route::prefix('e-invoice')->name('stinvoice.')->group(function () {


    //Sass application usage
    Route::prefix('{saas_id}')->name('saas.')->middleware([SaasApplicationMiddleware::class])->group(function () {
        Route::get('/dashboard', [StInvoiceController::class, 'saasIndex'])->name('index');
        Route::prefix('company')->name('company.')->group(function () {
            Route::get('/', [StInvoiceController::class, 'saasCompany'])->name('index');
            Route::post('store', [StInvoiceController::class, 'saasCompanyStore'])->name('store');
            Route::post('update', [StInvoiceController::class, 'saasCompanyUpdate'])->name('update');
        });

        Route::prefix('invoices')->name('invoices.')->group(function () {
            Route::post('/', [StInvoiceController::class, 'saasInvoices'])->name('index');
            Route::post('update', [StInvoiceController::class, 'saasCompanyUpdate'])->name('update');
        });
    });


    // //Non Sass application usage

    Route::get('/', [StInvoiceController::class, 'index'])->name('index');

    Route::prefix('company')->name('company.')->group(function () {
        Route::get('/', [StInvoiceController::class, 'company'])->name('index');
        Route::post('store', [StInvoiceController::class, 'companyStore'])->name('store');
        Route::post('update', [StInvoiceController::class, 'companyUpdate'])->name('update');

    });

    Route::prefix('invoice')->name('invoice.')->group(function () {
        Route::get('/', [StInvoiceController::class, 'invoice'])->name('index');
        Route::get('{ulid}', [StInvoiceController::class, 'viewInvoice'])->name('view');
    });




});