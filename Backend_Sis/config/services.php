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
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    'facebook' => [
        'client_id' => '549682292239325',
        'client_secret' => '1e9effe6bf8a9750097188b0f001d7d9',
        'redirect'=> 'http://tallersis.com.devel/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => 'pmnshl6qpuh9mf77950m2e8s4hi48uib.apps.googleusercontent.com',
        'client_secret' => 'nAtvq59Zsu9i4RSbp9cI_BPG',
        'redirect' => 'http://http://localhost/Proyecto_Taller_SIS/Backend_Sis/public/social/callback/google',
       ],
    ];