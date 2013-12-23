<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:33
 */

require_once PROJECT . "/lib/service/log/BaeLog.class.php";
$secret = array("user"=>\ServiceConf::$aksk['ak'],"passwd"=>ServiceConf::$aksk['sk'] );

global $log;
$log = BaeLog::getInstance($secret);
$log->setLogLevel(ServiceConf::$log_cfg["level"]);
$log->Notice("log ok!");