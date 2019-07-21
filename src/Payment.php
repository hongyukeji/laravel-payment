<?php

namespace Hongyukeji\LaravelPayment;

use ReflectionClass;
use Illuminate\Config\Repository;
use Illuminate\Support\Collection;
use Hongyukeji\LaravelPayment\Exceptions\PaymentException;

class Payment
{
    protected $config;

    public function __construct(array $config = [])
    {
        return $this->config = new Repository($config);
    }

    function __call($name, $arguments)
    {
        $className = $this->config->get("gateways.{$name}.driver");
        $class = new ReflectionClass($className);
        return $class->newInstance($this->config->get("gateways.{$name}"));
    }
}