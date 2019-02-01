<?php
include_once 'authm.php';  
$par_id = $_REQUEST['pid'];
$query =  "SELECT dbName,dbHostName,dbUserName,dbpassword from publisher where acess_level='p' and par_id='$par_id'";
$fetch= db_select($query);
//print_r($fetch);
$dbName1=$fetch[0]['dbName'];  $dbHostName1=$fetch[0]['dbHostName']; 
$dbUserName1=$fetch[0]['dbUserName']; $dbpassword1=$fetch[0]['dbpassword']; 
$condel =  mysqli_connect($dbHostName1, $dbUserName1, $dbpassword1, $dbName1);
    if (!$condel)    
    die("Unable to connect to MySQL: " . mysqli_error()); 
    if (!mysqli_select_db($condel,$dbName1))     
    die("Unable to select database: " . mysql_error());


if($_POST['id'])
{
$id=$_POST['id'];
$qu =  "SELECT count(*) as delcount FROM $dbName1.publisher_setting where sett_parentid='$id'";
$fetch= db_select($qu);
 $delcount=$fetch[0]['delcount'];  
if($delcount==0)
{
  $delete_p = "DELETE FROM $dbName1.publisher_setting WHERE setID='$id'";
   $r1 = mysqli_query($condel,$delete_p); 
}
if($delcount>0)
{
  $delete_chaild = "DELETE FROM $dbName1.publisher_setting WHERE  sett_parentid='$id'";
  $r2 = mysqli_query($condel,$delete_chaild); 
  $delete_parent = "DELETE FROM $dbName1.publisher_setting WHERE setID='$id'";
  $r3 = mysqli_query($condel,$delete_parent); 
}
/*----------------------------update log file begin-------------------------------------------*/
   //$cdate=date('d/m/Y H:i:s');  $action="Delete Tilte(".$ttag.")"; $username=$_SESSION['username'];
   //write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
   
//$r= db_query($delete);

  echo 1;
}

?>