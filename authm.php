<?php 
//error_reporting(E_ALL & ~E_NOTICE);
//ini_set('display_errors', TRUE);
ob_start();
session_start();
if(isset($_SESSION['super_dasbord_par_id'])){
include_once 'config.php';    
include_once 'include/function.inc.php';
$super_dasbord_par_id=$_SESSION['super_dasbord_par_id'];
$results ="SELECT name,email,acess_level FROM publisher where par_id='$super_dasbord_par_id'";
$rows = db_select($results);
$userNane=$rows[0]['name'];
$acessLevel=$rows[0]['acess_level']; 
} 
if( !isset($_SESSION['super_dasbord_par_id'])){
	header("Location:index.php");
	exit;
} 
define("LOGO_NAME", 'OTT'); 
?>
