<?php

namespace glob\config\dev;
use glob\config\Config;

class Service implements Config {
    public static function config() {
        return array(
            "app_id" => 1959167,
            "ak" => 'GXTnHcjgvKPIl1MKbdxnmcQK',
            "sk" => '2RGpR7kuue9wCQX4oFHL8hXYnE2zpsg4',
            "log" => array(
                "level" => 16,
                "distributed" => false,
            ),
            "mongo" => array(
                "user" => array(
                    'dbname' => 'user',
                    'host' => '127.0.0.1',
                    'port' => '27017',
                ),
                "job" => array(
                    "dbname" => "job",
                    'host' => '127.0.0.1',
                    'port' => '27017',
                ),
            )
        );
    }
}
