<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sankyutech\StInvoiceClient\Http\Controllers\StInvoiceController;
use Sankyutech\StInvoiceClient\Http\Middleware\SaasApplicationMiddleware;
use Sankyutech\StInvoiceClient\Http\Middleware\NonSaasApplicationMiddleware;

Route::prefix('e-invoice')->name('stinvoice.')->group(function () {


    //Sass application usage
    Route::prefix('{saas_id}')->name('saas.')->middleware([SaasApplicationMiddleware::class])->group(function () {
        Route::get('/dashboard', [StInvoiceController::class, 'saasIndex'])->name('index');
        Route::prefix('company')->name('company.')->group(function () {
            Route::get('/', [StInvoiceController::class, 'saasCompany'])->name('index');
            Route::post('store', [StInvoiceController::class, 'saasCompanyStore'])->name('store');
            Route::post('update', [StInvoiceController::class, 'saasCompanyUpdate'])->name('update');

            Route::get('{company_ulid}/invoices', [StInvoiceController::class, 'saasCompanyInvoices'])->name('invoices');
        });
    });


    // //Non Sass application usage

    Route::middleware([NonSaasApplicationMiddleware::class])->group(function () {

        Route::get('/', [StInvoiceController::class, 'index'])->name('index');

        Route::prefix('company')->name('company.')->group(function () {
            Route::get('/', [StInvoiceController::class, 'company'])->name('index');
            Route::post('store', [StInvoiceController::class, 'companyStore'])->name('store');

        });

        Route::prefix('invoice')->name('invoice.')->group(function () {
            Route::get('/', [StInvoiceController::class, 'invoice'])->name('index');
            Route::get('{ulid}', [StInvoiceController::class, 'viewInvoice'])->name('view');
        });

    });




});