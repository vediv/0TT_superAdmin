<?php 
include_once 'auth.php';
ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>

  	    <meta charset="UTF-8">
  	    <?php //if($PageName=="data"){?>
  	    	<?php include_once 'pagename.php';?>

   <title><?php echo PROJECT_TITLE."-".$PageName;?></title>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'header.php';?>
           <!-- Left side column. contains the logo and sidebar -->
      <?php include_once 'lsidebar.php';?>
      <!-- Content Wrapper. Contains page content -->
<?php    
if(isset($_REQUEST['save']))
	{
	 	$ttag=$_REQUEST['ttag']; $stag=$_REQUEST['stag'];
        $sql="insert into home_title_tag (title_tag_name,search_tag,tag_status,priority,create_date) Select '$ttag','$stag','0',ifnull(max(priority),0)+1,NOW() from home_title_tag";
        $r=$mysqli->query($sql);
if($r)
{
	header("Location:view_log_history.php?val=sucess");
}

else 
{
	 header("view_log_history.php?val=error"); 
}    
	
	 
}
 ?>  
      <div class="content-wrapper">
 <section class="content-header">
          <h1>
           View Log History
            </h1>
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
                      <li class="active">Log History</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="col-xs-12">
          <div class="box">
          <div class="box-header">
          
          </div><!-- /.box-header -->


              <div class="box">
 <!-- /.box-header -->
 
           <div class="box-body">
 	
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                           <th>User Name</th>
                            <th>Song Id</th>
                           <th>Category Id</th>
                         <th>Song Title </th>
                
                        <th>Tags</th>
                         <th>View Date</th>
						<th>Last Seen</th>
                      </tr>
          </thead>
                    <tbody>
                    	
                    <?php 
// value come from notification


 $q="select uavl.*,ur.uname from user_authentication_view_log AS uavl LEFT JOIN user_registration as ur on uavl.uid=ur.uid order by uavl.uaid desc";

//echo $query;
 $rr= $mysqli->query($q);
 $num=mysqli_num_rows($rr);

 $i=1;
 while($fetch=@mysqli_fetch_array($rr))
  {
     $userid=$fetch['uid'];
     $uname=$fetch['uname'];
	 $id1=$fetch['uaid'];
	 $songid=$fetch['song_id'];
	 $categoryid=$fetch['category_id'];
	 $viewdate=$fetch['view_date'];
	 $lastseen=$fetch['last_seen'];
	 $songtitle=$fetch['song_title'];
	 $tags=$fetch['tags'];
	
	 
 ?>  
                <tr>
                        
                         <td><?php echo $i++; ?></td>
                          <td><?php echo $uname; ?></td>
                         <td><?php echo $songid ;?></td>
                        <td><?php echo $categoryid?></td>
                        <td><?php echo $songtitle; ?></td>
                         <td style="text-align: justify"><?php echo $tags; ?></td>   
                        <td><?php echo $viewdate; ?></td>
                      <td><?php echo $lastseen; ?></td>
                   </td>
</tr>
                  <?php } ?>  
                          
                    </tbody>                  
                  </table>         
    
 </div>
 </div>             
                
               <!-- /.box-body -->
 </div><!-- /.box -->  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
       include_once"footer.php";
      ?>
    </div><!-- ./wrapper -->

<script type="text/javascript">
$(document).ready(function() {
$(".delete").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "delete.php",
   data: info,
   success: function(result){
     
 }
});
  $(this).parents(".table tr").animate({ backgroundColor: "#003" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
</script>   
  <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script> 
       </div>
  </body>
</html>
