<?php

namespace Sankyutech\StInvoiceClient\Tests;

use Orchestra\Testbench\Dusk\Options as DuskOptions;
use Orchestra\Testbench\Foundation\Env;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

class DuskTestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    //this method need to be overidden to set the chrome driver binary path
    protected function driver(): RemoteWebDriver
    {
        static::defineWebDriverOptions();
        if (DuskOptions::shouldUsesWithoutUI()) {
            DuskOptions::withoutUI();
        } elseif ($this->hasHeadlessDisabled()) {
            DuskOptions::withUI();
        }

        return RemoteWebDriver::create(
            Env::get('DUSK_DRIVER_URL') ?? \sprintf('http://localhost:%d', static::$chromeDriverPort),
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                DuskOptions::getChromeOptions()
                ->setBinary('/Applications/Google Chrome for Testing.app/Contents/MacOS/Google Chrome for Testing')
            )
        );
    }

}
