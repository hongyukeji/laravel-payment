<?php
/**
 * +----------------------------------------------------------------------
 * | laravel-payment [ File Description ]
 * +----------------------------------------------------------------------
 * | Copyright (c) 2015~2019 http://www.wmt.ltd All rights reserved.
 * +----------------------------------------------------------------------
 * | 版权所有：贵州鸿宇叁柒柒科技有限公司
 * +----------------------------------------------------------------------
 * | Author: shadow <admin@hongyuvip.com>  QQ: 1527200768
 * +----------------------------------------------------------------------
 * | Version: v1.0.0  Date:2019-05-25 Time:14:38
 * +----------------------------------------------------------------------
 */

namespace Hongyukeji\LaravelPayment;

use Hongyukeji\LaravelPayment\Payment;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton('payment', function ($app) {
            return new Payment;
        });

        $this->app->alias('payment', Payment::class);

        /*App::bind('payment', function () {
            return new Payment;
        });*/
    }
}