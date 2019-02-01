<?php
include_once 'auth.php';
include_once '../include/connect_db.php';
$results = $mysqli->query("SELECT  status FROM user_registration where status=0");
$num_rows = mysqli_num_rows($results);
if($num_rows==0)
{
	$num_rows=" 0";
	//echo $num_rows;
}else{ $num_rows=$num_rows; echo $num_rows;}
 ?>