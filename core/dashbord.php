<?php
 include_once 'pagename.php';?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <?php include_once 'pagename.php';?>

    <title><?php echo PROJECT_TITLE."-".$PageName;?></title>
    <!-- Bootstrap 3.3.2 -->
   
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      <?php include_once 'header.php';?>
      <!-- Left side column. contains the logo and sidebar -->
		<?php include_once 'lsidebar.php';?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <!--<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <!--<div class="small-box bg-aqua">
											                <div class="inner">
											                  <h3>150</h3>
											                  <p>New Orders</p>
											                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>---><!-- ./col -->
            <!--<div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <!--<div class="small-box bg-green">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
                  <p>Bounce Rate</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>--><!-- ./col -->
            <div class="col-lg-5 col-xs-8">
              <!-- small box -->
              <div class="small-box bg-yellow">
              <div class="inner">
      <?php 
                $results = $mysqli->query("SELECT COUNT(1) AS totrec, SUM(IF (STATUS='1',1,0)) AS totactive,SUM(IF (STATUS='0',1,0)) AS totdeactive FROM user_registration");
                $fetch=mysqli_fetch_array($results);
				$totalrec=$fetch['totrec'];  $totalactive=$fetch['totactive'];  $totaldeactive=$fetch['totdeactive'];
                //$count = $query->num_rows;
           ?>
             
      <div class="row">
  <div class="col-xs-6 col-sm-4"><h3><?php echo $totalrec ?></h3><p>Total Registration</p></div>
  <div class="col-xs-6 col-sm-4"><h3><?php echo $totalactive ?></h3><p>Active Users</p></div>
 <div class="col-xs-6 col-sm-4"><h3><?php echo $totaldeactive ?></h3><p>Deactive Users</p></div>
  
   </div>    
      </div>        
                <!--<div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>-->
                <a href="user_list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
         <!--    <div class="col-lg-4 col-xs-6">
              <!-- small box -->
             <!--  <div class="small-box bg-red">
                <div class="inner">
                  <h3>65</h3>
                  <p>Unique Visitors</p>
                </div>
               <!-- <div class="icon">
                  <i class="ion ion-pie-graph"></i>
               </div>-->
              <!--   <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
         <!--  </div><!-- /.row -->
          <!-- Main row -->
          <div class="row">

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
      
      include"footer.php";
      ?>
    </div><!-- ./wrapper -->

     </body>
</html>
