<?php
require_once("bootstrap.php");
$formatter = \util\Factory::formatter($_SERVER["HTTP_ACCEPT"]);
$response = \util\Mapper::handle($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);

$formatter->output($response);