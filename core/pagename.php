<?php
include_once 'auth.php';
define("PROJECT_TITLE", 'Mycloud-TV');  
  
     $Url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$Exploded = explode('/', $Url);
					$LastPart = end($Exploded);
					 $PageName = substr($LastPart, 0, -4);
					?>