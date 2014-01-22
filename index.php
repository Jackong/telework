<?php
//app env
require_once("bootstrap.php");

//slim env
require PROJECT . '/lib/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();


//twig env
require_once PROJECT . '/lib/Twig/Autoloader.php';
Twig_Autoloader::register(true);


$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig(),
    'debug' => \glob\config\Sys::get('debug'),
    'templates.path' => PROJECT . '/tpl',
));

\util\Log::setLogger(
    new \common\Logger(
        new \common\writer\FileWriter('/home/bae/log/user.log.' . DATE, 'a'),
        \glob\config\Service::get('log', 'level')
    )
);

$app->error(function(Exception $e) use($app) {
    \util\Log::Fatal($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    $app->halt(500, "sorry! server error");
});

$view = $app->view();
$view->parserOptions = array(
    'charset' => 'utf-8',
    'debug' => \glob\config\Sys::get('debug'),
    'cache' => '/home/bae/cache',
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);

$view->parserExtensions = array(
    new \Slim\Views\TwigExtension(),
);

session_start();

list(, $group, $router) = explode('/', $app->request()->getResourceUri());
$app->group("/$group", function() use ($group, $router, $app) {
    $router = ucfirst($router);
    $routerFile = PROJECT . "/router/$group/$router.php";
    if (file_exists($routerFile)) {
        require_once $routerFile;
    }
});

$app->run();
