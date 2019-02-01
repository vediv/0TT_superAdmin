<?php 
include_once 'authm.php';
ob_start(); 
include_once 'include/function.inc.php';
$msg='';
if(isset($_POST['save_publisher']))
{
    $pname=$_POST['pname'];
    $admin_secret=$_POST['admin_secret'];
    $company_name=$_POST['company_name'];
    $inputEmail=$_POST['inputEmail'];
    $partnerid=$_POST['partnerid'];
    $service_url=$_POST['service_url'];
    $inputPassword=$_POST['inputPassword'];
    $cdnUrl=$_POST['cdnUrl'];
    $s="select partner_id,email,service_url from publisher where (partner_id='$partnerid' and service_url='$service_url')  or email='$inputEmail'  ";
    $ff=  db_select($s);
    $count=  db_totalRow($s);
    $dbPartnerID=$ff[0]['partner_id']; $dbEmail=$ff[0]['email']; $dbservice_url=$ff[0]['service_url'];
    if($count>0)
    {    

        if(($dbPartnerID==$partnerid) and ($dbservice_url==$service_url))
        {
            $msg="<strong> Partner ID and Sevice URL </strong> already exist.? ";  // partnerID alredy exit;
        } 
        if($dbEmail==$inputEmail)
        {
            $msg=" <strong> Email </strong> already exist.?";
        } 

    }   
   else
   {   
     
        $pin = unique_user_id();  $publisher_unique_id=trim($pin);
        $que="select publisherID from publisher where publisherID='$publisher_unique_id'";
        $pp=db_query($que);
        $rowcount=db_totalRow($que);
        if($rowcount==1)
        {
                unique_user_id();
        }
     else{
     $publisherID=$_SESSION['super_dasbord_par_id'];
     $inputPassword_md5=md5($inputPassword);
     $inser_p="insert into publisher(name,partner_id,email,company,admin_secret,service_url,publisher_pass,pstatus,created_at,updated_at,acess_level,parentid,addedby,publisherID,cdnURL)
     values('$pname','$partnerid','$inputEmail','$company_name','$admin_secret','$service_url','$inputPassword_md5',1,NOW(),NOW(),'p','0','$publisherID','$publisher_unique_id','$cdnUrl')";
     $execute=db_query($inser_p);
     if($execute)
     { 
        $sel="select par_id,partner_id,email from publisher where partner_id='$partnerid' and  email='$inputEmail'";
        $fet=  db_select($sel);
        $dbemail=$fet[0]['email']; $dbparID=$fet[0]['par_id'];
        header("Location:addCredential.php?next=$dbparID&email=$dbemail");
         
     }
     else {
        
         echo 3;
        
        } 
          }            
   }
    
    
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php include_once 'pagenamem.php';?>
 <title><?php echo PROJECT_TITLE."- Credential-DB";?></title>
<!--<script src="js/commanJS.js" type="text/javascript"></script>-->
<link href="css/pagingCss.css" rel="stylesheet" type="text/css" />
</head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
      <?php include_once 'leftmenu.php';?>
      <div class="content-wrapper">
        <section class="content-header">
       <h1>Add New Publisher             </h1>
          <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Add Publisher</li>
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
<div class="box-header" id="msg" style="border:0px solid red; text-align: center; padding-top:3px;"><?php echo $msg; $s; ?> </div>     
<br/>           

 <form class="form-horizontal" method="post">
    <div class="form-group" style="margin-bottom: 8px !important;">
        <label for="text" class="control-label col-xs-3">Name: <span style="color:red;">*</span></label>
         <div class="col-xs-6">
             <input type="text" class="form-control" name="pname" id="pname"  placeholder="Name" value="<?php echo  (isset($_POST['pname']))? $_POST['pname']:''; ?>" maxlength="30"  required  >
           <span class="help-block has-error" id="pname-error" style="margin-top: 0 !important;    margin-bottom: 0px !important;"></span>
            </div>
        </div>
     
        <div class="form-group" style="margin-bottom: 0px !important;">
            <label for="inputEmail" class="control-label col-xs-3">Email: <span style="color:red;">*</span></label>
            <div class="col-xs-6">
                <input type="email" class="form-control" id="inputEmail" name="inputEmail"  placeholder="Email" required value="<?php echo  (isset($_POST['inputEmail']))? $_POST['inputEmail']:''; ?>">
                <span class="help-block has-error" id="inputEmail-error"></span>
            </div>
        </div>
        
        <div class="form-group" style="margin-bottom: 0px !important;">
        <label for="text" class="control-label col-xs-3">Company: <span style="color:red;">*</span></label>
         <div class="col-xs-6">
           <input type="text" class="form-control" name="company_name" id="company_name"  placeholder="organization" required  value="<?php echo  (isset($_POST['company_name']))? $_POST['company_name']:''; ?>">
            <span class="help-block has-error" id="company_name-error"></span>
            </div>
        </div>
           
          <div class="form-group" style="margin-bottom: 0px !important;">
            <label for="text" class="control-label col-xs-3">Admin Secret: <span style="color:red;">*</span></label>
            <div class="col-xs-6">
                <input type="text" class="form-control" name="admin_secret" id="admin_secret"   placeholder="Admin Secret" required value="<?php echo  (isset($_POST['admin_secret']))? $_POST['admin_secret']:''; ?>">
                <span class="help-block has-error" id="admin_secret-error"></span>
            </div>
        </div>
        
        
         <div class="form-group" style="margin-bottom: 0px !important;">
            <label for="text" class="control-label col-xs-3">Partner ID: <span style="color:red;">*</span></label>
            <div class="col-xs-6">
                <input type="number" class="form-control" name="partnerid" id="partnerid" min="0"  placeholder="Partner ID" required value="<?php echo  (isset($_POST['partnerid']))? $_POST['partnerid']:''; ?>">
                <span class="help-block has-error" id="partnerid-error"></span>
            </div>
        </div>
        
        
       <div class="form-group" style="margin-bottom: 0px !important;">
            <label for="text" class="control-label col-xs-3">Service URL: <span style="color:red;">*</span></label>
            <div class="col-xs-6">
                <input type="url" class="form-control" name="service_url" id="service_url"   placeholder="Service URL"  value="<?php echo  (isset($_POST['service_url']))? $_POST['service_url']:''; ?>">
                    <span class="help-block has-error" id="service_url-error"></span>
            </div>
        </div>
        
        <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="inputPassword" class="control-label col-xs-3">Password: <span style="color:red;">*</span></label>
         <div class="col-xs-6">
         <input type="password"  class="form-control" id="inputPassword" name="inputPassword"   placeholder="Password" required value="<?php echo  (isset($_POST['inputPassword']))? $_POST['inputPassword']:''; ?>">
            <span class="help-block has-error" id="inputPassword-error"></span>
         </div>
         
        </div>
     
     <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="inputPassword" class="control-label col-xs-3">cdnURL: </label>
         <div class="col-xs-6">
         <input type="text"  class="form-control" id="cdnUrl" name="cdnUrl"   placeholder="cdn URL">
            <span class="help-block has-error" id="inputPassword-error"></span>
         </div>
         
        </div>
     
        
        
       
        <div class="form-group" style="margin-bottom: 0px !important;">

            <div class="col-xs-offset-3 col-xs-6">

 <button type="submit" class="btn btn-primary btn-primary1"  name="save_publisher">Save & Next</button>
 

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
