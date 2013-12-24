<?php
/**
 * User: daisy
 * Date: 13-12-24
 * Time: 上午9:07
 */

define("TIME", $_SERVER["REQUEST_TIME"]);
define("NOW", date("Y-m-d H:i:s", TIME));
define("DATE", date("Y-m-d", TIME));