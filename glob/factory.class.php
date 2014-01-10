<?php
/**
 * User: daisy
 * Date: 14-1-10
 * Time: 下午9:42
 */

namespace glob;


class Factory {
    public static function load($keys) {
        $keys = explode(".", $keys);
        if (empty($keys)) {
            return null;
        }

        $namespace = self::prefix($keys[0]);
        /**
         * @var $object Config
         */
        $object = "$namespace$keys[0]";
        $config = $object::config();
        unset($keys[0]);
        foreach ($keys as $key) {
            if (!isset($config[$key])) {
                return null;
            }
            $config = $config[$key];
        }
        return $config;
    }

    private static function prefix($module) {
        $formal = "\\glob\\";
        $namespace = $formal;
        $appId = getenv('BAE_ENV_APPID');
        if (empty($appId) && !defined('BAE_ENV_APPID')) {
            $devConfig = PROJECT . str_replace("\\", "/", $namespace . "dev/$module.class.php");
            if (file_exists($devConfig)) {
                $namespace .= "dev\\";
            }
        }
        return $namespace;
    }
} 