<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo "OTT"; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <!-- Ionicons -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
   
    <!-- DATA TABLES -->
   
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
      <script src="js/loginJs.js" type="text/javascript"></script>

 
    
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav" style="background-color: black;">
   
      
      <header class="main-header">               
        <nav class="navbar navbar-static-top">
        	 <a href="dashbordm.php" class="logo"> OTT</a>
	    <?php //include_once 'header.php'; ?> 
        </nav>
      </header>
         
      <!-- Full Width Column -->
       <div class="login-box" style="border: 0px solid red;">
      
      <div class="login-box-body">
        <p class="login-box-msg"><strong> Log in to  OTT  Administration Console</strong></p>
        <span class="error" id="msg"></span>
        <form action="javascript:" method="post" onsubmit="return sendLogin()" >
          <div class="form-group has-feedback">
              <input type="text" class="form-control"  placeholder="Email Id" name="email" id="email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="help-block has-error" id="email-error"></span>
          
          
          </div>
          <div class="form-group has-feedback">

              <input type="password" class="form-control"  placeholder="Password" name="password" id="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span class="help-block has-error" id="password-error"></span>
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
              <button type="submit" name ="submit" class="btn btn-primary btn-primary1 btn-block btn-flat">Log In</button>

            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.3 -->
    <script src="js/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
 

    
  </body>
</html>
