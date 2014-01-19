<?php
/**
 * User: daisy
 * Date: 14-1-10
 * Time: 下午9:45
 */

namespace glob\config;


abstract class Config {
    protected abstract function prod();

    protected function dev() {
        return array();
    }

    /**
     * @return Config
     */
    private static function instance() {
        return new static();
    }

    /**
     * @return mixed
     */
    public static function get() {
        $keys = func_get_args();
        $prod = static::instance()->prod();

        $appId = getenv('BAE_ENV_APPID');
        if (empty($appId) && !defined('BAE_ENV_APPID')) {
            $dev = static::instance()->dev();
            $value = static::load($dev, $keys);
            if (!is_null($value)) {
                return $value;
            }
        }
        return static::load($prod, $keys);
    }

    private static function load($config, $keys) {
        foreach ($keys as $key) {
            if (isset($config[$key])) {
                $config = $config[$key];
            } else {
                return null;
            }
        }
        return $config;
    }
} 