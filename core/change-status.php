<?php
include_once 'auth.php'; 
include_once '../include/connect_db.php';
if (isset($_POST['status'])){
     $id = $_POST['id'];
	 $status = ($_POST['status'] == '1') ? 1: 0;
	$query = "update slider_image_detail set img_status = $status where img_id=$id";
//echo $query;
echo $res =  $mysqli->query($query);

}
?>
