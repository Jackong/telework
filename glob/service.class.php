<?php

namespace glob;

class Service{

    public static $app_id = 1959167;
	/***Api Key and Secret Key***/
    public static $ak = 'GXTnHcjgvKPIl1MKbdxnmcQK';
    public static $sk = '2RGpR7kuue9wCQX4oFHL8hXYnE2zpsg4';

	/***Mongo数据库配置***/
	public static $mongo_cfg = array(
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
	);
	/***Log(日志服务)配置***/
	public static $log_cfg = array(
			'level' => 16,
	);
}

class Wording {
    public static $developing = "功能开发中，敬请期待。如有疑问:JackongC@gmail.com";
}
