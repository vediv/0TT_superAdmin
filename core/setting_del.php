<?php
include_once 'auth.php';
include_once 'function.inc.php';
include_once '../include/connect_db.php';
if (isset($_POST['id']))
{
$id = $_POST['id'];
$bcolor = $_POST['bcolor'];

$query2 = "DELETE FROM setting  where sid=$id ";

$res =  $mysqli->query($query2);
 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Display Delete (".$bcolor.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
echo "success";
}

?>

