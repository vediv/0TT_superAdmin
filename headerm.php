<?php
include_once 'authm.php';
?>

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <!-- Ionicons -->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="font-awesome/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    
      <header class="main-header">
        <!-- Logo -->
        <a href="dashbordm.php" class="logo" ><?php echo LOGO_NAME; ?></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          
          <div class="navbar-custom-menu" >
            <ul class="nav navbar-nav">
            	
           
                         
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>-->
                  <span class="hidden-xs"><?php echo $userNane;?><span class="caret"></span></span> 
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />-->
                       <p>
                      <?php echo $userNane;?>
                       </p>
                  </li>
                   <?php  if($acessLevel =='s'){?>
                     <li class="user-body">
                    <!--
                    <div class="pull-left" style="border:0px solid red;">
                                          <a href="#" class="btn btn-default btn-flat">User</a>
                                        </div>
                                        <div class="pull-right">
                                          <a href="#" class="btn btn-default btn-flat">Logs</a>
                                        </div>-->
                    
                     <?php  }?>
                  <!-- Menu Footer-->
                  <li class="user-footer" style=" background: #E1E3E1;   box-shadow: 0px 0px 8px 0px rgba(50, 50, 50, 0.54);  margin-top: -38px;">
                    <div class="pull-left">
                      <a href="change_my_setting.php" class="btn btn-default btn-default2 btn-flat">Profile</a>
                    </div>
               
                 <div class="pull-right">
                <a href="logoutm.php" class="btn btn-default btn-default2 btn-flat" class="user-header">Logout</a>
                
                 </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
   
   
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script src="dist/js/bootbox.min.js"></script>
  
      </header>
      
