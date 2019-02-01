<?php
include_once 'function.inc.php';
// Inialize session
session_start();

/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Logout(".$_SESSION['username'].")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
// Delete certain session
//unset($_SESSION['username']);
unset($_SESSION['username']);
unset($_SESSION['dasbord_user_id']);
unset($_SESSION['dasbord_user_name']);
if($_SESSION['login_with_admin']=='yes')
{
	  unset($_SESSION['login_with_admin']);
	  header('Location: ../index.php');
}
if($_SESSION['login_with_admin']=='no')
{
	  unset($_SESSION['login_with_admin']);
	  header('Location: index.php');
}

// Delete all session variables
// session_destroy();

// Jump to login page
//header('Location: index.php');

?>