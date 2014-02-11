<?php
/**
 * User: jackong
 * Date: 2/11/14
 * Time: 10:06 AM
 */
require_once __DIR__ . "/../bootstrap.php";

\util\Log::setLogger(
    new \common\Logger(
        new \common\writer\FileWriter('/home/bae/log/cron.log.' . DATE, 'a')
    )
);