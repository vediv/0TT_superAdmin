<?php 
include_once 'auth.php';
ob_start(); 
include_once 'function.inc.php';
$commanmsg = isset($_GET['val']) ? $_GET['val'] : '';
if($commanmsg=="edit")
{ $msgcall="Successfully Edit";  }
?>



<!DOCTYPE html>
<html>
  <head>

  	    <meta charset="UTF-8">
  	    <?php include_once 'pagename.php';?>

  	    <?php //if($PageName=="data"){?>
     <title><?php echo PROJECT_TITLE."-".$PageName;?></title>
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
           User List
            </h1>
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
                      <li class="active">User List</li>
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
  <?php
	
if(isset($_POST['sub'] ))
{
$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$loc=$_POST['location'];


$query3="update user_registration set uname='$name', uemail='$email',dob='$dob',ugender='$gender',ulocation='$loc',added_date=Now() where uid='$id'";

 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Update(".$email.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
$q= $mysqli->query($query3);
if($q)
 {
    header('location:user_list.php?val=edit');
  }
}

?>
           <div class="box-body">
 	
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>User-Id</th>
                        <th>Name</th>
                        
                        <th>Email</th>
                        <th>Dob</th>
                        <th>Gender</th>
                        <th>Location</th>
                        <th>Register Date</th>
                        <th>Provider</th>
                        <th>Status</th>
						<th width="10%">Action</th>
                      </tr>
                    
                    </thead>
                    <tbody>
                    	
<?php 
include_once 'core_config.php';
$partnerID=PARTNER_ID;
// value come from notification
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$user_status = isset($_GET['ustatus']) ? $_GET['ustatus'] : '';
$showall = isset($_GET['showall']) ? $_GET['showall'] : '';

$query="select uid,user_id,uname,uemail,dob,ugender,ulocation,added_date,status,oauth_provider,partner_id from user_registration ";
if($user_id!='')
{
	$query.=" where uid ='$user_id' and partner_id='$partnerID'";
	
}
if($showall=='showall')
{
	$query.=" where status=0 and partner_id='$partnerID' order by uid DESC";
	
}
if($showall=='' and $user_id=='')
{
	$query.=" where  partner_id='$partnerID' order by uid DESC";
	
}

//echo $query;
 $r= $mysqli->query($query);
 $num=mysqli_num_rows($r);
 //echo "Total Record=".$num;
 $i=1;
 while($fetch=mysqli_fetch_array($r))
  {
     $id=$fetch['uid'];
	 $user_id=$fetch['user_id'];
	 $name=$fetch['uname'];
	 $email=$fetch['uemail'];
	 $dob=$fetch['dob'];
	 $gen=$fetch['ugender'];
	 $loc=$fetch['ulocation'];
	 $add_date=$fetch['added_date'];
	 $prob=$fetch['oauth_provider'];
	 $u_status=$fetch['status'];
	 
 ?> 
  <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $user_id ;?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $dob; ?></td>
        <td><?php echo $gen; ?></td>
        <td><?php echo $loc; ?></td>      
        <td><?php echo $add_date; ?></td>
        <td><?php echo  $prob; ?></td>
        <td><div id="ajax_div<?php echo $id; ?>"><?php echo ($u_status==1  ? "verified" : "Not verified" ) ; ?></div>
                        	</td>
						<td id="ajax_action<?php echo $id; ?>">
                       <a href="javascript:void(0)" data-status="<?php echo $u_status; ?>" id="<?php echo $id; ?>&email=<?php echo $email ;?>"  class="delete" title="Delete"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;
                      <!-- <a href="edit.php?eid=<?php echo $id;  ?>" class="fancybox fancybox.ajax" ><span class="glyphicon glyphicon-edit"></span></a>  &nbsp;&nbsp;&nbsp;-->
                  
                  
              <a href="#LegalModal" id="<?php echo $id; ?>"  data-target=".bs-example-modal-lg" data-toggle="modal" title="Edit" class="result"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;
 

 	 <div id="LegalModal" tabindex="-1" aria-labelledby="myModalLabel" role="dialog"  aria-hidden="true" class="modal fade bs-example-modal-lg" data-backdrop="static" data-keyboard="false">
<!--<div id="modal_id" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">-->
      <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 14px; width:500px">
               <div class="modal-body">
                   <div class="modal-header">
                    <button type="button" class="close" 
                         data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"> <b>Edit User Details </b></h4> 
                 </div>
               
           
          
         <div class="tab-content" id="tabs">

							          

         <?php //include"model.php"; ?>
 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


                         
<a id="function_cal<?php echo $id; ?>" href="#" onclick="return action('<?php echo $id; ?>','<?php echo $u_status; ?>')"  class="change-status" title="<?php echo ($u_status == 1) ? 'Active':'Deactive';?>">
 <i id="checkuncheck<?php echo $id; ?>" class="status-icon fa <?php echo ($u_status == 0) ? 'fa-ban':'fa-check-square-o';?>"></i>
                         </a>         	 
                        	            	
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
	/*Activate deactivate through image */
	
		function action(id,status) {
	    $.get('userstatus.php',{activid:id,activestatus:status},function(r){
	   //  alert(r);
	     var d = r.split("@");
         var astatus = d[0];
   	      var aid = d[1];
	     if(astatus==1)
	     { 
	     	var m="varified";
	     	var title_href="User Active";
	     	var title_img="status-icon fa fa-check-square-o";
	     	var msg=title_href+ " successfully";
	     	
	     	//$("a").attr("href", "http://www.google.com/")
	     }
	     if(astatus==0)
	     { 
	     	var m="Not varified";
	     	var title_href="User Deactive";
	     	var title_img="status-icon fa fa-ban";
	     	var msg=title_href+ " successfully";
	     }
	    
	     bootbox.alert(msg);
			$('#ajax_div'+aid).html(m); 
	     	$("#function_cal"+aid).attr("onclick","return action("+aid+","+astatus+")");
	     	$("#function_cal"+aid).attr("title",title_href);
	     	$('#checkuncheck'+aid).attr("class",title_img);
		//$('#ajax_div').html(result)
			//$('#ajax_div1').html('');
			 window.location.reload();
	
		});
          
       }
	
	</script>

<!--<script src="../fancyBox/source/jquery.fancybox.js"></script>
<link href="../fancyBox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	/* popup image script through fancybox 
var $= jQuery.noConflict();
		$(document).ready(function() {
			$('.fancybox').fancybox({
			'autoDimensions': false,
			
    closeBtn    : true, // hide close button
    closeClick  : false, // prevents closing when clicking INSIDE fancybox
    helpers     : {
        // prevents closing when clicking OUTSIDE fancybox
        overlay : {closeClick: false,
        	css: {
                    'background': 'rgba(204, 174, 211, 0.77 )',
                    

                }
        	}
    },

   }); 
			
		});*/
</script>-->


  
<script type="text/javascript">
$(document).ready(function() { //return false;
    
$(".result").click(function(){//alert ("param");
$('#LegalModal').modal({
            backdrop: 'static'
           
        });
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
   // alert("hi" + info);

 $.ajax({
   type: "POST",
   url: "edit.php",
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
$(document).ready(function() {
$(".delete").click(function(){
var element = $(this);
var del_id = element.attr("id");
var name=element.attr("name");
var info = 'id=' + del_id ;//+ '&name'+ name;

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
   url: "delete.php",
   data: info,
   success: function(result){
   //	window.location.href='user_list.php';
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
bootbox.alert("<?php echo $msgcall;?>", function() {
 window.location.href='user_list.php';
});


//window.location.reload='home_setting.php';
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
