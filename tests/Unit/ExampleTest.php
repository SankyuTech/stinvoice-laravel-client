<?php

namespace Sankyutech\StInvoiceClient\Tests;

use Orchestra\Testbench\TestCase;
use Sankyutech\StInvoiceClient\StinvoiceClientServiceProvider;

class ExampleTest extends TestCase
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
    public function testExample()
    {
        $response = $this->get('/e-invoice');
        $response->assertStatus(200);
    }
}
