<?php
//app env
require_once("bootstrap.php");

//slim env
require PROJECT . '/lib/slim/Slim/Slim.php';
\Slim\Slim::registerAutoloader();


$app = new \Slim\Slim(array(
    'debug' => \glob\config\Sys::get('debug'),
    'cookies.encrypt' => true,
    'cookies.secret_key' => '$3@T^4x)',
    'cookies.cipher' => MCRYPT_RIJNDAEL_256,
    'cookies.cipher_mode' => MCRYPT_MODE_CBC
));

$app->add(new \Slim\Middleware\ContentTypes());
$app->add(new \common\middleware\Response(
    function() {
        return new \common\parser\Json();
    },
    array(
        'application/json' => function() {
            return new \common\parser\Json();
        },
        'text/html' => function() {
            return new \common\parser\Text();
        },
        'text/xml' => function() {
            return new \common\parser\Xml();
        }
    )
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

$request = $app->request();
$paths = explode('/', $request->getResourceUri());
if (count($paths) < 3) {
    \util\Log::Fatal("Invalid request path", $request->getResourceUri(), $request->getIp(), $request->getUserAgent());
    $app->status(404);
    \util\Output::error("Not found", \util\Output::CODE_FAILURE);
} else {
    list(, $group, $router) = $paths;
    $app->group("/$group", function() use ($group, $router, $app) {
        $router = ucfirst($router);
        $routerFile = PROJECT . "/router/$group/$router.php";
        if (file_exists($routerFile)) {
            require_once $routerFile;
        }
    });
}

$app->run();
