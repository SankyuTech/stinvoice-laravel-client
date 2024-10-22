<?php

namespace Sankyutech\StInvoiceClient\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Sankyutech\StInvoiceClient\StinvoiceClientServiceProvider;

#[WithEnv('DB_CONNECTION', 'testing')]
#[WithMigration]
class StInvoiceControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $loadEnvironmentVariables = false;

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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRunBasicQuery()
    {
        DB::table('stinvoice_company')->insert([
            'registration_name' => 'Test Company'
        ]);

        $fetch = DB::table('stinvoice_company')->where('registration_name', 'Test Company')->first();
        $this->assertEquals('Test Company', $fetch->registration_name);

        $this->assertDatabaseHas('stinvoice_company', [
            'registration_name' => 'Test Company'
        ]);
    }
}
