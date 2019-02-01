<?php
include_once 'auth.php';  
include_once '../include/connect_db.php';
include_once'function.inc.php';
if($_POST['id'])
{
$id=$_POST['id'];
$ttag=$_POST['tname'];
/*$sql="select * FROM `home_title_tag` WHERE tags_id='$id'";
$results=$mysqli->query($sql);
$row=$results->fetch_array();

$ttag=$row['title_tag_name'];*/

$delete = "DELETE FROM `home_title_tag` WHERE tags_id='$id'";

/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Delete Tilte(".$ttag.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
   
$r= $mysqli->query($delete);
echo 1;
}

?>