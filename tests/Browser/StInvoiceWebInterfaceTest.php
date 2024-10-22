<?php

namespace Sankyutech\StInvoiceClient\Tests\Browser;

use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\Dusk\Options;
use Orchestra\Testbench\Dusk\TestCase;
use Orchestra\Testbench\Attributes\WithMigration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Sankyutech\StInvoiceClient\Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Sankyutech\StInvoiceClient\StinvoiceClientServiceProvider;

use function Orchestra\Testbench\artisan;

#[WithMigration]
class StInvoiceWebInterfaceTest extends DuskTestCase
{
    use RefreshDatabase;
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected static $baseServeHost = '127.0.0.1';

    /**
     * Undocumented variable
     *
     * @var integer
     */
    protected static $baseServePort = 9000;

    /**
     * Undocumented variable
     *
     * @var boolean
     */
    protected $loadEnvironmentVariables = false;

    /**
      * Define environment setup.
      *
      * @param  \Illuminate\Foundation\Application  $app
      * @return void
      */
    protected function defineEnvironment($app)
    {
        $app['config']->set('database.default', 'mysql');
        $app['config']->set('database.mysql.username', 'root');
        $app['config']->set('database.mysql.database', 'st_invoice');
    }

    /**
    * Define database migrations.
    *
    * @return void
    */
    protected function defineDatabaseMigrations()
    {
        artisan($this, 'migrate', ['--database' => 'mysql']);

        $this->beforeApplicationDestroyed(
            fn () => artisan($this, 'migrate:rollback', ['--database' => 'mysql'])
        );
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

    public function testGetCompanyPageWithView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/e-invoice/company')
                    ->screenshot('st-invoice-company')
                    ->pause(1000)
                    ->assertSee('Company');
        });
    }
}
