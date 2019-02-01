<?php 
include_once 'authm.php';
ob_start(); 
//include_once 'functionm.inc.php';
$commanmsg = isset($_GET['val']) ? $_GET['val'] : '';
?>
<!DOCTYPE html>
<html>
 <head>
 <meta charset="UTF-8">
 <?php include_once 'pagenamem.php';?>
<title><?php echo PROJECT_TITLE."-".$PageName;?></title>
<script src="js/commanJS.js" type="text/javascript"></script>
     
  </head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
           <!-- Left side column. contains the logo and sidebar -->
      <?php include_once 'leftmenu.php';?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          Add New Publisher
            </h1>
          <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
                      <li class="active">Add New Publisher</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="col-xs-12">
          <div class="box">
              <div class="box-header" id="msg" style="border:0px solid red; text-align: center; padding-top: 10px;"> 
          </div>
<div class="container">

<div class="row" style="margin-top: 10px;">
 
 <form class="form-horizontal" method="post" id="add_publisherForm"  >
    <div class="form-group">
        <label for="text" class="control-label col-xs-2">Name:</label>
         <div class="col-xs-6">
             <input type="text" class="form-control" name="pname" id="pname"  placeholder="Name">
             <span class="help-block has-error" id="pname-error"></span>
            </div>
        </div>
     
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">Email:</label>
            <div class="col-xs-6">
                <input type="email" class="form-control" id="inputEmail" name="inputEmail"  placeholder="Email">
                 <span class="help-block has-error" id="inputEmail-error"></span>
            </div>
        </div>
        
        <div class="form-group">
        <label for="text" class="control-label col-xs-2">Company:</label>
         <div class="col-xs-6">
           <input type="text" class="form-control" name="company_name" id="company_name"  placeholder="Organization">
            <span class="help-block has-error" id="company_name-error"></span>
            </div>
        </div>
           
            <div class="form-group">
            <label for="text" class="control-label col-xs-2">Admin Secret:</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" name="admin_secret" id="admin_secret"   placeholder="Admin Secret">
                <span class="help-block has-error" id="admin_secret-error"></span>
            </div>
        </div>
        
        
           <div class="form-group">
            <label for="text" class="control-label col-xs-2">Partner ID:</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" name="partnerid" id="partnerid"  placeholder="Partner ID">
                <span class="help-block has-error" id="partnerid-error"></span>
            </div>
        </div>
        
        
            <div class="form-group">
            <label for="text" class="control-label col-xs-2">Service URL:</label>
            <div class="col-xs-6">
                <input type="text" class="form-control" name="service_url" id="service_url"   placeholder="Service URL">
                    <span class="help-block has-error" id="service_url-error"></span>
            </div>
        </div>
        
        <div class="form-group">
          <label for="inputPassword" class="control-label col-xs-2">Password:</label>
         <div class="col-xs-6">
         <input type="password"  class="form-control" id="inputPassword" name="inputPassword"   placeholder="Password">
             <span class="help-block has-error" id="inputPassword-error"></span>
         </div>
         
        </div>

       
        <div class="form-group">

            <div class="col-xs-offset-2 col-xs-6">

 <button type="button" class="btn btn-primary" name="add_publisher"  onclick="addNewPublisher();"  >Create</button>

            </div>

        </div>

    </form>



		         </div>
 </div>             
                
              </div>
 </div><!-- /.box -->  </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
       include_once"footer.php";
      ?>
    </div><!-- ./wrapper -->


       </div>
  </body>
</html>
