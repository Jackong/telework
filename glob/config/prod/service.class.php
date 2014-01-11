<?php

namespace glob\config\prod;
use glob\config\Config;

class Service implements Config {
    public static function config() {
        return array(
            "app_id" => 1959167,
            "ak" => 'GXTnHcjgvKPIl1MKbdxnmcQK',
            "sk" => '2RGpR7kuue9wCQX4oFHL8hXYnE2zpsg4',
            "log" => array(
                "level" => 16,
            ),
            "mongo" => array(
                "user" => array(
                    'dbname' => 'RGFauSekXKrYgGCstaDB',
                    'host' => 'mongo.duapp.com',
                    'port' => '8908',
                ),
                "job" => array(
                    "dbname" => "XcdWGBMKMFLUcjNuLMzI",
                    'host' => 'mongo.duapp.com',
                    'port' => '8908',
                ),
            )
        );
    }
}
