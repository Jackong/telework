<?php
/**
 * User: daisy
 * Date: 14-1-25
 * Time: 上午11:48
 */

namespace router\light;


use glob\config\source\_37Signals;
use service\Job;
use Slim\Slim;
use util\Input;
use util\Log;
use util\Output;

class Jobs {

    public function jobs($categoryId) {
        $app = Slim::getInstance();
        $request = $app->request();
        $tcId = $app->getCookie('tc_id');
        if (is_null($tcId) || empty($tcId) || strlen($tcId) != 32) {
            $tcId = md5($request->getIp() . $request->getUserAgent());
            $app->setCookie('tc_id', $tcId, '30 days', '/');
        }
        Log::Debug($tcId, $categoryId, $request->getIp(), $request->getUserAgent());

        if ($categoryId == 0) {
            $categoryId = 2;
        }

        $job = new Job();
        Output::set(
            array(
                'jobs' => $job->gets($categoryId, 10),
            ));
        Output::ok();
    }

    public function job($category, $id) {
        $job = new Job();
        $item = $job->get($id);
        if (is_null($item)) {
            Output::warning('该信息已过期');
            return;
        }
        Output::set(
            array(
                'job' => $item,
            )
        );
        Output::ok();
    }
}

Slim::getInstance()
    ->get('/jobs/:categoryId', array(new Jobs(), 'jobs'))
    ->conditions(array('categoryId' => '[0-9]{1,5}'));
Slim::getInstance()
    ->get('/jobs/:category/:id', array(new Jobs(), 'job'))
    ->conditions(array(
        'category' => '[0-9]{1,5}',
        'id' => '[0-9a-f]{32}'
    ));
