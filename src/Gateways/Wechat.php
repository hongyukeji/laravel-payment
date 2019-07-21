<?php

namespace Hongyukeji\LaravelPayment\Gateways;

use Hongyukeji\LaravelPayment\Interfaces\PaymentGatewayInterface;
use Illuminate\Config\Repository;

class Wechat implements PaymentGatewayInterface
{
    protected $config;

    public function __construct(...$args)
    {
        $this->config = new Repository($args[0]);
    }

    /**
     * 获取支付网关
     *
     * @param $name
     * @return mixed
     */
    public function getGateway($name)
    {
        // TODO: Implement getGateway() method.
    }

    /**
     * 电脑支付
     *
     * @param $param
     * @return mixed
     */
    public function web($param)
    {
        // TODO: Implement web() method.
    }

    /**
     * 手机网站支付
     *
     * @param $param
     * @return mixed
     */
    public function wap($param)
    {
        // TODO: Implement wap() method.
    }

    /**
     * APP 支付
     *
     * @param $param
     * @return mixed
     */
    public function app($param)
    {
        // TODO: Implement app() method.
    }

    /**
     * 扫码支付
     *
     * @param $param
     * @return mixed
     */
    public function scan($param)
    {
        // TODO: Implement scan() method.
    }

}