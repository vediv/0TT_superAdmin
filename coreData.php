<?php
session_start();
if( !isset($_SESSION['super_dasbord_par_id'])){
	header("Location:index.php");
	exit;
}
include_once 'include/function.inc.php';
$munulevel=isset($_POST['munulevel'])?$_POST['munulevel']:'';
$parID=trim($_POST['par_id']); $parEmail=trim($_POST['pemail']);
$query = "SELECT dbName,dbHostName,dbUserName,dbpassword,publisherID from ott_publisher.publisher where acess_level='p' and par_id='".$parID."' and email='".$parEmail."'";
$fetch= db_select($query);
$dbName=$fetch[0]['dbName'];  $dbHostName=$fetch[0]['dbHostName']; 
$dbUserName=$fetch[0]['dbUserName']; $dbpassword=$fetch[0]['dbpassword']; $publisherID=$fetch[0]['publisherID'];  
$clientConnect =  mysqli_connect($dbHostName, $dbUserName, $dbpassword, $dbName);
if(!$clientConnect)    
header ("location:add_menu.php?next=$parID&email=$parEmail&emsg=1"); //die("Unable to connect Mysql please try some time"); 
if (!mysqli_select_db($clientConnect,$dbName))     
header ("location:add_menu.php?next=$parID&email=$parEmail&emsg=2"); //die("Unable to connect please try some time");

$munuids=isset($_POST['munuids'])?$_POST['munuids']:'';
$mstatus=isset($_POST['mstatus'])?$_POST['mstatus']:'';
switch($munulevel)
{
    case "only_parent":
    if($mstatus==0)
    {
      $up="update $dbName.publisher set menu_permission=TRIM(BOTH ',' FROM REPLACE(CONCAT(',',menu_permission,',') , ',$munuids,', ',')) where FIND_IN_SET($munuids,menu_permission) and publisherID='$publisherID'";
    } 
    if($mstatus==1)
    {
      $up="UPDATE $dbName.publisher SET menu_permission = CONCAT_WS(',',menu_permission,$munuids) WHERE  par_id='".$parID."' and email='".$parEmail."'";
    } 
    $rr=  mysqli_query($clientConnect, $up);
    if($r==1){echo 1;}
    else{echo 2;}
    break;    
}
?>

