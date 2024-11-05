<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Sankyu\Constants;

class StInvoiceConstants
{
    public static function getListStates(){

    	$states = Constants::StateCodes();

    	return $states;

    }

}
