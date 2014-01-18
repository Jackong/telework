<?php
define("PROJECT", __DIR__);
require_once "glob/time.php";

function loader($className) {
    list($namespace) = explode("\\", $className);
    if (in_array($namespace, array("service", "glob", "util", "cron", "common"))) {
        $file = strtolower(str_replace("\\", "/", $className));
        require_once PROJECT . "/$file.php";
    }
}

spl_autoload_register("loader");
