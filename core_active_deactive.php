<?php
include_once 'authm.php';
$action = $_POST['action'];
switch($action)
{
	 case "menu":
	 $menuid = $_POST['menuid'];
         $adstatus = $_POST['adstatus'];		
	 $adupdateStaus=$adstatus==1?0:1;
	 $sql = "update menus set mstatus='".$adupdateStaus."' where mid='".$menuid."'";
         $r=db_query($sql);
	 echo $adupdateStaus;
         break;	
   
     
	}
?>

