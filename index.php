<?php
require_once("bootstrap.php");
require PROJECT . '/lib/slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();


require_once PROJECT . '/lib/Twig/Autoloader.php';
Twig_Autoloader::register(true);


$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig(),
    'debug' => true,
    'templates.path' => PROJECT . '/tpl'
));


$view = $app->view();
$view->parserOptions = array(
    'debug' => true,
    'cache' => '/home/bae/cache'
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

session_start();

$app->group('/light', function() use($app) {

    $app->get("/app", function() use($app){
        \util\Log::Trace($_SERVER["REMOTE_ADDR"], $_SERVER['HTTP_USER_AGENT']);
        $job = new \service\Job();
        $items = $job->gets(2, 10);
        $categories = \glob\config\Loader::load("source._37signals|categories");
        foreach ($categories as $id => $category) {
            $categories[$id] = $category["lang"][1];
        }
        $app->render('light/app.html', array('categories' => $categories, 'jobs' => $items));
    });

    $app->post('/subscription', function() use($app) {
        $email = \util\Input::get("email", "/([\w\-]+\@[\w\-]+\.[\w\-]+)/");
        $position = \util\Input::get("position", "/(.+?){1,15}/");

        $category = \glob\config\Loader::load("source._37signals|categories.$position.lang.1");

        if (is_null($category)) {
            return;
        }

        $user = new \service\User();
        $user->subscribe(strtolower($email), "email");

        $id = \util\Encrypt::encrypt($email, \glob\config\Loader::load("sys|salt"));
        \util\Bcms::mail(
            "自由人远程职位订阅确认",
            "<!--HTML-->您好，您在<a href='http://telework.duapp.com/app/light'>自由人</a>上订阅了 '$category' 职位。<br>
            如有您需要的职位，我们将会第一时间通知你。请点击以下链接，确认激活订阅（如非本人操作，请匆点击）：<br>
            <a href='http://telework.duapp.com/light/confirm/$id/$email/$position'>确认订阅</a>",
            array($email));
    });


    $app->get('/confirm/:id/:email/:category', function($id, $email, $category) use($app) {
        $deEmail = \util\Encrypt::decrypt($id, \glob\config\Loader::load("sys|salt"));

        $ok = ($email === $deEmail);

        if ($ok) {
            $categoryName = \glob\config\Loader::load("source._37signals|categories.$category.lang.1");
            if (is_null($categoryName)) {
                $app->flash("failure", "抱歉，您订阅的职位不存在，请重新订阅。");
            } else {
                $app->flash("success", "恭喜您订阅成功，稍候将第一时间为您送上 $categoryName 相关信息。");
                $user = new \service\User();
                $user->subscribe(strtolower($email), "email", $category);
            }
        } else {
            $app->flash("failure", "订阅确认失败，这不是你的邮箱。");
        }

        \util\Log::Trace($email, $ok);

        $categories = \glob\config\Loader::load("source._37signals|categories");
        foreach ($categories as $id => $cate) {
            $categories[$id] = $cate["lang"][1];
        }

        $job = new \service\Job();
        $items = $job->gets(2, 10);
        $app->render('light/app.html', array('categories' => $categories, 'jobs' => $items));
    })->conditions(
            array(
            'email' => '([\w\-]+\@[\w\-]+\.[\w\-]+)',
            'category' => '[0-9]{1}',
            )
        );
});

$app->run();