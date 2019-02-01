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
if(isset($_POST['save_cdn_detail']))
{
    
   $publisherUniqueID=$_POST['publisherUniqueID']; $cdnhosturl=trim($_POST['cdnhosturl']);  $cdnuname=$_POST['cdnuname']; 
   $cdnpassword=$_POST['cdnpassword']; $cdndir=trim($_POST['cdndir']);
   $cdnurl=trim($_POST['cdnurl']); $cdn_alias=$_POST['cdn_alias']; 
   $qry="insert into cdn_details(host,username,password,publisherID,cdnDIR,cdnURL,cdn_alias)
      values('".$cdnhosturl."','".$cdnuname."','".$cdnpassword."','".$publisherUniqueID."','".$cdndir."','".$cdnurl."','".$cdn_alias."')"; 
   $r=db_query($qry);
   if($r)
   echo "<script type='text/javascript'>window.location.href = 'puserlist.php?msg=add_publisher_successfully';</script>";
}    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php include_once 'pagenamem.php';?>
<title><?php echo PROJECT_TITLE."- CDN detail";?></title>
<link href="css/pagingCss.css" rel="stylesheet" type="text/css" />
</head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
      <?php include_once 'leftmenu.php';?>
      <div class="content-wrapper">
        <section class="content-header">
       <h1>Add CDN Detail </h1>
          <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Add CDN Detail</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="col-xs-12">
          <div class="box">
         <div class="box-header">
          <div class="col-sm-12" style="border: 0px solid red;">
  	
  	 
 <div class="" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
        <div class="modal-body">
         
<div class="box-header" id="msg" style="border:0px solid red; text-align: center; padding-top:3px;"> 
    
<?php echo $msg; ?>  </div>     
           
<br/>
 <form class="form-horizontal" method="post">
     <div class="form-group" style="margin-bottom: 0px !important;">
        <label for="text" class="control-label col-xs-4">Partner ID: <span style="color:red;">*</span></label>
         <div class="col-xs-5">
             <input type="text" class="form-control" name="publisherUniqueID" id="publisherUniqueID" readonly value="<?php echo $dbpublisherUniqueID;  ?>">
            <span class="help-block has-error" id="publisherUniqueID-error"></span>
            </div>
        </div>
        
        <div class="form-group" style="margin-bottom: 0px !important;">
        <label for="text" class="control-label col-xs-4">Cdn HostURL:  <span style="color:red;">*</span></label>
         <div class="col-xs-5">
           <input type="text" class="form-control" name="cdnhosturl" id="cdnhosturl" required  placeholder="Cdn HostURL" value="<?php echo  (isset($_POST['cdnhosturl']))? $_POST['cdnhosturl']:''; ?>">
           <span class="help-block has-error" id="cdnhosturl-error"></span>  
          </div>
        </div>
           
          <div class="form-group" style="margin-bottom: 0px !important;">
              <label for="text" class="control-label col-xs-4">Cdn UserName: <span style="color:red;">*</span></label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="cdnuname" id="cdnuname" required placeholder="Cdn User Name"  value="<?php echo  (isset($_POST['cdnuname']))? $_POST['cdnuname']:''; ?>">
            <span class="help-block has-error" id="cdnuname-error"></span>  
            </div>
        </div>
        
        <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="dbpassword" class="control-label col-xs-4">Cdn Password: <span style="color:red;">*</span></label>
         <div class="col-xs-5">
             <input type="password"  class="form-control" id="cdnpassword" required name="cdnpassword"   placeholder="Cdn Password">
         <span class="help-block has-error" id="cdnpassword-error"></span> 
         </div>
        </div>
       <div class="form-group" style="margin-bottom: 0px !important;">
            <label for="dbname" class="control-label col-xs-4">Cdn Directory:  <span style="color:red;">*</span></label>
            <div class="col-xs-5">
                <input type="text" class="form-control" id="cdndir" name="cdndir" required  placeholder="Cdn Directory" value="<?php echo  (isset($_POST['dbname']))? $_POST['dbname']:''; ?>">
             <span class="help-block has-error" id="cdndir-error"></span>  
            </div>
        </div>
       <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="inputPassword" class="control-label col-xs-4">Cdn Url: <span style="color:red;">*</span></label>
         <div class="col-xs-5">
         <input type="text"  class="form-control" id="cdnurl" name="cdnurl"   placeholder="Cdn Url" required value="<?php echo  (isset($_POST['cdnurl']))? $_POST['cdnurl']:''; ?>">
             <span class="help-block has-error" id="cdnurl-error"></span> 
         </div>
         
        </div>
        <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="inputPassword" class="control-label col-xs-4">Cdn alias: <span style="color:red;">*</span></label>
         <div class="col-xs-5">
         <input type="text"  class="form-control" id="cdn_alias" name="cdn_alias"   placeholder="Cdn alias" required value="<?php echo  (isset($_POST['cdn_alias']))? $_POST['cdn_alias']:''; ?>">
             <span class="help-block has-error" id="cdn_alias-error"></span> 
         </div>
         
        </div>
        <div class="form-group" style="margin-bottom: 0px !important;">
            <div class="col-xs-offset-4 col-xs-6">
                <button type="submit" name="save_cdn_detail" class="btn btn-primary btn-primary1">Save</button> 
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
