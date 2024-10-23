<?php

namespace Sankyutech\StInvoiceClient\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Sankyutech\StInvoiceClient\Http\Traits\NonSaasApplicationTrait;
use Sankyutech\StInvoiceClient\Http\Traits\SaasApplicationTrait;

class StInvoiceController extends Controller
{
    use 
    SaasApplicationTrait,
    NonSaasApplicationTrait;

}