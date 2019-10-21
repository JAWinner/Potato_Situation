<?php
//TESTING THIS FILE DELETE AFTER 
class errorLogger
{
  private $fp;
  
  public function __construct($outputfile = "/home/tmp1/error.log")
  {
    $this->fp = fopen($outputfile,"a");
  }
  public function log($message)
  {
    fwrite($this->fp,$message.PHP_EOL);
  }
  public function __destruct()
  {
    fclose($this->fp);
  }
  //TESTING THIS FILE DELETE AFTER 

  
  public function logArray($info){
  $request = array();
  $request['type'] = "error";
  $request['error'] = $info;
  
  return $request;
  }
  
}
?>