<?php
/**
 * User: daisy
 * Date: 14-1-16
 * Time: 下午9:46
 */

namespace glob\config;


class Sys extends Config{
    protected function prod()
    {
        return array(
            "salt" => "w5#2%*s&",
            'debug' => false,
        );
    }

    protected function dev() {
        return array(
            'debug' => true,
        );
    }

} 