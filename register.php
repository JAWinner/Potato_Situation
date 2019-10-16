<?php

//Check for any errors
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

//Grab required files 
session_start();
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "register";
}
//Get Username + Password
$request = array();
$request['type'] = "register";
$request['username'] = $_POST['username'];
$request['password'] = $_POST['pass'];
$request['message'] = $msg;


$response = $client->send_request($request);
//echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";
header("refresh:3;url=index.html");
?>