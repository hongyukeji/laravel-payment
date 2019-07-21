<?php

namespace Hongyukeji\LaravelPayment\Interfaces;


interface PaymentGatewayInterface
{
    public function __construct(...$args);

    /**
     * 获取支付网关
     *
     * @param $name
     * @return mixed
     */
    public function getGateway($name);

    /**
     * 电脑支付
     *
     * @param $param
     * @return mixed
     */
    public function web($param);

    /**
     * 手机网站支付
     *
     * @param $param
     * @return mixed
     */
    public function wap($param);

    /**
     * APP 支付
     *
     * @param $param
     * @return mixed
     */
    public function app($param);

    /**
     * 扫码支付
     *
     * @param $param
     * @return mixed
     */
    public function scan($param);

}