<?php
//include_once 'auth.php';  
function write_log($datetime,$action,$username)
{
	  $username="By-".$username;
	   //$datetime; echo $systemname; echo $transcoder; echo  $type; echo $action;  echo $username;
	   $log_file_name='files/logs.txt';
	   //if($transcoder==''){ $transcoder="  ";}
	   $str= "$datetime,$action,$username".PHP_EOL;
       $fp = fopen($log_file_name,'a');
       fwrite($fp,($str));
       fclose($fp);
	  
}