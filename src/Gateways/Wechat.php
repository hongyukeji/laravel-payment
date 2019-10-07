<?php

namespace Hongyukeji\LaravelPayment\Gateways;

use Hongyukeji\LaravelPayment\Interfaces\PaymentGatewayInterface;
use Illuminate\Config\Repository;
use Omnipay\Omnipay;

class Wechat implements PaymentGatewayInterface
{
    const GATEWAY_DEFAULT = 'Wechat_Express';   // 默认
    const GATEWAY_WEB = 'WechatPay';   // 电脑
    const GATEWAY_WAP = 'WechatPay_Mweb';   // 手机
    const GATEWAY_APP = 'WechatPay_App';   // App
    const GATEWAY_SCAN = 'WechatPay_Native';   // 扫码

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
    public function getGateway($name = self::GATEWAY_DEFAULT)
    {
        $gateway = Omnipay::create($name);
        $gateway->setAppId($this->config->get('options.app_id'));
        $gateway->setMchId($this->config->get('options.mch_id'));
        $gateway->setApiKey($this->config->get('options.api_key'));
        $gateway->setNotifyUrl($this->config->get('options.notify_url'));
        return $gateway;
    }

    /**
     * 电脑支付
     *
     * @param $param
     * @return mixed
     */
    public function web($param)
    {
        $response = $this->getGateway(self::GATEWAY_SCAN)->purchase($param)->send();
        return $response->getCodeUrl();
    }

    /**
     * 手机网站支付
     *
     * @param $param
     * @return mixed
     */
    public function wap($param)
    {
        $response = $this->getGateway(self::GATEWAY_WAP)->purchase()->setBizContent($param)->send();
        return $response->getRedirectUrl();
    }

    /**
     * APP 支付
     *
     * @param $param
     * @return mixed
     */
    public function app($param)
    {
        $response = $this->getGateway(self::GATEWAY_APP)->purchase()->setBizContent($param)->send();
        return $response->getOrderString();
    }

    /**
     * 扫码支付
     *
     * @param $param
     * @return mixed
     */
    public function scan($param)
    {
        $response = $this->getGateway(self::GATEWAY_SCAN)->purchase()->setBizContent($param)->send();
        return $response->getQrCode();  // $response->getAlipayResponse() 显示支付服务商返回信息
    }

}
