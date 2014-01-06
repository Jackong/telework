<?php
require_once("bootstrap.php");
$response = \util\Mapper::handle($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);
$formatter = \util\Factory::formatter($_SERVER["HTTP_ACCEPT"]);

$formatter->output($response);