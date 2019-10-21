<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

//Continue listening for any error logs that may come through.
function requestProcessor($request)
{
	//Hopefully this is a common log location for all
	$fp = new errorLogger('/home/tmp1/error.log');
    echo "received request".PHP_EOL;
    var_dump($request);
    $fp->log($request['error']);
    return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

//Connect to rabbit
$server = new rabbitMQServer("rabbitMQErrorLog.ini","testServer");
$server->process_requests('requestProcessor');
exit();
?>