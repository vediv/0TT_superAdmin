<?php 
include_once 'include/function.inc.php';
$id = $_REQUEST['user_id'];
$sel="select * from publisher WHERE par_id ='$id'";
$con = db_select($sel);
foreach($con as $row)
{
$db_pid=$row['par_id']; $db_partnerid=$row['partner_id']; $dbname=$row['name'];   $db_userid=$row['duser_id'];
$db_email=$row['email'];  $db_company=$row['company']; $db_adminsec=$row['admin_secret']; 
$db_serUrl=$row['service_url'];  //$db_Pub=$row['publisher_pass']; 
$db_status=$row['pstatus']; 
$db_create=$row['created_at'];  $db_update=$row['updated_at']; $db_acces=$row['acess_level']; 
$db_parentid=$row['parentid'];  $db_added=$row['addedby']; $db_Name=$row['dbName']; 
$db_hostname=$row['dbHostName'];  $db_Username=$row['dbUserName']; 
//$db_password=$row['dbpassword']; 
$publisherID=$row['publisherID']; $cdnURL=$row['cdnURL'];
}
?>	   

<style>
	.col-md-4{
		min-height: 44px;
	}
</style>
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Publisher detail for <strong><?php echo $dbname; ?></strong> (<?php echo  $publisherID; ?>)   </h4>
      </div>
    <div class="modal-body" >
        <div class="box">
             <!-- /.box-header -->
          <div class="box-body" id="inner-content-div" style="border: 0px solid red; overflow-x: hidden; overflow-y: auto; ">
 
    <div class="row" >
          <div class="col-md-4"><strong>PublisherID :</strong> <?php echo $publisherID; ?></div>
          <div class="col-md-4"><strong>Partner ID  :</strong> <?php echo $db_partnerid; ?></div>
          <div class="col-md-4"><strong>Name :</strong> <?php echo $dbname; ?></div>
          <div class="col-md-4"><strong>User ID :</strong>  <?php echo $db_userid; ?> </div>
          <div class="col-md-4"><strong>Email:</strong> <?php echo $db_email; ?></div>
          <div class="col-md-4"><strong>Company :</strong> <?php echo $db_company; ?></div>
          <!--<div class="col-md-4"><strong>Admin Secret :</strong> <?php echo $db_adminsec; ?></div>-->
          <div class="col-md-4"><strong>Service Url:</strong> <?php echo $db_serUrl; ?></div>
          <!--<div class="col-md-4"><strong>Publisher Pass :</strong> <?php echo $db_Pub; ?></div>-->
          <div class="col-md-4"><strong>PStatus :</strong> <?php echo $db_status; ?></div>
          <div class="col-md-4"><strong>Created At :</strong> <?php echo $db_create; ?></div>
          <div class="col-md-4"><strong>Updated At :</strong> <?php echo $db_update; ?></div>
          <div class="col-md-4"><strong>Accesslevel:</strong> <?php echo $db_acces; ?></div>
          <div class="col-md-4"><strong>Parent ID :</strong> <?php echo $db_parentid; ?></div>
          <div class="col-md-4"><strong>Added By :</strong> <?php echo $db_added; ?></div>
          <div class="col-md-4"><strong>Db Name :</strong> <?php echo $db_Name; ?></div>
          <div class="col-md-4"><strong>DB Hostname :</strong> <?php echo $db_hostname; ?></div>
          <div class="col-md-4"><strong>DB Username :</strong> <?php echo $db_Username; ?></div>
          <!--<div class="col-md-4"><strong>DB Password :</strong> <?php echo $db_password; ?></div>-->
          <div class="col-md-4"><strong>CDN URL :</strong> <?php echo $cdnURL; ?></div>
         
  </div>  
  
        
     </div>
  </div>
</div>             

