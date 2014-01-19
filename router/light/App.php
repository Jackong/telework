<?php
/**
 * User: daisy
 * Date: 14-1-5
 * Time: 下午8:37
 */

namespace router\light;


use glob\config\source\_37Signals;
use service\Job;
use Slim\Slim;
use util\Log;


class App {

    public function index() {
        Log::Trace($_SERVER["REMOTE_ADDR"], $_SERVER['HTTP_USER_AGENT']);
        $job = new Job();
        $items = $job->gets(2, 10);
        $categories = _37Signals::get('categories');
        foreach ($categories as $id => $category) {
            $categories[$id] = $category["lang"][1];
        }
        Slim::getInstance()->render('light/app.html', array('categories' => $categories, 'jobs' => $items));
    }

}

Slim::getInstance()->get("/app", array(new App(), 'index'));
