<?php include_once 'pagenamem.php';?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
   

    <title><?php echo PROJECT_TITLE."- Dashboard";?></title>
    <!-- Bootstrap 3.3.2 -->
   <style>
 
h3{
	font-size:16px !important;
}
hr{
	border-bottom: 1px solid #41495c !important;
	margin: 16px 10px  !important
}
 </style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      <?php include_once 'headerm.php';?>
      <!-- Left side column. contains the logo and sidebar -->
		<?php include_once 'leftmenu.php';?>
      <!-- Content Wrapper. Contains page content -->
     
        <!-- Content Header (Page header) -->
       
        	<div class=" bg-light lter"> <div class="content-wrapper">
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
<hr />
        <!-- Main content -->
          <section class="content">
        
           
          <?php 
            $results ="SELECT COUNT(1) AS totrec, SUM(IF (pstatus='1',1,0)) AS totactive,SUM(IF (pstatus='0',1,0)) AS totdeactive FROM publisher where acess_level='p' ";
            $fetch = db_select($results);
	    $totalrec=$fetch[0]['totrec'];  $totalactive=$fetch[0]['totactive'];  $totaldeactive=$fetch[0]['totdeactive'];
                //$count = $query->num_rows;
           ?>
               
                      <div class="row">
          
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
              	 
	     <!--
		 <div class="inner"> <h3><?php echo $totalrec ?></h3><p>Total Registration</p></div>
	<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
		  <div class="inner"  style="text-align: center">
	     	 <i class="fa fa-bar-chart-o fa-3x"></i>
	     	  <h3>  <?php echo $totalrec ?>  </h3>
	     </div>
               <a href="puserlist.php?showall=showall" class="small-box-footer"><p>Total Publisher</p> </a>
              </div>
            </div><!-- ./col -->      
               
           <!--
             <div class="col-lg-3 col-xs-6">
                         <div class="small-box bg-color-brown">
                           <div class="inner" style="text-align: center">
                           <i class="fa fa-users fa-3x"></i>
                            <h3> <?php echo $totalactive ?></h3>
                           </div>
                           <a href="user_list.php?showall=active" class="small-box-footer small-box-footer-yellow "><p>Active Users</p> </a>
                         </div>
                         
                       </div>-->
   
            
     <!--
       <div class="col-lg-3 col-xs-6">
                    
                    <div class="small-box bg-color-purple">
                                                   <div class="inner" style="text-align: center">
                             <i class="fa fa-video-camera fa-3x" aria-hidden="true"></i>
     
                           <h3> <?php echo $totaldeactive ?> </h3>
                         </div>
                   
                     <a href="media_content.php" class="small-box-footer small-box-footer-purple"><p>Total Video</p> </a>
                   </div>
                 </div>-->
     <!-- ./col -->
           
           
        </div>
      
 
         
</div>
        <!--<a href="puserlist.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>--></section>  
    <!-- ./wrapper -->
      <?php
      
      include"footer.php";
      ?>
</div>
     </body>
</html>
