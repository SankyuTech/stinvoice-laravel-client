<?php

namespace Sankyutech\StInvoiceClient\Tests\Browser;

use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\Dusk\Options;
use Orchestra\Testbench\Dusk\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Sankyutech\StInvoiceClient\Tests\DuskTestCase;
use Sankyutech\StInvoiceClient\StinvoiceClientServiceProvider;

class StInvoiceWebInterfaceTest extends DuskTestCase
{
    use RefreshDatabase;

    protected static $baseServeHost = '127.0.0.1';

    protected static $baseServePort = 9000;

    protected $loadEnvironmentVariables = false;

    //setup
    public function setUp(): void
    {
        parent::setUp();
    }


    /**
     * Prepare the testing environment web driver options.
     *
     * @api
     *
     * @return void
     */
    public static function defineWebDriverOptions()
    {
        Options::withUI();
    }

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

    public function testGetIndexPageWithView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/e-invoice')
                    ->screenshot('st-invoice-index')
                    ->assertSee('E-Invoice Made Easy');
        });
    }
}
