<?php

namespace Hongyukeji\LaravelPayment\Gateways;

use Hongyukeji\LaravelPayment\Interfaces\PaymentGatewayInterface;
use Hongyukeji\LaravelPayment\Traits\GatewayTrait;
use Illuminate\Config\Repository;
use Omnipay\Omnipay;

class Alipay implements PaymentGatewayInterface
{
    use GatewayTrait;

    const GATEWAY_DEFAULT = 'Alipay_Express';   // 默认
    const GATEWAY_WEB = 'Alipay_AopPage';   // 电脑
    const GATEWAY_WAP = 'Alipay_AopWap';   // 手机
    const GATEWAY_APP = 'Alipay_AopApp';   // App
    const GATEWAY_SCAN = 'Alipay_AopF2F';   // 扫码

    protected $config;

    public function __construct(...$args)
    {
        $this->config = new Repository($args[0]);
    }

    public function getGateway($name = self::GATEWAY_DEFAULT)
    {
        $gateway = Omnipay::create($name);
        $gateway->setSignType('RSA2'); // RSA/RSA2/MD5
        $gateway->setAppId($this->config->get('options.app_id'));
        $gateway->setPrivateKey($this->config->get('options.private_key'));
        $gateway->setAlipayPublicKey($this->config->get('options.ali_public_key'));
        if (self::startsWith($name, ['Alipay_Express', 'Alipay_AopPage', 'Alipay_AopWap'])) {
            $gateway->setReturnUrl($this->config->get('options.return_url'));
        }
        $gateway->setNotifyUrl($this->config->get('options.notify_url'));
        return $gateway;
    }

    public function web($param)
    {
        $response = $this->getGateway(self::GATEWAY_WEB)->purchase()->setBizContent($param)->send();
        return $response->getRedirectUrl();
    }

    public function wap($param)
    {
        $response = $this->getGateway(self::GATEWAY_WAP)->purchase()->setBizContent($param)->send();
        return $response->getRedirectUrl();
    }

    public function app($param)
    {
        $response = $this->getGateway(self::GATEWAY_APP)->purchase()->setBizContent($param)->send();
        return $response->getOrderString();
    }

    public function scan($param)
    {
        $response = $this->getGateway(self::GATEWAY_SCAN)->purchase()->setBizContent($param)->send();
        return $response->getQrCode();  // $response->getAlipayResponse() 显示支付服务商返回信息
    }

}