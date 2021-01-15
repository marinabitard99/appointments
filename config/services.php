<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'facebook' => [
    'client_id' => '293837167759343',
    'client_secret' => '11297779132ce23f9fd35ac19329ab24',
    'redirect' => 'http://localhost:8000/callback',
],
    
    'google' => [
    'client_id' => '23980585137-ju45irgc1kmg4c06tr3spstooqqjand7.apps.googleusercontent.com',
    'client_secret' => 'vbQ-w7h37sxSY4WnAsCBuOyK',
    'redirect' => 'http://localhost:8000/callback/google',
],

];
