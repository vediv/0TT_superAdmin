<?php
//include_once 'function.inc.php';
// Inialize session
session_start();

/*----------------------------update log file begin-------------------------------------------*/
  // $cdate=date('d/m/Y H:i:s');  $action="Logout(".$_SESSION['username'].")"; $username=$_SESSION['username'];
  // write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
// Delete certain session
unset($_SESSION['super_dasbord_par_id']);
// Delete all session variables
//session_destroy();

// Jump to login page
header('Location: index.php');

?>