<?php
require_once ( "../Bcms.class.php" ) ;

$accessKey = 'your access key';
$secretKey = 'your secret key';
$host = 'bcms.api.duapp.com';

function error_output ( $str ) 
{
	echo "\033[1;40;31m" . $str ."\033[0m" . "\n";
}

function right_output ( $str ) 
{
    echo "\033[1;40;32m" . $str ."\033[0m" . "\n";
}


function test_createQueue ( $queueType, $queueAliasName, $apiVersion ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	//可选参数
	$optional [ Bcms::VERSION ] = $apiVersion;
	//$optional [ Bcms::QUEUE_TYPE ] = $queueType;
	$optional [ Bcms::QUEUE_TYPE ] = '';
	$optional [ Bcms::QUEUE_ALIAS_NAME ] = $queueAliasName;
	
	$ret = $bcms->createQueue ( $optional ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}
}

function test_dropQueue ( $queueName ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->dropQueue ( $queueName ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_subscribeQueue ( $queueName, $destination ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->subscribeQueue ( $queueName, $destination ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_unsubscribeQueue ( $queueName, $destination ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->unsubscribeQueue ( $queueName, $destination ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_unsubscribeAllQueue ( $queueName ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->unsubscribeAllQueue ( $queueName ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_grantQueue ( $queueName, $label, $user, $usertype, $actions ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->grantQueue ( $queueName, $label, $user, $usertype, $actions ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_revokeQueue ( $queueName, $label ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->revokeQueue ( $queueName, $label ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_suspendQueue ( $queueName ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->suspendQueue ( $queueName ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_resumeQueue ( $queueName ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->resumeQueue ( $queueName ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_confirmQueue ( $queueName, $token, $destination ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->confirmQueue ( $queueName, $token, $destination ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_cancelQueue ( $queueName, $token, $destination ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->cancelQueue ( $queueName, $token, $destination ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_publishMessage ( $queueName, $message ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->publishMessage ( $queueName, $message ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_publishMessages ( $queueName, $message ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->publishMessages ( $queueName, $message ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_fetchMessage ( $queueName ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	//$optional [ Bcms::MSG_ID ] = 1;
	$optional [ Bcms::FETCH_NUM ] = 2;
	$ret = $bcms->fetchMessage ( $queueName, $optional ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_mail ( $queueName, $message, $address ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->mail ( $queueName, $message, $address ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_sms ( $queueName, $message, $address ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->sms ( $queueName, $message, $address ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_deleteMessageById ( $queueName, $msgId ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->deleteMessageById ( $queueName, $msgId ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}

function test_deleteMessagesByIds ( $queueName, $msgIds ) 
{
	global $accessKey, $secretKey, $host;
	$bcms = new Bcms ( $accessKey, $secretKey, $host ) ;
	$ret = $bcms->deleteMessagesByIds ( $queueName, $msgIds ) ;
	if ( false === $ret ) 
	{
		error_output ( 'WRONG, ' . __FUNCTION__ . ' ERROR!!!!!' ) ;
		error_output ( 'ERROR NUMBER: ' . $bcms->errno ( ) ) ;
		error_output ( 'ERROR MESSAGE: ' . $bcms->errmsg ( ) ) ;
		error_output ( 'REQUEST ID: ' . $bcms->getRequestId ( ) );
	}
	else
	{
		right_output ( 'SUCC, ' . __FUNCTION__ . ' OK!!!!!' ) ;
		right_output ( 'result: ' . print_r ( $ret, true ) ) ;
	}	
}


//test_createQueue ( 1, 'test queue for phpsdk', 1.0 ) ;
//test_dropQueue ( 'cf80e6235f90c60c1251f93d1c7adcc0' ) ;
//test_dropQueue ( 'aaas\%\^\&\*9测试\-\-  asd\;l\;lltg' ) ;
//test_subscribeQueue ( 'cac14cfd2aed0daf19b1a3b128cf59a2', 'http://bcmsaccept.baidu.com' ) ;
//test_unsubscribeQueue ( 'cac14cfd2aed0daf19b1a3b128cf59a2', 'http://bmsaccept.baidu.com' ) ;
//test_unsubscribeAllQueue ( 'cac14cfd2aed0daf19b1a3b128cf59a2' ) ;
//test_grantQueue ( '2b9f3bd4f6650be0a66ef16d70fecf46', 'mylabel2', mb_convert_encoding('李彦宏test', 'utf-8', 'gbk'), 1, ' [ "drop","subscribe","grant","revoke" ] ' ) ;
//test_revokeQueue ( 'cac14cfd2aed0daf19b1a3b128cf59a2', 'mylabel' ) ;
//test_suspendQueue ( '3bb43b852a6a4808449b5ac817b98955' ) ;
//test_resumeQueue ( '3bb43b852a6a4808449b5ac817b98955' ) ;
//test_confirmQueue ( 'cac14cfd2aed0daf19b1a3b128cf59a2', 'ec91408a4e3136965bbae8a64f18f0e1', 'http://bcmsaccept.baidu.com' ) ;
//test_cancelQueue ( 'cac14cfd2aed0daf19b1a3b128cf59a2', 'ec91408a4e3136965bbae8a64f18f0e1', 'http://bcmsaccept.baidu.com' ) ;
//test_publishMessage ( 'cac14cfd2aed0daf19b1a3b128cf59a2', 'xxxxxxxxxxxxxxxxxxxxxx' ) ;
//test_publishMessages ( 'cac14cfd2aed0daf19b1a3b128cf59a2', array("xxxx", "yyyy", "zzzz", "ddddd","wwwww")) ;
//test_fetchMessage ( '6a91b263c1b05eed1fc7b7f745dfde04' ) ;
//test_mail ( 'cac14cfd2aed0daf19b1a3b128cf59a2', "测试邮件内容", array("xxxx@baidu.com", "yyyy@qq.com") ) ;
//test_sms ( 'cac14cfd2aed0daf19b1a3b128cf59a2', '测试短信内容', array("123456789", "13812341234" )) ;
//test_deleteMessageById ( '6a91b263c1b05eed1fc7b7f745dfde04', 4 ) ;
//test_deleteMessagesByIds ( '6a91b263c1b05eed1fc7b7f745dfde04', ' [ 4, 5, 6 ] ' ) ;
?>
