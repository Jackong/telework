<?php
/**
 * User: daisy
 * Date: 14-1-25
 * Time: 上午11:48
 */

namespace router\light;


use service\Job;
use Slim\Slim;
use util\Input;

class Jobs {

    public function jobs($categoryId) {
        if ($categoryId == 0) {
            $categoryId = 2;
        }
        $job = new Job();
        echo json_encode($job->gets($categoryId, 10));
    }
}

Slim::getInstance()
    ->get('/jobs/:categoryId', array(new Jobs(), 'jobs'))
    ->conditions(array('categoryId' => '[0-9]{1,5}'));