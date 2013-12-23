<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:33
 */

require_once "BaeLog.class.php";
$secret = array("user"=>\ServiceConf::$aksk['ak'],"passwd"=>ServiceConf::$aksk['sk'] );

$log = BaeLog::getInstance($secret);
if(NULL !=  $log)
{
    $log->setLogLevel(16);
    for($i=0;$i<3;$i++)
    {
        $ret = $log->Notice("log ok!");
        if(false === $ret)
        {
            $code = $log->getResultCode();
            echo "$code<br/>";
        }else{
            echo "Success<br/>";
        }
    }
}