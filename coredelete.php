<?php
include_once 'authm.php';
$action = $_POST['action'];
switch($action)
{
    case "menu_delete":
	 $menuid = $_POST['menuid'];
         $sql = "delete from menus where mid='".$menuid."'";
         $r=db_query($sql);
	 echo 1;
    break; 
}
?>


