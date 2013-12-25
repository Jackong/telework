<?php
class ServiceConf{

    public static $app_id = 1959167;
	/***Api Key and Secret Key***/
	public static $aksk = array(
			'ak' => 'GXTnHcjgvKPIl1MKbdxnmcQK',
			'sk' => '2RGpR7kuue9wCQX4oFHL8hXYnE2zpsg4',
	);
	/***Mongo数据库配置***/
	public static $mongo_cfg = array(
			'dbname' => 'RGFauSekXKrYgGCstaDB',
			'host' => 'mongo.duapp.com',
			'port' => '8908',		
	);
	/***Log(日志服务)配置***/
	public static $log_cfg = array(
			'level' => 16,
	);
}


