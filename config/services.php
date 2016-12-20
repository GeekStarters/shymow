<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],
	
	'twitter' => [
        'client_id' =>  env('TWITTER_APP_ID_ORIGINAL'),
        'client_secret' => env('TWITTER_APP_SECRET_ORIGINAL'),
        'redirect' => env('TWITTER_REDIRECT_ORIGINAL'),
    ],
    'facebook' => [
        'client_id' =>  env('FACEBOOK_APP_ID_ORIGINAL'),
        'client_secret' => env('FACEBOOK_APP_SECRET_ORIGINAL'),
        'redirect' => env('FACEBOOK_REDIRECT_ORIGINAL'),
    ],
    'google' => [
        'client_id' =>  env('GOOGLE_APP_ID_ORIGINAL'),
        'client_secret' => env('GOOGLE_APP_SECRET_ORIGINAL'),
        'redirect' => env('GOOGLE_REDIRECT_ORIGINAL'),
    ]
];
