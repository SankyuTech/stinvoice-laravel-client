<?php

namespace Sankyutech\StInvoiceClient\Http\Middleware;

use Closure;

class SaasApplicationMiddleware
{
    public function handle($request, Closure $next)
    {
        if(config('stinvoice.saas_application')){

            return $next($request);
        }

        return redirect(route('stinvoice.index'));
    
    }
}