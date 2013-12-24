<?php
/**
 * User: daisy
 * Date: 13-12-22
 * Time: 下午7:33
 */

require_once PROJECT . "/lib/service/log/BaeLog.class.php";
class Log {
    private static $log;
    public static function instance() {
        if (isset(self::$log)) {
            return self::$log;
        }
        $secret = array("user"=> ServiceConf::$aksk['ak'],"passwd"=>ServiceConf::$aksk['sk']);
        if (!defined("BAE_ENV_LOG_HOST")) {
            self::$log = new LocalLog($secret);
        } else {
            self::$log = BaeLog::getInstance($secret);
        }
        self::$log->setLogLevel(ServiceConf::$log_cfg["level"]);
        return self::$log;
    }

    public static function Fatal($logmsg)
    {
        return self::instance()->Fatal($logmsg);
    }

    public static function Warning($logmsg)
    {
        return self::instance()->Warning($logmsg);
    }

    public static function Notice($logmsg)
    {
        return self::instance()->Notice($logmsg);
    }

    public static function Trace($logmsg)
    {
        return self::instance()->Trace($logmsg);
    }

    public static function Debug($logmsg)
    {
        return self::instance()->Debug($logmsg);
    }
}

class LocalLog extends BaeLog {
    private $file;
    public function __construct($secret)
    {
        $this->file = fopen("/home/bae/log/user.log", "a");
    }

    public function __destruct()
    {
        fclose($this->file);
    }

    private function log($level, $msg) {
        fwrite($this->file, "$level " . NOW . " - $msg\n");
        return true;
    }

    public function Fatal($logmsg)
    {
        return $this->log(1, $logmsg);
    }

    public function Warning($logmsg)
    {
        return $this->log(2, $logmsg);
    }

    public function Notice($logmsg)
    {
        return $this->log(4, $logmsg);
    }

    public function Trace($logmsg)
    {
        return $this->log(8, $logmsg);
    }

    public function Debug($logmsg)
    {
        return $this->log(16, $logmsg);
    }

}