<?php

namespace Sankyutech\StInvoiceClient\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StInvoiceController extends Controller
{
    public $saas;

    public function __construct()
    {
        $this->saas = config('stinvoice.saas_application');
    }

    public function index()
    {
        return view('stinvoice-client::dashboard');
    }

    public function company()
    {
        $company = DB::table('stinvoice_company')->first();
        logger()->error('company', ['company' => $company]);
        return view('stinvoice-client::company.index');
    }


    // saas controller
    public function saasIndex($saas_id)
    {
        return view('stinvoice-client::dashboard');
    }

    public function saasCompany($saas_id)
    {
        $company = DB::table('stinvoice_company')->where('stinvoice_saas_id', $saas_id)->get();
        return view('stinvoice-client::company.index');
    }
}
