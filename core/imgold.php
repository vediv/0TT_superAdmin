<?php
include_once 'auth.php';  
include_once '../include/connect_db.php';
if(isset($_POST['name']))
{
	$name1=$_POST['name'];
	
	$q_sql="select count(*) as totalcount from slider_image_detail where img_name='$name1' ";
$res1=$mysqli->query($q_sql);
$rw=mysqli_fetch_array($res1);
  $img=$rw['totalcount'];
  $total=mysqli_num_rows($res1);
 
if($img>=1)
{
	//$message= "Image already exist and upload with different name";
	echo 1;
	
}
else{
	     
//$mysqli->query($query);
	echo 2;}

}
?>
       
       
       
       