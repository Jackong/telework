<?php
namespace router\test;

use router\Router;
use util\Bcs;
use util\Input;
use util\Log;

class Test extends Router {

	public function get() {
        Log::Notice("test get");

        $bcs = Bcs::instance();
        $opt["acl"] = \BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ;
        $opt ['curlopts'] = array (
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 1800 );
        $response = $bcs->create_object(
            "telework-jobs",
            "/test.jpeg",
            PROJECT . "/static/remote0.jpeg",
            $opt
        );
        return $response->isOK();
    }

	public function post() {
        Log::Notice("test post");
        $param = Input::get("param");
        return array(
            "test",
            array(
                "title" => "php tpl",
                "param" => $param,
                "ext" => "test tpl"
            )
        );
	}
}
