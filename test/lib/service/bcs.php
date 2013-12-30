<?php
/**
 * User: daisy
 * Date: 13-12-28
 * Time: 下午4:36
 */

namespace test\lib\service;


use util\Bcs;

class BcsTest extends \PHPUnit_Framework_TestCase {

    public function testCreateObject(){
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
        var_export($response);
    }
}
 