<?php

namespace Sankyutech\StInvoiceClient\Http\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait NonSaasApplicationTrait
{
    public function index()
    {
        return view('stinvoice-client::dashboard');
    }

    public function company()
    {
        $company = DB::table('stinvoice_company')->first();

        return view('stinvoice-client::company.index');
    }

    public function invoice(){

        return view('stinvoice-client::invoice.index');
    }

    public function viewInvoice($ulid){

        return view('stinvoice-client::invoice.view');
    }

}