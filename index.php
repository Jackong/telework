<?php
require_once("bootstrap.php");

$formatter = \common\Factory::formatter($_SERVER["HTTP_ACCEPT"]);
$mapper = new \common\Mapper();
$response = $mapper->handle($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);
$formatter->output($response);