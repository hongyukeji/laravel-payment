<?php

return [

    'default_gateway' => 'alipay',

    'default_options' => [
        'test_mode' => true,
        // ...
    ],

    'gateways' => [
        'paypal' => [
            'driver' => 'PayPal_Express',
            'options' => [
                'username' => env('PAYMENT_PAYPAL_USERNAME'),
                'password' => env('PAYMENT_PAYPAL_PASSWORD'),
                'signature' => env('PAYMENT_PAYPAL_SIGNATURE'),
                'test_mode' => env('PAYMENT_PAYPAL_TEST_MODE'),
            ],
        ],
        'alipay' => [
            'driver' => \App\Utils\Payment\Gateways\Alipay::class,
            'options' => [
                'app_id' => env('PAYMENT_ALIPAY_APP_ID'),
                'private_key' => env('PAYMENT_ALIPAY_PRIVATE_KEY'),
                'ali_public_key' => env('PAYMENT_ALIPAY_ALI_PUBLIC_KEY'),
                'return_url' => env('PAYMENT_ALIPAY_RETURN_URL', '/api/payments/return/alipay'),
                'notify_url' => env('PAYMENT_ALIPAY_NOTIFY_URL', '/api/payments/notify/alipay'),
            ],
        ],
        'wechat' => [
            'driver' => \App\Utils\Payment\Gateways\Wechat::class,
            'options' => [
                'app_id' => env('PAYMENT_WECHAT_APP_ID'),
                'app_secret' => env('PAYMENT_WECHAT_APP_SECRET'),
                'mch_id' => env('PAYMENT_WECHAT_MCH_ID'),
                'key' => env('PAYMENT_WECHAT_KEY'),
                'return_url' => env('PAYMENT_WECHAT_RETURN_URL', '/api/payments/return/wechat'),
                'notify_url' => env('PAYMENT_WECHAT_NOTIFY_URL', '/api/payments/notify/wechat'),
            ],
        ],

        // other gateways ...
    ],
];
