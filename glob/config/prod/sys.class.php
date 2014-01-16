<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午9:46
 */

namespace glob\config\prod;


use glob\config\Config;

class Sys implements Config{
    public static function config()
    {
        return array(
            "salt" => "w#@!E!c#%@%&",
        );
    }

} 