<?php

namespace Sankyutech\StinvoiceClient;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sankyutech\StinvoiceClient\Skeleton\SkeletonClass
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
