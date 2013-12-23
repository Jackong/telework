<?php
require_once dirname(__FILE__) . '/BaeLog.class.php';

putenv("BAE_ENV_LOG_HOST=localhost");
putenv("BAE_ENV_LOG_PORT=8080");
putenv("BAE_ENV_APPID=1959167");
$secret = array("user"=>"GXTnHcjgvKPIl1MKbdxnmcQK","passwd"=>"2RGpR7kuue9wCQX4oFHL8hXYnE2zpsg4" );
$log = BaeLog::getInstance($secret);
if(NULL !=  $log)
{
   $log->setLogLevel(16);
    $log->Warning("test try");
   for($i=0;$i<3;$i++)
   {
       $ret = $log->Fatal("lelllllllllllllll");
        if(false === $ret)
        {
            $code = $log->getResultCode();
            echo "$code<br/>";
        }else{
            echo "Success<br/>";
        }
   }
}

