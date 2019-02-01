<?php include_once 'authm.php';   ?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
             <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />-->
            </div>
            <div class="pull-left info">
              <p><?php echo $userNane;?></p>

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
          <?php  
            $pagenamerequest= basename($_SERVER['REQUEST_URI']);
            $pname=explode("?",$pagenamerequest);
            $ExactName=$pname[0];                             
	    ?>
					 
          <li class="treeview">
              <?php if($ExactName=="dashbordm.php") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
               <a href="dashbordm.php" title="dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span><i class="fa fa-angle-left pull-right"></i> 
               </a>
              <?php if($ExactName=="puserlist.php") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
                <a href="puserlist.php" title="Publisher List">
                <i class="fa fa-film"></i> <span>Publisher List</span> 
              </a>
              <?php if($ExactName=="add_credential.php") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
                <a href="add_credential.php" title="add_credential DB">
                <i class="fa fa-film"></i> <span>Add Credential DB</span> 
              </a>
          
            </li>
              <?php if($ExactName=="change_my_setting.php") {$Class = ' class="active"';?> 
                <?php echo '<li'. $Class .'>';}else echo '<li>'?>
               <a href="change_my_setting.php" title="Live Channel">
                <i class="fa fa-cog"></i> <span>Change My Setting</span> 
              </a>
          </ul>
        </section>
        <!-- /.sidebar -->
       
      </aside>
