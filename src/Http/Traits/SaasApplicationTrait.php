<?php

namespace Sankyutech\StInvoiceClient\Http\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait SaasApplicationTrait
{
    public function saasIndex($saas_id)
    {
        return view('stinvoice-client::dashboard');
    }

    public function saasCompany($saas_id)
    {
        $company = DB::table('stinvoice_company')->where('stinvoice_saas_id', $saas_id)->get();
        return view('stinvoice-client::company.saas-index');
    }

}

