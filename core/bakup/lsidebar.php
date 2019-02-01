<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
             <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />-->
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['username'];?></p>

              <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
          </div>
         <style>
         	.skin-blue .sidebar-menu>li>a:hover, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background:#000000;
    border-left-color: #3c8dbc;
}
         </style>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
          <?php   $Url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					$Exploded = explode('/', $Url);
					$LastPart = end($Exploded);
					 $ExactName = substr($LastPart, 0, -4);
					?>
					 
          <li class="treeview">
              <a href="dashbord.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
               
              <?php if($ExactName=="user_list") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
              
               <a href="user_list.php">
                <i class="fa fa-user"></i> <span>User List</span> 
              </a>
            </li>
            </li> 
             <?php if($ExactName=="home_setting") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
              
               <a href="home_setting.php">
                <i class="fa fa-home"></i> <span>Home Setting</span> 
              </a>
            </li>
                     
              <?php if($ExactName=="slider-images") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>

               	
              <a href="slider-images.php">
                <i class="fa fa-folder"></i> <span>Slider Images</span> 
              </a>
            </li>
             
             <?php if($ExactName=="footer_content") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
              <a href="footer_content.php">
                <i class="fa fa-th"></i> <span>Footer Content</span> 
              </a>
              
              <?php if($ExactName=="view_log_history") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
              <a href="view_log_history.php">
                <i class="fa fa-history"></i> <span>View Log History</span> 
              </a>
              
              
              <?php if($ExactName=="display_setting") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
              <a href="display_setting.php">
               <i class="fa fa-cog"></i> <span>Display Setting</span> 
              </a>
              
              
            </li>
       
           
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
