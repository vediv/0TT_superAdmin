<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
$act=$_REQUEST['act'];

include_once 'include/function.inc.php'; 
switch($act)
{
   case "createDB":
  $partnerid=$_REQUEST['partnerid']; $dbhostname=$_REQUEST['dbhostname'];  $dbuname=$_REQUEST['dbuname']; 
  $dbpassword=$_REQUEST['dbpassword']; echo $getDBname=$_REQUEST['dbname'];
  echo $dbname=$getDBname."_".$partnerid;
  
   // connect to DB
   $conn = mysqli_connect($dbhostname, $dbuname, $dbpassword);
   if(!$conn) {
      //echo 1; 
      die('Could not connect ' . mysql_error());
   }
  $sql = "DROP DATABASE if exists $dbname";
  $dropDb = mysqli_query($conn,$sql);
  if(!$dropDb ) {
     die("Could not Drop $dbname database: " . mysql_error());
   }
  
   $sqlC = "CREATE Database $dbname";
   $createDb = mysqli_query($conn,$sqlC);
    
   if(! $createDb ) {
      die("Could not create $dbname database: " . mysql_error());
   }
   
   // Following code to import dump 
//Initialize variables
	$sqlfile = 'dumpOTT.sql';					// SQL File
	$hostname = $dbhostname;				// Server Name
	$db_user = $dbuname;			// User Name
	$db_password = $dbpassword;	// User Password
	$database_name = $dbname;		// DBName
    	$sqldelimiter = ';';
	$description = '';
	$diagnostic_info = '';
	$blnDiagnostics = FALSE;

	$diagmode = (isset($_REQUEST['diagmode'])) ? $_REQUEST['diagmode'] : 0;
	
	if($diagmode == 1)
		$blnDiagnostics = TRUE;

	/* ************************************************
	*	Connect to the mysql database
	* ************************************************/
	$link = mysql_connect(mysql_escape_string($hostname), mysql_escape_string($db_user), mysql_escape_string($db_password));
	
	if (!$link) 
	{
		die($header.$body."Unable to connect to the MySQL database".$footer);
	}
	else
	{
		// Select the mySQL DB
		mysql_select_db(($database_name), $link) or die("Wrong MySQL Database");
	
		$filename = $sqlfile;
		$sqlfile = fopen($sqlfile, 'r');

		if (is_resource($sqlfile) === true) 
		{
			$query = array();
		
			while (feof($sqlfile) === false) 
			{
				$query[] = fgets($sqlfile);
		
				if (preg_match('~' . preg_quote($sqldelimiter, '~') . '\s*$~iS', end($query)) === 1) 
				{
					$query = trim(implode('', $query));

					if($blnDiagnostics === true)
						$diagnostic_info .= $query;

					$result = mysql_query($query)or die(mysql_error().'. The import has been terminated and did not complete the process.'.$query.$footer);

					while (ob_get_level() > 0) 
					{
						ob_end_flush();
					}
					flush();
				}
				if (is_string($query) === true) 
				{
					$query = array();
				}
			}
	
			fclose($sqlfile);
		}
		$description = "File ".$filename." successfully imported into the ".$database_name." database.";
		if($blnDiagnostics === true)
			$description .= '<h3>Diagnostics</h3><div>'.$diagnostic_info.'</div>';
		//mysql_close();
	}
	
	
       // update in superadmin(publisher) 
      $up="update publisher set dbName='$database_name',dbHostName='$hostname', dbUserName='$db_user',dbpassword='$db_password' where partner_id='$partnerid'";
      $r=db_query($up);
      
        //get data from superadmin(publisher) and insert into publisher DB
        $get="SELECT * FROM publisher where partner_id='$partnerid' and acess_level='p'";
        $fetch= db_select($get);
        $id=$fetch[0]['par_id']; $parter_id=$fetch[0]['partner_id']; $name=$fetch[0]['name'];  $email=$fetch[0]['email']; 
	$company=$fetch[0]['company']; $publisher_pass=$fetch[0]['publisher_pass']; $acess_level=$fetch[0]['acess_level'];
        $pstatus=$fetch[0]['pstatus']; $admin_secret=$fetch[0]['admin_secret']; $service_url=$fetch[0]['service_url'];  
        $created_at=$fetch[0]['created_at']; $dbName=$fetch[0]['dbName'];
        $dbHostName=$fetch[0]['dbHostName'];$dbUserName=$fetch[0]['dbUserName'];$dbpassword=$fetch[0]['dbpassword'];
        // insert into publisher DB and table(publisher)

$in="insert into publisher(partner_id,name,email,company,admin_secret,service_url,
publisher_pass,pstatus,created_at,updated_at,acess_level,dbName,dbHostName,dbUserName,dbpassword)
values('$parter_id','$name','$email','$company','$admin_secret','$service_url','$publisher_pass','$pstatus','$created_at','$created_at','$acess_level','$dbName','$dbHostName','$dbUserName','$dbpassword')";
$rr=mysql_query($in,$link);
//$description;
echo 1;
break;    
    
    
} 

?>