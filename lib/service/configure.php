<?php
class ServiceConf{

	/***Api Key and Secret Key***/
	public static $aksk = array(
			'ak' => 'GXTnHcjgvKPIl1MKbdxnmcQK',
			'sk' => '2RGpR7kuue9wCQX4oFHL8hXYnE2zpsg4',
	);
	/***MySQL数据库配置***/
	public static $mysql_cfg = array(
			'dbname' => 'eiZrxDYAgZRYcJuTRLjT',
			'host' => 'sqld.duapp.com',
			'port' => '4050',		
	);
	/***Mongo数据库配置***/
	public static $mongo_cfg = array(
			'dbname' => 'kcsAwtCZlKiObuXDGKqb',
			'host' => 'mongo.duapp.com',
			'port' => '8908',		
	);
	/***Redis数据库配置***/
	public static $redis_cfg = array(
			'dbname' => 'QTQTzJQhMKcacdjpTIEX',
			'host' => 'redis.duapp.com',
			'port' => '80',		
	);
	/***Image配置***/
	public static $image_cfg = array(
			'host' => 'image.duapp.com',
	);
	/***Cache配置***/
	public static $cache_cfg = array(
			'cacheid' => 'pPdkLzIvgBaHMqYJvQSZ',
			'host' => 'cache.duapp.com',
			'port' => '20243',		
	);
	/***BCS(云存储)配置***/
	public static $bcs_cfg = array(
			'host' => 'bcs.duapp.com',
			'bucket' => 'xxxx',		
	);
	/***Log(日志服务)配置***/
	public static $log_cfg = array(
			'level' => 16,
	);

}


