<?php
require_once("bootstrap.php");
require PROJECT . '/lib/slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();


require_once PROJECT . '/lib/Twig/Autoloader.php';
Twig_Autoloader::register(true);


$app = new \Slim\Slim(array(
    'view' => new \Slim\Views\Twig(),
    'debug' => false,
    'templates.path' => PROJECT . '/tpl'
));

$app->error(function(Exception $e) use($app) {
    \util\Log::Fatal($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
    $app->halt(500, "sorry! server error");
});

$view = $app->view();
$view->parserOptions = array(
    'debug' => false,
    'cache' => '/home/bae/cache'
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
