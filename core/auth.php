<?php 
ob_start();
session_start();
include_once '../include/connect_db.php';
if(!isset($_SESSION['username'])){
	header("Location:index.php");
	exit;
}
 
?>