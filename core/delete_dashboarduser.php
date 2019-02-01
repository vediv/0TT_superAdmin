<?php
include_once 'auth.php'; 
include_once 'function.inc.php';
include_once '../include/connect_db.php';
if($_POST['id'])
{
$id=$_POST['id'];
 $name=$_POST['name'];
 
 $delete="DELETE from dashbord_user where did='$id'";
 $res=$mysqli->query($delete);
 
 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Delete dashboard user(".$name.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
echo 1;
 
}

?>