<?php
/**
 * User: daisy
 * Date: 14-1-25
 * Time: 上午11:48
 */

namespace router\light;


use service\Job;
use Slim\Slim;

class Jobs {

    public function jobs() {
        $job = new Job();
        echo json_encode($job->gets(2, 10));
    }
}

Slim::getInstance()->get('/jobs', array(new Jobs(), 'jobs'));