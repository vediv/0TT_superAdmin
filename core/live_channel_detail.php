<?php 
ob_start(); 
include_once 'function.inc.php';
 $message='';
include_once '../include/connect_db.php';
$commanmsg = isset($_GET['val']) ? $_GET['val'] : '';
if($commanmsg=="Deactive")
{ $msgcall="Channel Deactive Successfully";  }
if($commanmsg=="Active")
{ $msgcall="Channel Active Successfully";  }
if($commanmsg=="update")
{ $msgcall="priority Saved Successfully";  }
if($commanmsg=="sucess")
{ $msgcall="Successfully Added";  }
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
header('application/json');
include_once '../include/connect_db.php';

     function getRandomCode(){
     $an = "0123456789abcdefghijklmnopqrstuvwxyz_";
     $su = strlen($an) - 1;
     return substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1);
                        }

if (isset($_FILES["userfile"]["name"])){
$status=0;
$err = $_FILES["userfile"]["error"];
	if($err > 0){
		echo "Error in Upload : ".$err;
	}else{
		
	     $video_url=$_POST['video_url'];
		 $channel_status=$_POST['channel_status'];
		$nameOfFile = $_FILES["userfile"]["name"];			
		$typeOfFile = $_FILES["userfile"]["type"];
		$sizeOfFile = $_FILES["userfile"]["size"];
		$locationOfFile=$_FILES["userfile"]["tmp_name"];
	    list($width, $height, $type, $attr) = getimagesize($locationOfFile);
		
	$imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
	
	// get random funtion call

	
	$liveid=getRandomCode();
		
		//if($width >2180){
	if (($_FILES['userfile']['type']=="image/gif") 
		|| ($_FILES['userfile']['type']=="image/tif") 
	    ||($_FILES['userfile']['type']=="image/jpg") 
		||($_FILES['userfile']['type']=="image/jpeg") 
		|| ($_FILES['userfile']['type']=="image/png")) 
		{
			
   if($width >299 and $height < 299) {
    	
		
      $query = "INSERT INTO live_channel(live_id,live_logo,video_url,channel_status,channel_create_date) values('$liveid','$imgData','$video_url','$channel_status',NOW())";
	  $r=$mysqli->query($query);
	
	}else{$message="Image dimesion invalid";}
	
}
else{
 $message="Image Type Invalid";
 
}



    }
					if($r)
					{
						header("Location:live_channel_detail.php?val=sucess");
						 /*----------------------------update log file begin-------------------------------------------*/
					  // $cdate=date('d/m/Y H:i:s');  $action="Upload image(".$nameOfFile.")"; $username=$_SESSION['username'];
					 //  write_log($cdate,$action,$username);
					    /*----------------------------update log file End---------------------------------------------*/ 
					}

else 
{
	 header("live_channel_detail.php?val=error"); 
}    
}
?>
   <!-- Left side column. contains the logo and sidebar -->
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Live Channel 
          <?php
// this following code for active and deactive
 $livid = isset($_GET['livid']) ? $_GET['livid'] : '';
$channelStatus= isset($_GET['channelstatus']) ? $_GET['channelstatus'] : '';
// $imgname= isset($_GET['iname']) ? $_GET['iname'] : '';
$sucess_msg='';
 if($livid!='' and $channelStatus!='')
 {
 	$channelStatusU= ($channelStatus==0) ? 1 : 0;
 
 $upactive="update live_channel set channel_status='$channelStatusU' where live_id='$livid' ";
 $ractive=$mysqli->query($upactive);
 
 
 $sucess_msg= ($channelStatus==0) ? "Active" : "Deactive";
// header("location:live_channel_detail.php?val=$sucess_msg");
  
 }
  ?>
 
 
 <?php
 //echo "location:live_channel_detail.php?val=$sucess_msg";
 
 
  /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Image $sucess_msg(".$livid.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
 

 ?>
       	
          	
          	<!--<ul class="list-unstyled legal-tabs" style="text-align:center;">-->
       <a href="#LegalModal" data-target=".bs-example-modal-lg" data-toggle="modal" title="Add New"><small><span class="glyphicon glyphicon-plus" style="color:#3290D4"></span></small></a></h1> 
        <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Live Channel</li>
          </ol>          
            <span style="color: red;"><?php  echo  $message;?>   </span>
   
        </section>
       
        <section class="content">
           <div class="row">
          <div class="col-xs-12">
          <div class="box">
        <div class="box-header">
 <?php
if(isset($_POST['img_up'] ))
{
$id_1=$_POST['id1'];
$iurl=$_POST['iurl'];

$query3="update live_channel set video_url='$iurl' where live_id='$id_1'";

$q= $mysqli->query($query3);
if($q)
 {
    	header("Location:live_channel_detail.php");  
  }
}

?>
      
     <style>
textarea
{
resize:none;
}

</style>   
<div id="LegalModal" class="modal fade bs-example-modal-lg" aria-hidden="true" data-backdrop="static" data-keyboard="false">
<!--<div id="modal_id" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">-->
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
                  <b>Add live Channel Detail</b>
                </h4>
            </div>
             <br/>     
   
           <form action="" method="post" enctype="multipart/form-data" id="myForm" name="myForm"  >
				  
			<div class="form-group">
			<label>Video Url</label>
			<input type="text" class="form-control" name="video_url" id="video_url" placeholder="Video Url"  required> 
			</div>
			<div class="form-group">
			<label>Video Status</label>
			<select class="form-control" name="channel_status" id="channel_status">
			  <option value="0">Deactive</option>
			  <option value="1">Active</option>
			  
			</select>

            </div>  
			<div class="form-group">
			<label for="exampleInputFile">File input</label>
			<input type="file" id="input" name="userfile"  />                      
			<!-- <img id="output"/>-->
			(Image :Height :300px  width:530px)
			</div>  


			

<div class="modal-footer">
								  
<div class="col-sm-offset-2 col-sm-5">
<button  type="submit" name="submit" value="Submit"  class="btn btn-primary" >Submit</button>
</div>
</form>
</div>
   
               
                
                
			
 </div> 
		
  </div>
    </div>
  </div>
  
</div>

<!-- Main content -->
    
 
      
         <!-- /.row -->    
         

          <!-- =========================================================== -->

          <!-- Small boxes (Stat box) -->
        
        
          	
		  <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Live Channels</h3>
                 
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action="#" id="form" name="form">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Live Id</th>
                       <th>Channel Logo</th>
                       <th>Video Url</th>
                         <th>Date</th>
                          <th>Channel Status</th>
                          <th>Action</th>
                       
                      </tr>                   
                       </thead>
                    <tbody>
                    	
                  <?php 
				  $query1 = "Select * from live_channel order by live_id";
                  $result= $mysqli->query($query1); 
			      $num=mysqli_num_rows($result);
			       $i=1;
            
					while($value=mysqli_fetch_array($result))
					{ 
					  $liveid=$value['live_id'];
					  $live_logo=$value['live_logo'];
					  $video_url=$value['video_url'];
					  $channel_status=$value['channel_status'];
					 
					  if( $channel_status==1)
					  {
					  	$channel_status1='Active';
					  }else{ $channel_status1='Deactive';}
						?>
					<tr id="<?php echo $value['live_id']; ?>">
                        <td><?php echo $liveid; ?></td>   
                    
             <td>  <a class="fancybox" href="<?php echo 'data:image/jpeg;base64,' . base64_encode( $value['live_logo'] );?>" data-fancybox-group="gallery" >
				<img style=" height:60px; width: 150px;width: 150px;" src="<?php echo 'data:image/jpeg;base64,'. base64_encode( $value['live_logo'] );?>" alt=""/></a> </td>
                        	<!--<style>
                       img{
 					   height: 60px;
    				   margin-top: 0;
                       width: 150px;
                       }</style>-->
                        
                        <td><?php echo $video_url;?></td>
                        <td><?php echo $value['channel_create_date'];?></td>
                        <td><?php echo $channel_status1; ?></td>
                        <td><a href="live_channel_detail.php?livid=<?php echo $liveid;?>&channelstatus=<?php echo $channel_status; ?>" class="change-status" title="<?php echo ($channel_status == 1) ? 'Active':'Deactive';?>">
                            <i class="status-icon fa <?php echo ($channel_status==1) ? 'fa-check-square-o':'fa-ban';?>"></i>   
                            </a>&nbsp;&nbsp;&nbsp;
                            <a href="#myModal" id="<?php echo $liveid; ?>"  data-target="#myModal" data-toggle="modal" title="Edit" class="addnew"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;
                            <a href="#" data-id="<?php echo $value['live_id']; ?>" data-status="<?php echo $channel_status; ?>" class="delete" title="Delete" ><span class="glyphicon glyphicon-trash"></span></a>
                       </td> 
                      	
           </tr>             
              
<?php $i++; 
}?>
                    </tbody>
                                      </table>
     <!--   <p align="center"> <button type="submit" name="savechanges" class="btn btn-primary">Save Changes</button></p>-->
           </form>         
     
 </div>
 </div>             
                
               <!-- /.box-body -->
 </div><!-- /.box -->  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
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
                  <b>Edit Video Url</b>
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
$(document).ready(function() { //return false;
    
$(".addnew").click(function(){//alert ("param");
$('#myModal').modal({
            backdrop: 'static'
           
        });
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
   //alert("hi" + info);

 $.ajax({
   type: "POST",
   url: "edit_live_logo.php",
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
var del_id = element.attr("data-id");

var info = 'id=' + del_id;
var st=$(this).data("status");
//alert(st);
if(st==1)
{
	alert('This image is active so you can not delete');
	return false;
}

if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "remove_logo.php",
   data: info,
   success: function(result){  
   	//alert(result);
  // window.location.reload();//href='slider-images.php'; 
   if(result)
   {
   	alert("Image delete successfully")
   	 window.location.reload(); 
   }
 
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
  
   $(document).ready(function() {
   	
       $("#myFormSubmit").click(function() {  
       	 var name= document.getElementsByName("userfile")[0].value; 
         var video_url= document.getElementById("video_url").value;
		 var channel_status= document.getElementById("channel_status").value;
		 var channeladd="channeladd";
   		
         if(video_url=='')
       	 {
       	 	alert("Enter video Url ?");
       	 	return false;
       	 }                
		
       	 if(name=='')
       	 {
       	 	alert("Select a channel logo?");
       	 	return false;
       	 }                
          var info = 'name=' +name+'&videourl='+video_url+'&channelstatus='+channel_status+'&event='+channeladd;
		  
		  //var info = 'name=' +name+'videourl='+video_url+'channelstatus='+channel_status+'event='+channeladd;
		  
         // alert(info); 
          
        $.ajax({
   		type: "POST",
   		url: "img_logo.php",
   		data: info,
   		success : function(msg){
   		 //alert(msg);
   			if(msg==1)
   			{
   				alert("Image already exist upload with different name");
   				return false;
   			}
   			if(msg==2)
   			{
   				
   		       //alert("dadasfbaskbfkasfk");
			  document.myForm.submit();
   				
   			}
       
       }
     
         });
  //return false;
       });
   });

</script>

<script type="text/javascript">
	/* popup image script through fancybox */
var $= jQuery.noConflict();
		$(document).ready(function() {
			$('.fancybox').fancybox({

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
 window.location.href='live_channel_detail.php';
});
</script>

  </body>
</html>
