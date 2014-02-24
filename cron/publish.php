<?php
/**
 * User: daisy
 * Date: 14-2-8
 * Time: 下午5:23
 */
require_once __DIR__ . '/env.php';



$tpl = <<<EOF
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>自由人</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


    <style type="text/css">
        body {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row text-center">
            %s
        </div>
    </div>
</body>
</html>
EOF;

$jobTpl = <<<EOF
<a href="%s#/jobs/%s/%s" style="text-decoration: none;">
    <div class="col-lg-4 col-md-12 hero-feature">
        <div class="thumbnail">
            <img src="%s">
            <div class="caption">
                <h3>%s</h3>
                <p>%s</p>
            </div>
        </div>
    </div>
</a>
EOF;


$job = new \service\Job();
$user = new \service\User();
$categories = \glob\config\source\_37Signals::get('categories');
foreach ($categories as $category => $_) {
    $subscribers = $user->subscribers($category, \service\User::FROM_EMAIL);
    if (empty($subscribers)) {
        continue;
    }
    $items = $job->gets($category, 5, TIME - 86400 * 7);
    if (empty($items)) {
        continue;
    }
    $jobHtml = '';
    foreach ($items as $item) {
        $jobHtml .= sprintf($jobTpl,
            'http://telework.duapp.com',
            $category, $item['id'],
            $item['picUrl'],
            $item['title'],
            $item['pubTime']
        );
    }

    $jobsHtml = '';
    $jobsHtml = sprintf($tpl, $jobHtml);
    $result = \util\Mail::publish($jobsHtml, $subscribers);
    \util\Log::Debug('publish', $category, $result);
}