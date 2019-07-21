<?php

namespace Hongyukeji\LaravelPayment\Traits;


trait GatewayTrait
{
    /**
     * 判断给定字符串是否以给定的子字符串开头。
     *
     * @param $haystack
     * @param $needles
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string)$needle) {
                return true;
            }
        }
        return false;
    }

    /**
     * 判断给定字符串是否以给定的子字符串结尾。
     *
     * @param $haystack
     * @param $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if (substr($haystack, -strlen($needle)) === (string)$needle) {
                return true;
            }
        }
        return false;
    }
}