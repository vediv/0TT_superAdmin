<?php include_once 'authm.php';  ?>
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
<style type="text/css">
.skin-blue .sidebar-menu>li>a:hover, .skin-blue .sidebar-menu>li.active>a {
    color: #fff;
    background:#000000;
    border-left-color: #3c8dbc;
}
</style>
<?php  
$pagenamerequest= basename($_SERVER['REQUEST_URI']);
$pname=explode("?",$pagenamerequest);
$ExactName=$pname[0];                            
  ?>       
          <ul class="sidebar-menu">
            <li class="treeview <?php echo $ExactName=="dashbordm.php" ? "active" :"";   ?>">
              <a href="dashbordm.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview <?php echo $ExactName=="add_publisher.php" || $ExactName=="puserlist.php" || $ExactName=="addCredential.php" ?"active" :"";   ?> ">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Publishers</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $ExactName=="add_publisher.php" || $ExactName=="addCredential.php" ? "active" :"";   ?>"><a href="add_publisher.php"><i class="fa  fa-plus" aria-hidden="true"></i> Add New Publisher</a></li>
                <li class="<?php echo $ExactName=="puserlist.php" ?"active" :"";   ?>"><a href="puserlist.php" title="Publisher List"><i class="fa fa-list" aria-hidden="true"></i> Publisher List</a></li>
              </ul>
                
                
            </li>
            
             <li class="treeview <?php echo $ExactName=="menusetting.php" || $ExactName=="pub_setting.php" ?"active" :"";   ?> ">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Common Setting</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li class="<?php echo $ExactName=="module_setting.php" ? "active" :"";   ?>"><a href="module_setting.php"> <span class="glyphicon glyphicon-cog"></span>Module Setting</a></li>
                  <li class="<?php echo $ExactName=="menusetting.php" ? "active" :"";   ?>"><a href="menusetting.php"> <span class="glyphicon glyphicon-cog"></span>Menu Setting</a></li>
                  <li class="<?php echo $ExactName=="pub_setting.php" ? "active" :"";   ?>"><a href="pub_setting.php"><i class="fa  fa-plus-circle" aria-hidden="true"></i> <span>Ad Network Setting</span></a></li>
              </ul>
            </li>
            
            <!--
             <li class="<?php echo $ExactName=="change_my_setting.php" ? "active" :"";   ?>">
                          <a href="change_my_setting.php">
                            <i class="fa fa-cog"></i> <span>Change My Setting</span>
                          </a>
                        </li>-->
            
             <!--<li class="<?php echo $ExactName=="pub_setting.php" ? "active" :"";   ?>">
              <a href="pub_setting.php">
                <i class="fa fa-cog"></i> <span>Ad Network Setting</span>
              </a>
            </li>-->
          
          </ul>
          
        </section>
      
       
      </aside>
