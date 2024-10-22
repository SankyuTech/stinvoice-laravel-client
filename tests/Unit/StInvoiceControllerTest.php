<?php

namespace Sankyutech\StInvoiceClient\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Route;
use Sankyutech\StInvoiceClient\StinvoiceClientServiceProvider;

class StInvoiceControllerTest extends TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array<int, class-string<\Illuminate\Support\ServiceProvider>>
     */
    protected function getPackageProviders($app)
    {
        return [
            StinvoiceClientServiceProvider::class
        ];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetControllerInstance()
    {
        $controller = new \Sankyutech\StInvoiceClient\Http\Controllers\StInvoiceController();
        $this->assertEquals('Sankyutech\StInvoiceClient\Http\Controllers\StInvoiceController', get_class($controller));
    }
}
