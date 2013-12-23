<?php
require_once dirname(__FILE__) . '/BaeLog.class.php';
$secret = array("user"=>"GXTnHcjgvKPIl1MKbdxnmcQK","passwd"=>"2RGpR7kuue9wCQX4oFHL8hXYnE2zpsg4" );

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

