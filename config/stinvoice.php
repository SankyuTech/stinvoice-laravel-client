<?php

/*
 * You can place your custom package configuration in here.
 */
return [

	'production_url' => 'https://stinvoice.sankyutech.com.my',
	'sandbox_url' => 'https://preprod-stinvoice.sankyutech.com.my',
	'saas_application' => env('STINVOICE_SAAS',true),
	'back_to_main_application_url' => env('STINVOICE_MAIN_APP_URL', '/'),
];