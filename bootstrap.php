<?php
function loader($className) {
	$file = strtolower(str_replace("\\", "/", $className));	
	require_once "$file.class.php";
}

spl_autoload_register("loader");
