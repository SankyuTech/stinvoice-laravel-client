<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Sankyu\Constants;

class Constants
{
    public function getListStates(){

    	$states = Constants::StateCodes();

    	return $states;

    }

}
