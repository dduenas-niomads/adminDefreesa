<?php

return [
    'END_POINT' => env('APP_URL'),
    // Desarrollo Visa
    'DEV' => [
        'VISA_MERCHANT_ID' => env('VISA_MERCHANT_ID'),
        'VISA_USER' => 'integraciones.visanet@necomplus.com',
        'VISA_PWD' => env('VISA_PWD'),
        'VISA_URL_SECURITY' => 'https://apitestenv.vnforapps.com/api.security/v1/security',
        'VISA_URL_SESSION' => 'https://apitestenv.vnforapps.com/api.ecommerce/v2/ecommerce/token/session/' . env('VISA_MERCHANT_ID'),
        'VISA_URL_JS' => 'https://static-content-qas.vnforapps.com/v2/js/checkout.js?qa=true',
        'VISA_URL_AUTHORIZATION' => 'https://apitestenv.vnforapps.com/api.authorization/v3/authorization/ecommerce/' . env('VISA_MERCHANT_ID'),
    ],
    // Producción Visa
    'PROD' => [
        'VISA_MERCHANT_ID' => env('VISA_MERCHANT_ID'),
        'VISA_USER' => 'integraciones.visanet@necomplus.com',
        'VISA_PWD' => env('VISA_PWD'),
        'VISA_URL_SECURITY' => 'https://apiprod.vnforapps.com/api.security/v1/security',
        'VISA_URL_SESSION' => 'https://apiprod.vnforapps.com/api.ecommerce/v2/ecommerce/token/session/' . env('VISA_MERCHANT_ID'),
        'VISA_URL_JS' => 'https://static-content.vnforapps.com/v2/js/checkout.js',
        'VISA_URL_AUTHORIZATION' => 'https://apiprod.vnforapps.com/api.authorization/v3/authorization/ecommerce/' . env('VISA_MERCHANT_ID'),
    ],
];