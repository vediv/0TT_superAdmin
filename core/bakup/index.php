<?php
session_start();
include_once '../include/connect_db.php';
include_once 'function.inc.php';
 $msg='';
if(isset($_REQUEST['msg']))
 {
         $sucess_msg=$_REQUEST['msg'];
         if($sucess_msg=='sucess')
         { $msg="<p class='login-box-msg'> Successfuly Login..</p>" ;}
 }
 $passwordErr=''; 
 	if (isset($_POST['submit'])) 
{
	 $Email = mysqli_real_escape_string($mysqli,$_POST['email']);
     $Password = mysqli_real_escape_string($mysqli,$_POST['password']);
   	$results = $mysqli->query("Select *from dashbord_user where (demail='$Email' and dpassword='$Password')");
  $row = $results->fetch_array();
  //print_r($row['dname']);
 
   $_SESSION['username'] = $row['dname'];
   $_SESSION['level'] = $row['alevel'];
  // $_SESSION['login_status'] = 'Yes';
  
  
  
   
	 if($row>0){
	 	// $_SESSION['login_status'] = 'Yes';
	 	$_SESSION['username'];
 //header("Location:login.php?msg=sucess");
 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Login(".$_SESSION['username'].")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
header("Location:dashbord.php");		 		 
    }else{  
   $passwordErr = "<p class='login-box-msg'><span style='color: red'>Password Or Email-Id not correct Please try again..</span></p>";	
  } 
}
 ?>
<!DOCTYPE html>
<html>
	<script type="text/javascript">
function valid()
{
 var user = document.getElementsByName("email")[0].value;
  var pass = document.getElementsByName("password")[0].value;;

if(user == '')
{
alert("Enter Email id");
return false;
}
if(pass == '')
{
alert("Enter password ");
return false;
}
}
</script>
  <head>
    <meta charset="UTF-8">
    <title><?php echo "Mycloud"; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <!-- Ionicons -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="font-awesome/css/ionicons.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

 
    
  </head><span style="color: red"></span>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav" style="background-color: black;">
   
      
      <header class="main-header">               
        <nav class="navbar navbar-static-top">
        	<a href="#" class="logo"><b>My</b>cloud</a>
	    <?php //include_once 'header.php'; ?> 
        </nav>
      </header>
         
      <!-- Full Width Column -->
       <div class="login-box" style="border: 0px solid red;">
      
      <div class="login-box-body">
        <p class="login-box-msg">Log in to  Mycloud Dashbord</p>
        <span class="error"> <?php echo
          $passwordErr.$msg;?></span>
        <form action="" method="post" onsubmit="return valid()">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Email Id" name="email"/>
           <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
            <!--  <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div> -->                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name ="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
            </div><!-- /.col -->
          </div>
        </form>


      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
         
  
          
      
     
   

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
   
    
   
   

   <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

    
  </body>
</html>
