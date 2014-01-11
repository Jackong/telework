<?php
/**
 * User: daisy
 * Date: 14-1-10
 * Time: 下午9:42
 */

namespace glob\config;


class Loader {
    public static function load($keys) {
        if (strpos($keys, "|") !== false) {
            list($module, $keys) = explode("|", $keys);
            $keys = explode(".", $keys);
        } else {
            $module = $keys;
            $keys = array();
        }

        $object = self::prefix($module);
        $config = $object::config();
        foreach ($keys as $key) {
            if (!isset($config[$key])) {
                return null;
            }
            $config = $config[$key];
        }
        return $config;
    }

    /**
     * @param $module Config
     * @return mixed
     */
    private static function prefix($module) {
        $module = str_replace(".", "\\", $module);
        $formal = "\\glob\\config\\";
        $namespace = $formal;
        $appId = getenv('BAE_ENV_APPID');
        if (empty($appId) && !defined('BAE_ENV_APPID')) {
            $devConfig = PROJECT . str_replace("\\", "/", $namespace . "dev/$module.class.php");
            if (file_exists($devConfig)) {
                 return $namespace ."dev\\$module";
            }
        }
        return $namespace . "prod\\$module";
    }
} 