<?php ob_start(); 
include_once 'function.inc.php';
 $message='';
include_once '../include/connect_db.php';
$commanmsg = isset($_GET['val']) ? $_GET['val'] : '';
if($commanmsg=="Deactive")
{ $msgcall="Deactive Successfully";  }
if($commanmsg=="Active")
{ $msgcall="Active Successfully";  }

if($commanmsg=="sucess")
{ $msgcall="Successfully Added";  }
if($commanmsg=="edit")
{ $msgcall="Successfully Update";  }
?>
  
<!DOCTYPE html>
<html>
  <head>
  	
  	

    <meta charset="UTF-8">
    	<?php include_once 'pagename.php';?>
    <title><?php echo PROJECT_TITLE."-".$PageName;?></title>
  
  </head>
  <body class="skin-blue">
    <div class="wrapper">
<?php include_once 'header.php';?>

<?php include_once 'lsidebar.php';?>


<?php
// this following code for active and deactive
 $did = isset($_GET['did']) ? $_GET['did'] : '';
 $status= isset($_GET['status']) ? $_GET['status'] : '';
 $dname= isset($_GET['name']) ? $_GET['name'] : '';
 $status= ($status==0) ? 1 : 0;
 
$upactive="update dashbord_user set status='$status' where did=$did";
 $ractive=$mysqli->query($upactive);
 if($ractive){
  $sucess_msg= ($status==1) ? "Active" : "Deactive";
  ?>
 <?php header("location:dashboarduser.php?val=$sucess_msg");
 
  /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="dashboard user $sucess_msg(".$dname.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
 
 }
 ?>
 
 
  <?php
 
if(isset($_REQUEST['save']))
	{
	 	$name=$_REQUEST['name']; $username=$_REQUEST['username'];
	 	$email=$_REQUEST['email'];
		$pwd=$_REQUEST['pwd'];
		$gender=$_REQUEST['gender'];
		$sql="insert into dashbord_user(dname,duser_id,demail,dpassword,dgender,status,added_date) values ('$name','$username','$email','$pwd','$gender','1',NOW())";
        $r=$mysqli->query($sql);
if($r)
{
	header("Location:dashboarduser.php?val=sucess");
	
	/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Add admin (".$email.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
   
}

else 
{
	 header("dashboarduser.php?val=error"); 
}    
	
	 
}
	
?>

      <!-- Left side column. contains the logo and sidebar -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          
          <h4>Add New User For Dashboard
       <a href="#myModal" class="addnew" id="add" title="New Admin" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>    	
 </h4>
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
                      <li class="active">Admin Setting  </li>
          </ol>
        </section>
     <section class="content">
           <div class="row">
          <div class="col-xs-12">
          <div class="box">
        <div class="box-header">
<?php
	
/*if(isset($_POST['img_up'] ))
{
$id_1=$_POST['id1'];
$iurl=$_POST['iurl'];

$query3="update slider_image_detail set img_url='$iurl' where img_id='$id_1'";

$q= $mysqli->query($query3);
if($q)
 {
    	header("Location:slider-images.php");  
  }
}
*/
?>
      
     <style>


</style>   
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 14px; ">
        <div class="modal-body">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Add New User For Dashboard</b>
                </h4>
            </div>
       <br/>
						 	       <form class="form-horizontal" role="form" action="#" method="post" id="confirm">
													    <div class="form-group">
													      <label class="control-label col-sm-3">Name:</label>
													      <div class="col-sm-5">
													        <input type="text" class="form-control" required name="name" placeholder="Name">
													      </div>
													    </div>
													     <div class="form-group">
													      <label class="control-label col-sm-3">User Name:</label>
													      <div class="col-sm-5">
													        <input type="text" class="form-control" required name="username"  placeholder="username" pattern="^[a-z\d\.]{5,}$">
													        eg : san188
													      </div>
													    </div>
													    
													    
									    <div class="form-group">
									      <label class="control-label col-sm-3" >Email:</label>
									      <div class="col-sm-5">          
									        <input type="email" class="form-control" name="email" required  placeholder="Email" >
									      </div>
									    </div>
									    <div class="form-group">
									      <label class="control-label col-sm-3" >Password:</label>
									      <div class="col-sm-5">          
									        <input type="password" class="form-control" name="pwd" required  placeholder="Password" >
									      </div>
									    </div>
									     <div class="form-group">
									      <label class="control-label col-sm-3" >Gender:</label>
									      <div class="col-sm-5">          
									        <input type="text" class="form-control" name="gender" required  placeholder="Gender" >
									      </div>
									    </div>
									    
						    <div class="modal-footer">
									          
									      <div class="col-sm-offset-2 col-sm-5">
									        <button type="submit" name="save" class="btn btn-primary" >Submit</button>
									      </div>
									    </div>

						  </form>
			
		 </div> 
		
  </div>
    </div>
  </div>
</div>

        
        
        
            <div class="box">
 <!-- /.box-header -->
 


           <div class="box-body">
 	 <form method="post">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                         <th>Name</th>
                       <!-- <th>Image Url</th>-->
                         <th>Email Id</th>
                          <th>Gender</th>
                          <th>Status</th>
                          <th>Added date</th>
                        <th>Action</th>
                         
                      </tr> 
                    
                    </thead>
                    <tbody>
 
                    	
          	<?php
          	//update dashboard user detals here
          if(isset($_REQUEST['save1']))
			{
				$dname=$_POST['dname'];
				$demail=$_POST['demail'];
				$dgender=$_POST['dgender'];
				$did=$_POST['did'];
				
				 $up="update dashbord_user SET dname='$dname', demail='$demail',dgender='$dgender' where did='$did'";
				$res1=$mysqli->query($up);
			
			header("location:dashboarduser.php?val=edit");
			/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Edit admin (".$demail.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
			}
          	?>

       
                  <?php 
                  $query1 = "SELECT * FROM `dashbord_user` where alevel='A'";
               $result= $mysqli->query($query1); 
			    $num=mysqli_num_rows($result);
			    $i=1;
            
					while($value=mysqli_fetch_array($result))
					{ 
					  $did=$value['did'];
					  $username=$value['dname'];
					  $demail=$value['demail'];
					  $gender=$value['dgender'];
					  $date=$value['added_date'];	
					   $status=$value['status'];
					  if( $status==1)
					  {
					  	 $status1='Active';
					  }else{ $status1='Deactive';}
						?>
					<tr id="<?php echo $did; ?>">
                        <td><?php echo $username;  ?></td>
                        <!--<td><?php echo $value['img_url'];?></td>-->
                        <td><?php echo $value['demail'];?></td>
      
                  <td>
    
    
    
    <?php echo $gender; ?>    
    </td>
    <td><?php echo $status1; ?></td>
    <td><?php echo  $date; ?></td>
                          <td>   	
    <!--<a href="#myModal" class="addnew" id="<?php echo $id; ?> title="Edit" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-edit " ></span></small></a> -->   	
            
                <a href="#" data-id="<?php echo $did; ?>&name=<?php echo $username;?>" data-status="<?php echo $status; ?>" class="delete" title="Delete" ><span class="glyphicon glyphicon-trash"></span></a>&nbsp;&nbsp;&nbsp;
              <a href="#myModal1"  id="<?php echo $did; ?>"  data-target="#myModal" data-toggle="modal" title="Edit" class="addnew1"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;
 
              <!--<a href="#" data-id="<?php echo $value['img_id']; ?>" class="delete" title="Delete" ><input type="button" name="btn1" id="btn2" value="delete" /></a>-->
          <a href="dashboarduser.php?did=<?php echo $did;?>&status=<?php echo $status; ?>&name=<?php echo $username;?>" class="change-status" title="<?php echo ($status== 1) ? 'Active':'Deactive';?>">
      <i class="status-icon fa <?php echo ($status==1) ? 'fa-check-square-o':'fa-ban';?>"></i>   
      </a>	&nbsp;&nbsp;&nbsp;
               </td> 
                      	
           </tr>             
                      
                     
                      
                      
                    
                      
<?php //$i++; 
}?>
                    </tbody>
                                      </table>
           </form>         
     
 </div>
 </div>             
               <!-- /.box-body -->
 </div><!-- /.box -->  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <div class="modal fade" id="myModal1" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 14px; ">
        <div class="modal-body">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Edit dashboard user Details</b>
                </h4>
            </div>
       <br/>
			<div class="tab-content" id="tabs">
				</div>			 	       
		 </div> 
		
  </div>
    </div>
  </div>
</div>

      
     <?php
      
      include"footer.php";
      ?>
    </div><!-- ./wrapper -->
    
    
    
    
    <script type="text/javascript">
$(document).ready(function() {
$(".delete").click(function(){
var element = $(this);
var del_id =$(this).data("id");

var info = 'id=' + del_id;
//alert(info);
var st=$(this).data("status");
//alert(st);
if(st==1)
{
	alert('This User is active so you can not delete');
	return false;
}

if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "delete_dashboarduser.php",
   data: info,
   success: function(result){
   		//alert(result);		
      if(result)
      {
      	alert("Delete successfully");
      }
      window.location.reload();
 }
});
 var row = $(this).closest('tr');
var siblings = row.siblings();                      // *
            row.remove();                                       // *
            siblings.each(function(index) {                     // *
                $(this).children('td').first().text(index + 1); // *
            });
 // $(this).parents(".table tr").animate({ backgroundColor: "#003" }, "slow")
  //.animate({ opacity: "hide" }, "slow");
   
 }
return false;
});
});


</script> 
   <script type="text/javascript">
$(document).ready(function() { //return false;
    
$(".addnew1").click(function(){//alert ("param");
$('#myModal1').modal({
            backdrop: 'static'
           
        });
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
   // alert("hi" + info);

 $.ajax({
   type: "POST",
   url: "edit_dashboarduser.php",
   data: info,
   success: function(result){
       //alert(result);
      
       $('#tabs').html(result);
      
     //$("#LegalModal").modal('show');
        //return false;
          
 }
 
});
return false;
    
});

});
</script>   
    

	<script type="text/javascript">
	
	$(".ranking").each(function(){
    $(this).data('__old', this.value);
}).change(function() {
    var $this = $(this), value = $this.val(), oldValue = $this.data('__old');

    $(".ranking").not(this).filter(function(){
        return this.value == value;
    }).val(oldValue).data('__old', oldValue);

    $this.data('__old', value)
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

	
 <script type="text/javascript">
bootbox.alert("<?php echo $msgcall;?>", function() {
 window.location.href='dashboarduser.php';
});
</script>

  </body>
</html>
