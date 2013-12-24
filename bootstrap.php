<?php
define("PROJECT", __DIR__);
require_once "global/configure.php";
require_once "global/time.php";

require_once "util/log.php";

function loader($className) {
	$file = strtolower(str_replace("\\", "/", $className));	
	require_once "$file.class.php";
}

spl_autoload_register("loader");
