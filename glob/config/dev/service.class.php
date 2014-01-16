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
            ),
            "bcms" => array(
                'host' => 'bcms.api.duapp.com',
                'accessKey' => '10df3b0a61aea4d138a4d248ce4dc7e2',
                'secretKey' => '7fc401c7800a5e78868d1f014b4ec30b',
                'queues' => array(
                    'mail' => '28941cc23c87d58359a71f8f07da3faa',
                )
            ),
        );
    }
}
