<?php
//error_reporting(E_ALL & ~E_NOTICE);
//ini_set('display_errors', TRUE);
include_once 'authm.php';
//include_once 'functionm.inc.php';
$parIDid =(isset($_REQUEST['next']))? $_REQUEST['next']:'';
$email =(isset($_REQUEST['email']))? $_REQUEST['email']:'';
if(empty($parIDid) || empty($email) )
{
    
    header("Location:404.php");
    exit;
}
$sel="select par_id,partner_id,email,publisherID from publisher where par_id='$parIDid' and  email='$email'";
$fet=  db_select($sel);
$dbPartnerID=$fet[0]['partner_id']; $dbparID=$fet[0]['par_id']; $dbpublisherUniqueID=$fet[0]['publisherID'];
//save_credential test_credential
$msg=''; 
if(isset($_POST['save_credential']))
{
   $dbpublisherUniqueID=$_POST['dbpublisherUniqueID']; $dbhostname=$_POST['dbhostname'];  $dbuname=$_POST['dbuname']; 
   $dbpassword=$_POST['dbpassword']; $getDBname=$_POST['dbname'];
   $dbname=$getDBname."_".$dbpublisherUniqueID; 
   $kaltuardbhost=$_POST['kaltuardbhost']; $kaltuardbuser=$_POST['kaltuardbuser']; $kaltuardbpassword=$_POST['kaltuardbpassword'];
   $errorfalg=1;
   $conn = mysqli_connect($dbhostname, $dbuname, $dbpassword);
   if(!$conn) {
      $msg=('Could not connect ' . mysqli_error($conn));
      $errorfalg=0;
      
   }
   
  $sql = "DROP DATABASE if exists $dbname";
   $dropDb = mysqli_query($conn,$sql);
  if(!$dropDb && $errorfalg!=0) {
     $msg=("Could not Drop $dbname database: " . mysqli_error($conn));
     $errorfalg=0;
   }
    
   $sqlC = "CREATE Database $dbname";
   $createDb = mysqli_query($conn,$sqlC);
    
   if(! $createDb && $errorfalg!=0) {
      $msg=("Could not create $dbname database: " . mysqli_error($conn));
      $errorfalg=0;
   } 
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
     $link = mysqli_connect($hostname,$db_user, $db_password);
	if (!$link) 
	{
		die("Unable to connect to the MySQL database");
	}
	else
	{
		// Select the mySQL DB
		mysqli_select_db($link,$database_name) or die("Wrong MySQL Database");
	
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

					$result = mysqli_query($link,$query)or die(mysqli_error($link).'. The import has been terminated and did not complete the process.'.$query);

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
		//$description = "File ".$filename." successfully imported into the ".$database_name." database.";
		if($blnDiagnostics === true)
			$description .= '<h3>Diagnostics</h3><div>'.$diagnostic_info.'</div>';
		//mysql_close();
	}
       // update in superadmin(publisher)
$up="update publisher set dbName='$database_name',dbHostName='$hostname', dbUserName='$db_user',dbpassword='$db_password',kalturadburl='$kaltuardbhost',kalturadbuser='$kaltuardbuser',kalturadbpasswd='$kaltuardbpassword' where par_id='$parIDid'";
$r=db_query($up);
        //get data from superadmin(publisher) and insert into publisher DB
        $get="SELECT * FROM publisher where par_id='$parIDid' and  email='$email' and acess_level='p'";
        $fetch= db_select($get);
        $id=$fetch[0]['par_id']; $parter_id=$fetch[0]['partner_id']; $name=$fetch[0]['name'];  $email=$fetch[0]['email']; 
	$company=$fetch[0]['company']; $publisher_pass=$fetch[0]['publisher_pass']; $acess_level=$fetch[0]['acess_level'];
        $pstatus=$fetch[0]['pstatus']; $admin_secret=$fetch[0]['admin_secret']; $service_url=$fetch[0]['service_url'];  
        $created_at=$fetch[0]['created_at']; $dbName=$fetch[0]['dbName'];$dbHostName=$fetch[0]['dbHostName'];
        $dbUserName=$fetch[0]['dbUserName']; $dbpassword=$fetch[0]['dbpassword']; $publisher_unique_ID=$fetch[0]['publisherID'];
        $cdnURL=$fetch[0]['cdnURL'];


// insert into publisher DB and table(publisher)
//$mpermission="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,28";
//$opermission="1,2,3,4";
$in="insert into publisher(par_id,partner_id,name,email,company,admin_secret,service_url,
publisher_pass,pstatus,created_at,updated_at,acess_level,dbName,dbHostName,dbUserName,dbpassword,publisherID,cdnURL)
values('$id','$parter_id','$name','$email','$company','$admin_secret','$service_url','$publisher_pass','$pstatus','$created_at','$created_at','$acess_level','$dbName','$dbHostName','$dbUserName','$dbpassword','$publisher_unique_ID','$cdnURL')";
$rr=mysqli_query($link,$in);
        if($rr)
        { 
            /** making  folder in data folder*/
            $path = "/video/data/";
            if (!is_dir($path.$database_name)) {
                mkdir($path.$database_name, 0777, true); 
                if (!is_dir($path.$database_name."/upload_icon")) {
                 mkdir($path.$database_name."/upload_icon", 0777, true);
                }
                if (!is_dir($path.$database_name."/upload_slider")) {
                 mkdir($path.$database_name."/upload_slider", 0777, true);
                }
                if (!is_dir($path.$database_name."/upload_thumb")) {
                 mkdir($path.$database_name."/upload_thumb", 0777, true);
                }
                if (!is_dir($path.$database_name."/template")) {
                 mkdir($path.$database_name."/template", 0777, true);
                }
                if (!is_dir($path.$database_name."/user_image")) {
                 mkdir($path.$database_name."/user_image", 0777, true);
                }
                if (!is_dir($path.$database_name."/notificationimage")) {
                 mkdir($path.$database_name."/notificationimage", 0777, true);
                }
                if (!is_dir($path.$database_name."/vid_temp")) {
                 mkdir($path.$database_name."/vid_temp", 0777, true);
                }
                if (!is_dir($path.$database_name."/email_images")) {
                 mkdir($path.$database_name."/email_images", 0777, true);
                }
                if (!is_dir($path.$database_name."/Invoice")) {
                 mkdir($path.$database_name."/Invoice", 0777, true);
                }
                if (!is_dir($path.$database_name."/marketing")) {
                 mkdir($path.$database_name."/marketing", 0777, true);
                }
                if (!is_dir($path.$database_name."/menu_icon")) {
                 mkdir($path.$database_name."/menu_icon", 0777, true);
                }
            }
          //addCredential.php?next=90&email=nana@gmail.com  
          //echo "<script type='text/javascript'>window.location.href = 'puserlist.php?msg=add_publisher';</script>";
          echo "<script type='text/javascript'>window.location.href = 'cdnDetail.php?next=$parIDid&email=$email&action=cden_detail';</script>";        
        }  
        
}    
//print_r($error_msg);
if(isset($_POST['test_credential']))
{
    $dbpublisherUniqueID=$_POST['dbpublisherUniqueID']; $dbhostname=$_POST['dbhostname'];  $dbuname=$_POST['dbuname']; 
    $dbpassword=$_POST['dbpassword']; $getDBname=$_POST['dbname'];
    $dbname=$getDBname."_".$dbpublisherUniqueID;
     // connect to DB
   $conn = mysqli_connect($dbhostname, $dbuname, $dbpassword);
   if(!$conn) {
     
      $msg=('Could not connect ' . mysqli_error($conn));
   }
 else {
      $msg="A successful MySQL connection was made with <br/>the parameters defined for this connection"; 
   }
       
}    

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php include_once 'pagenamem.php';?>
<title><?php echo PROJECT_TITLE."- Credential-DB";?></title>
<link href="css/pagingCss.css" rel="stylesheet" type="text/css" />
</head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
      <?php include_once 'leftmenu.php';?>
      <div class="content-wrapper">
        <section class="content-header">
       <h1>Add DB Credential </h1>
          <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Add DB Credential</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="col-xs-12">
          <div class="box">
         <div class="box-header">
          <div class="col-sm-12" style="border: 0px solid red;">
  	
  	 
 <div class=" " id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
        <div class="modal-body">
         
<div class="box-header" id="msg" style="border:0px solid red; text-align: center; padding-top:3px;"> 
    
<?php echo $msg; ?>  </div>     
           
<br/>
 <form class="form-horizontal" method="post">
     <div class="form-group" style="margin-bottom: 0px !important;">
        <label for="text" class="control-label col-xs-4">Partner ID: <span style="color:red;">*</span></label>
         <div class="col-xs-5">
             <input type="text" class="form-control" name="dbpublisherUniqueID" id="dbpublisherUniqueID" readonly value="<?php echo $dbpublisherUniqueID;  ?>">
            <span class="help-block has-error" id="dbhostname-error"></span>
            </div>
        </div>
        
        <div class="form-group" style="margin-bottom: 0px !important;">
        <label for="text" class="control-label col-xs-4">DB HostName:  <span style="color:red;">*</span></label>
         <div class="col-xs-5">
           <input type="text" class="form-control" name="dbhostname" id="dbhostname" required  placeholder="DB Host Name" value="<?php echo  (isset($_POST['dbhostname']))? $_POST['dbhostname']:''; ?>">
            <span class="help-block has-error" id="dbhostname-error"></span>
            </div>
        </div>
           
          <div class="form-group" style="margin-bottom: 0px !important;">
              <label for="text" class="control-label col-xs-4">DB UserName: <span style="color:red;">*</span></label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="dbuname" id="dbuname" required placeholder="DB User Name"  value="<?php echo  (isset($_POST['dbuname']))? $_POST['dbuname']:''; ?>">
                <span class="help-block has-error" id="dbuname-error"></span>
            </div>
        </div>
        
        <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="dbpassword" class="control-label col-xs-4">DB Password:</label>
         <div class="col-xs-5">
         <input type="password"  class="form-control" id="dbpassword" name="dbpassword"   placeholder="DB Password">
             <span class="help-block has-error" id="dbpassword-error"></span>
         </div>
        </div>
       <div class="form-group" style="margin-bottom: 0px !important;">
            <label for="dbname" class="control-label col-xs-4">Database Name:  <span style="color:red;">*</span></label>
            <div class="col-xs-5">
                <input type="text" class="form-control" id="dbname" name="dbname" required  placeholder="database name" value="<?php echo  (isset($_POST['dbname']))? $_POST['dbname']:''; ?>">
                 <span class="help-block has-error" id="dbname-error"></span>
            </div>
        </div>
       <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="inputPassword" class="control-label col-xs-4">Kaltura DB Host: <span style="color:red;">*</span></label>
         <div class="col-xs-5">
         <input type="text"  class="form-control" id="inputPassword" name="kaltuardbhost"   placeholder="kaltuar DB HOST" required value="<?php echo  (isset($_POST['kaltuardbhost']))? $_POST['kaltuardbhost']:''; ?>">
            <span class="help-block has-error" id="inputPassword-error"></span> 
         </div>
         
        </div>
        <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="inputPassword" class="control-label col-xs-4">Kaltura DB User: <span style="color:red;">*</span></label>
         <div class="col-xs-5">
         <input type="text"  class="form-control" id="inputPassword" name="kaltuardbuser"   placeholder="kaltuar DB User" required value="<?php echo  (isset($_POST['kaltuardbuser']))? $_POST['kaltuardbuser']:''; ?>">
            <span class="help-block has-error" id="inputPassword-error"></span>
         </div>
         
        </div>
       <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="inputPassword" class="control-label col-xs-4">Kaltura DB Password: <span style="color:red;">*</span></label>
         <div class="col-xs-5">
         <input type="password"  class="form-control" id="inputPassword" name="kaltuardbpassword"   placeholder="kaltuar DB Password" required value="<?php echo  (isset($_POST['kaltuardbpassword']))? $_POST['kaltuardbpassword']:''; ?>">
            <span class="help-block has-error" id="inputPassword-error"></span>
         </div>
         
        </div>
     
     
        <div class="form-group" style="margin-bottom: 0px !important;">
            <div class="col-xs-offset-4 col-xs-6">
                <button type="submit" name="save_credential" class="btn btn-primary btn-primary1">Save & Next</button> 
                <button type="submit" name="test_credential" class="btn btn-primary btn-primary1" >Test Connection</button>
            </div>
        </div>
    </form>            
	    
 
  </div>
    </div>
  </div>
  </div>
  	
  	
  </div>
          </div>
             
              
     </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
     
      <?php
       include_once"footer.php";
      ?>
  </div><!-- /.content-wrapper -->   </div><!-- ./wrapper -->


<script type="text/javascript">
function saveCredentialDB(act)
{     
  var valid;	
  valid = validCredentialDB();
  if(valid) {
    var partnerid=$("#partnerid").val();
    var dbhostname=$("#dbhostname").val();
    var dbuname=$("#dbuname").val();
    var dbpassword=$("#dbpassword").val();
    var dbname=$("#dbname").val();
    document.getElementById("msg").innerHTML = "<center> <img src='img/image_process.gif'> Wait For Connect and Creat DB Credential </center>";
     $.ajax({
     url: "createdb.php",
     data:'partnerid='+partnerid+'&dbhostname='+dbhostname+'&dbuname='+dbuname+'&dbpassword='+dbpassword+'&dbname='+dbname+'&act='+act,
     type: "POST",
     success:function(res){
        if(res=="1")
        {
            window.location.href="add_credential.php";  
            $("#msg").val("");
        }   
        else
        {
            document.getElementById("msg").innerHTML=res;
            $("#msg").val("");
        }
    
      },
              error:function (){}
            });   
       }         
	    
}

function validCredentialDB() {
	var valid = true;	
	$(".demoInputBox").css('background-color','');
	$(".has-error").html('');
	
	if(!$("#partnerid").val()) {
		$("#partnerid-error").css('color','#DD4B39').html("(Select partner ID)");
		//$("#partnerid").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#dbhostname").val()) {
		$("#dbhostname-error").css('color','#ff3300').html("(Host Name required)");
		$("#dbhostname").css('background-color','#FFFFDF');
		valid = false;
	}
        if(!$("#dbuname").val()) {
		$("#dbuname-error").css('color','#ff3300').html("(DB User Name required)");
		$("#dbuname").css('background-color','#FFFFDF');
		valid = false;
	}
        if(!$("#dbname").val()) {
		$("#dbname-error").css('color','#ff3300').html("(DataBase Name required)");
		$("#dbname").css('background-color','#FFFFDF');
		valid = false;
	}
        
        
        
        if(!$("#dbname").val().match(/[a-zA-Z]+/)) {
		$("#dbname-error").css('color','#DD4B39').html("(Space Not allow)");
		$("#dbname").css('background-color','#FFFFDF');
		valid = false;
	}
       
	return valid;
}


</script> 
</body>
</html>
