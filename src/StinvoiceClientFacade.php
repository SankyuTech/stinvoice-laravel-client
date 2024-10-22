<?php

namespace Sankyutech\StInvoiceClient;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sankyutech\StInvoiceClient\Skeleton\SkeletonClass
 */
class StinvoiceClientFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'stinvoice-client';
    }
}
