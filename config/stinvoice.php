<?php

/*
 * You can place your custom package configuration in here.
 */
return [

	'production_url' => 'https://stinvoice.sankyutech.com.my',
	'sandbox_url' => 'https://preprod-stinvoice.sankyutech.com.my',
	'saas_application' => env('STINVOICE_SAAS',true),

	'states' => [
		'Johor',
		'Kedah',
		'Kelantan',
		'Kedah',
		'Melaka',
		'Negeri Sembilan',
		'Pahang',
		'Pulau Pinang',
		'Perak',
		'Perlis',
		'Selangor',
		'Terengganu',
		'Sabah',
		'Sarawak',
		'Wilayah Persekutuan Kuala Lumpur',
		'Wilayah Persekutuan Labuan',
		'Wilayah Persekutuan Putrajaya'
	],
];