<?php
/**
 * User: daisy
 * Date: 14-2-8
 * Time: 下午5:23
 */
require_once __DIR__ . '/env.php';

$job = new \service\Job();
$user = new \service\User();
$categories = \glob\config\source\_37Signals::get('categories');
foreach ($categories as $category => $_) {
    $ids = $user->subscribers($category, \service\User::FROM_EMAIL);
    if (empty($ids)) {
        continue;
    }
    $body = file_get_contents("http://telework.duapp.com/#/jobs/$category");
    \util\Mail::publish($body, $ids);
}


