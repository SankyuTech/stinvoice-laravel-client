<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sankyutech\StInvoiceClient\Http\Controllers\StInvoiceController;



Route::prefix('e-invoice')->name('stinvoice.')->group(function () {

	

    //Sass application usage

    Route::prefix('{saas_id}')->name('saas.')->group(function () {

    	Route::get('/dashboard',[StInvoiceController::class, 'saasIndex'])->name('index');


        Route::prefix('company')->name('company.')->group(function () {

            Route::get('/',[StInvoiceController::class, 'saasCompany'])->name('index');
            Route::post('store',[StInvoiceController::class, 'saasCompanyStore'])->name('store');
            Route::post('update',[StInvoiceController::class, 'saasCompanyUpdate'])->name('update');

        });

        Route::prefix('invoices')->name('invoices.')->group(function () {

            Route::post('/',[StInvoiceController::class, 'saasInvoices'])->name('index');
            Route::post('update',[StInvoiceController::class, 'saasCompanyUpdate'])->name('update');
            
        });



    });



    // //Non Sass application usage

    Route::get('/',[StInvoiceController::class, 'index'])->name('index');

    Route::get('company',[StInvoiceController::class, 'company'])->name('company');

    Route::post('company/store',[StInvoiceController::class, 'companyStore'])->name('company.store');

    Route::post('company/update',[StInvoiceController::class, 'companyUpdate'])->name('company.update');

});