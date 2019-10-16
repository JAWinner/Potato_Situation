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
$request['type'] = "login";
$request['username'] = $_POST['username'];
$request['password'] = $_POST['pass'];
$request['message'] = $msg;


$response = $client->send_request($request);
echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";


if {
	global $mydb;
	//Check to see if the user is already in the database
	$username = $_POST['username'];
	$query = mysqli_query($mydb,"SELECT username FROM user WHERE username='$username'");
	$count = mysqli_num_rows($query);
	
	//If pre-exsiting usernmae is found
	if ($count == 1)
	{
		header("location:regerror.html");
		return true;
	}
	//If username is not found insert into the table
	else 
	{
		$query = mysqli_query($mydb, "INSERT INTO user (username, password) VALUES ('$username','$password')");
		$user = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
		header("location:regsuccess.html");
	}
//Catch for all other errors
else ($response == 0 ) {
	$date = date_create();
	header("location:regerror.html");
}
?>