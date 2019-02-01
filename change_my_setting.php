<?php 
include_once 'authm.php';
?>
<!DOCTYPE html>
<html>
  <head>
   <meta charset="UTF-8">
  	    <?php include_once 'pagenamem.php';?>

  	    <?php //if($PageName=="data"){?>
     <title><?php echo PROJECT_TITLE." | MyProfile";?></title>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
           <!-- Left side column. contains the logo and sidebar -->
      <?php include_once 'leftmenu.php';?>
      <?php
          $passwordupdate= isset($_GET['status']) ? $_GET['status'] : '';
          //$displaysuccess=($passwordupdate=="passwordupdate") ? "" : 'none';
         $displayerror='none'; $err_msg=''; $alert_name='';  $suc_msg='';
	 if($passwordupdate=="passwordupdate")
	 {
	    $suc_msg="Password successfully updated..!";
            $displayerror=''; $alert_name='alert-success';
	 }
            $par_id=$_SESSION['super_dasbord_par_id'];
            $q="Select publisher_pass,email from publisher where par_id='$par_id '"; 
            $fetch =db_select($q);
            $password=$fetch[0]['publisher_pass'];  $email=$fetch[0]['email']; 
 
  if(isset($_POST['updatepassword']))
  {
	 $upassword=$_POST['oldpassword'];
	 $ure_newpassword=$_POST['newpassword']; $confirmPassword=$_POST['confirmPassword']; 
	if($upassword!=$password)
	{
		$err_msg="Enter Correct old password";
		$displayerror=''; $alert_name='alert-danger'; $suc_msg='';
	}
	else
	if($ure_newpassword!=$confirmPassword)
	{
		$err_msg="New password and Confirm password Does Not match";
		$displayerror=''; $alert_name='alert-danger';  $suc_msg='';
	}
	else {
	 $up="update publisher set publisher_pass='$ure_newpassword' where par_id='$par_id'"; 
         $result=db_query($up);
	 header("location:change_my_setting.php?action=changepassword&status=passwordupdate");
	}
	
  }
  
?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1> Change My Setting</h1>
      <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Change My Setting</li>
      </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="col-xs-12">
          <div class="box">
    
  <div class="alert <?php echo $alert_name; ?>" style="display:<?php echo $displayerror; ?>;">
    <strong><?php echo $err_msg.$suc_msg; ?></strong>
  </div>
  
<div class="container">
<div class="row" style="margin-top: 30px;">
  <form class="form-horizontal" role="form" method="post">
       <div class="col-xs-1"></div>
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">Email Address:</label>
               <div class="col-xs-6">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $email; ?>" required>
            </div>
        </div>
         <div class="col-xs-1"></div>
         <div class="form-group">
            <label for="text" class="control-label col-xs-2">Old Password:</label>
              <div class="col-xs-6">
                 <input type="password" name="oldpassword" class="form-control" value="<?php echo $password;?>"  placeholder="Old Password" required>
             </div>
        </div>
     <div class="col-xs-1"></div>
        <div class="form-group">
            <label for="text" class="control-label col-xs-2">New Password:</label>
             <div class="col-xs-6">
                <input type="password" name="newpassword" class="form-control"  placeholder="New Password" required>
             </div>
        </div>
         <div class="col-xs-1"></div>
           <div class="form-group">
            <label for="text" class="control-label col-xs-2">Confirm Password:</label>
              <div class="col-xs-6">
                <input type="password" name="confirmPassword"   class="form-control"  placeholder="Confirm Password" required>
              </div>
        </div>
       
         <div class="col-xs-1"></div>
            <div class="form-group">
            <div class="col-xs-offset-2 col-xs-6">
                <button type="submit"  name="updatepassword"  class="btn btn-primary btn-primary1">Save</button>
            </div>
        </div>

    </form>
</div>
 </div>             
                
              </div>
 </div><!-- /.box -->  </div>
            
        
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
<?php  include_once"footer.php";  ?>
    </div><!-- ./wrapper -->


       
  </body>
</html>
