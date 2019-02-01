<?php
include_once 'config.php';
include_once 'include/function.inc.php'; 
$action=$_POST['action'];
switch($action)
{
    case "removePublisher":
   $publisID=$_POST['publisID'];
   $delete ="DELETE FROM `publisher` WHERE par_id='$publisID'";
   db_query($delete); 
   echo 1;
    break;    
    
}
?>

