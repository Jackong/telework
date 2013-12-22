<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:33
 */

require_once "../lib/service/sdk/BaeLog.class.php";

$user = \ServiceConf::$aksk['ak'];
$pwd = \ServiceConf::$aksk['sk'];
$level = \ServiceConf::$log_cfg['level'];
$log = \BaeLog::getInstance(array('user'=>$user, 'passwd'=> $pwd));
$log->setLogLevel($level);