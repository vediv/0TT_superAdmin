<?php
include_once 'auth.php';
include_once 'function.inc.php';
include_once '../include/connect_db.php';
if (isset($_POST['id'])){
	 $id = $_POST['id'];
	
	
	$query1 = "SELECT img_name FROM live_channel  where live_id='$id'";
//echo $query;
$res1 =  $mysqli->query($query1);
$image = mysqli_fetch_array($res1);
//$imag1=$image['img_name'];
//@unlink('img/'.$image['img_name']);

$query2 = "DELETE FROM live_channel  where live_id='$id'";
//echo $query;
$res =  $mysqli->query($query2);
//header('Location: admin-bootstrap/slider-image.php');
//exit;

 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Delete Image"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
}
echo 1;
?>

<?php
/*if($_POST['id'])
{
$id=$_POST['id'];
$delete = "DELETE FROM `slider_image_detail` WHERE img_id=$id";
$res=$mysqli->query( $delete);
}
*/
?>