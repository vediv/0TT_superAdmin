  <?php include_once 'pagename.php';?>
<!DOCTYPE html>
<html>
  <head>
  	
  	

    <meta charset="UTF-8">
    <title><?php echo  $PageName;?></title>
  
  </head>
  <body class="skin-blue">
    <div class="wrapper">
<?php include_once 'header.php';?>

<?php include_once 'lsidebar.php';?>
      <!-- Left side column. contains the logo and sidebar -->
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Image Slider <!--<ul class="list-unstyled legal-tabs" style="text-align:center;">-->
       <a href="#LegalModal" data-target=".bs-example-modal-lg" data-toggle="modal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus "></span></small></a></h1> 
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Image Slider</li>
          </ol>
        </section>
        
        
<div id="LegalModal" class="modal fade bs-example-modal-lg" aria-hidden="true" data-backdrop="static" data-keyboard="false">
<!--<div id="modal_id" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">-->
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="tabbable"> <!-- Only required for left/right tabs -->
          <ul class="nav nav-tabs">
		   <button type="button" class="close" data-dismiss="modal">&times;</button>
		  
            <li class="active"><a class="tab1" href="#tab1" data-toggle="tab">Image Upload</a></li>
            <!--<li><a href="#tab2" data-toggle="tab">Tab 2</a></li>-->
          </ul>
          <div class="tab-content" id="tabs" style="padding:30px;">
            <div class="tab-pane active" id="tab1">
                  
                  <div class="row">
        <form action="" method="post" enctype="multipart/form-data" id="myForm" name="myForm">
               <div class="box-body">
                  <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" id="userfile" name="userfile" required="">
                      (image dimenson should be 2216px * 500px)
                   </div>
                 
               </div>
               <!--box-body -->
              </form>
               
                <div class="btn-group">
                  <button  type="button" name="submit" value="Submit" id="myFormSubmit" class="btn btn-primary" >Submit</button>
               
                  <!--<button type="button" name="submit" value="Submit" id="myFormSubmit" class="btn btn-primary">submit</button>-->
                  </div>
            
  <script type="text/javascript">
   $(document).ready(function() {
       $("#myFormSubmit").click(function() {
       	 
           var name= document.getElementsByName("userfile")[0].value;
          var info = 'name=' + name;
          // alert(info);
            $.ajax({
   		type: "POST",
   		url: "img.php",
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
   				//alert(msg);
   		//	$("#myForm").submit();
   		document.myForm.submit();
   				
   			}
       
      
       }
     
         });
  //return false;
       });
   });
</script>
  <?php
 // $img_type=array('image/gif','image/jpeg','image/png','image/tif');
  
if (isset($_FILES["userfile"]["name"])){
$path = "img/";
$status=1;



$err = $_FILES["userfile"]["error"];
	if($err > 0){
		echo "Error in Upload : ".$err;
	}else{
	
		$nameOfFile = $_FILES["userfile"]["name"];
		$typeOfFile = $_FILES["userfile"]["type"];
		$sizeOfFile = $_FILES["userfile"]["size"];
		$locationOfFile=$_FILES["userfile"]["tmp_name"];
		 $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
		if (($_FILES['userfile']['type']=="image/gif") ||  ($_FILES['userfile']['type']=="image/jpeg") || ($HTTP_POST_FILES['userfile']['type']=="image/png")) {
		//if(is_array($img_type)){
	
		move_uploaded_file($locationOfFile,"img/".$nameOfFile);
		//$url = $protocol.'://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI']);
		//$ptah_url= $url.'/img/'.$nameOfFile;		
		
		
		  $query = "INSERT INTO slider_image_detail (img_name,img_url,image,img_status,img_create_date) VALUES ('$nameOfFile','','$imgData',$status,NOW() )";
		$mysqli->query($query);
	
}else
{
 echo"Image is not valid";
}
    }


}

?>
</div>                 
                            
            </div>
            <!--<div class="tab-pane" id="tab2">
              <h1>Privacy Policy</h1>
            </div>-->
         <!-- </div>-->
        </div>
		</div>
      </div>
    </div>
  </div>
</div>
   
<!-- Main content -->
    
 
        <section class="content">
         <!-- /.row -->    
         

          <!-- =========================================================== -->

          <!-- Small boxes (Stat box) -->
        <?php
        
       // echo $message;
        ?>
          <div class="row">
          	<?php $query1 = "Select *from slider_image_detail";
               $result= $mysqli->query($query1); 
               ?>
		  <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List Of Uploaded Image</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action="#" id="form" name="form">
                		<div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Image</th>
                         <th>Date</th>
                        <th>Action</th>
                       
                      </tr>                    </thead>
                    <tbody>
                    	
					<?php while($value=mysqli_fetch_array($result)){
					$img_status=$value['img_status'];
						
						?>
					<tr id="<?php echo $value['img_id']; ?>">
                        <td><!--<img src ="<?php echo $value['img_url'];?>">-->
                       
               	<a class="fancybox" href="<?php echo 'data:image/jpeg;base64,' . base64_encode( $value['image'] );?>" data-fancybox-group="gallery" ><img src="<?php echo 'data:image/jpeg;base64,' . base64_encode($value['image'] );?>"/></a>
                        	<style>
                        	img{
 					   height: 60px;
    				   margin-top: 0;
                       width: 150px;
                       }</style>
                        </td>
                        <td><?php echo $value['img_create_date'];?></td>
                          <td>
      <a href="#" class="change-status" data-id="<?php echo $value['img_id']; ?>" data-status="<?php echo $value['img_status']; ?>" title="<?php echo ($value['img_status'] == 0) ? 'Deactivate':'Activate';?>">
      <i class="status-icon fa <?php echo ($value['img_status'] == 0) ? 'fa-ban':'fa-check-square-o';?>"></i>
      </a>
						&nbsp;&nbsp;&nbsp;
                          <a href="#" data-id="<?php echo $value['img_id']; ?>" class="delete" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                           </td>
                         
                      	<!--<td>                      	
                      	<a href="#" class="change-status1" data-id="<?php echo $value['img_id']; ?>" data-status="<?php echo $value['img_status']; ?>" title="<?php echo ($value['img_status'] == 1) ? 'checked':'unchechked';?>">
                           
                        <input type="checkbox" name="box" id="ckb"  value="<?php echo ($value['img_status'] == 1) ? 'fa-ban':'fa-check-square-o';?>"<?php  echo $img;?> onClick="return chkcontrol(<?php echo $i; ?>);" >  

						</a>
                      	
                      	
                      	</td>-->
                      
                      
                     
                      
                      
                      </tr>
                      
<?php //$i++; 
}?>
                    </tbody>
                                      </table>
                                      </div>
                                     </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
                      </div><!-- /.row -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      
      
     <?php
      
      include"footer.php";
      ?>
    </div><!-- ./wrapper -->
    	<script>
	/*Activate deactivate through image */
	$(function(){
		$("#example1").on('click','.change-status',function(){
			 var status_link = this;
            var id = $(this).data('id');
            var status = +!$(this).data('status');
           // alert(id);
            var changeStatus = (status) ? 'Activate':'Deactivate';
            var msg = 'Image';
           // msg += (status) ? ' activated':' deactivated';
            msg += (status) ? ' activated':' Deactivate';
            msg += ' successfully!';
			//alert(id+'-'+status);
			$.ajax({
                    type: "POST",
                    url: "change-status.php",
                    data: { 'id': id, 'status': status },
                    success: function(data) {
						//alert(data);
                            //called when successful
                            if(data){
                                //alert('email already registered.');
                                $(status_link).children('i').toggleClass("fa-ban fa-check-square-o");
                                $(status_link).data('status',status);
                                $(status_link).attr('title',changeStatus);
                                bootbox.alert(msg);
                                //BootstrapDialog.alert('success!');
                                //return false;
                            }
                            return true;
                    },
                    error: function(e) {
                            //called when there is an error
                            console.log(e.message);
                            return false;
                    }
                });
		});
	});
	</script>
	
<script type="text/javascript">
$(document).ready(function() {
$(".delete").click(function(){
var element = $(this);
var del_id = element.attr("data-id");

var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "remove.php",
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
	
	
	<script>
	//Remove Image through Ajax 
	/*$(function(){
		
		$("#example1").on('click','.remove-img',function(){
		var id = $(this).data('id');
			bootbox.confirm({ 
				size: 'small',
				message: "Are you sure?", 
				callback: function(result){
					if(result){
						$.ajax({
							type: "POST",
							url: "remove.php",
							data: { 'id': id},
							success: function(data) {
									if(data){
										$('#'+id).hide();
										 bootbox.alert('Image Removed successfully!');
										//BootstrapDialog.alert('success!');
									   //return false;
										
									}
									return true;
									
							},
							error: function(e) {
									//called when there is an error
									console.log(e.message);
									return false;
							}
						});
					}
				}
			});
			return false;
            
			
		});
	});
	*/
	</script>

	<!--<script type="text/javascript">
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
	</script>-->
	
	<!-- check box script -->
	<!-- <script type="text/javascript">
function chkcontrol(j) {
    var total=0;
    for(var i=0; i < document.form.ckb.length; i++){
        if(document.form.ckb[i].checked){
        	
            total =total +1;
            
        }
        
    }
    if(total > 4){
           alert("You Can Select only four!")
            document.form.ckb[j].checked = false ;
            return false;
        }
        if(total <= 4){alert(total);
        	
        	requerstsend(); return false;
        	
        }
}
</script>-->
	
	
	<script>
	/*check box checked and unchecked */
	
		/*function requerstsend(){alert("kavi");
		$("#example1").on('click','.change-status1',function(){alert("ram");
			 var status_link = this;
			//alert(status_link);
            var id = $(this).data('id');
            
            var status = +!$(this).data('status');
          //alert(status);
            var changeStatus = (status) ? 'unchecked':'checked';
            var msg = 'checkbox';
           //msg += (status) ? ' activated':' deactivated';
           msg += (status) ? ' cheked':' unchecked';
            msg += ' successfully!';
			//alert(id+'-'+status);
			$.ajax({
                    type: "POST",
                    url: "check_box_change.php",
                    data: { 'id': id, 'status': status },
                    success: function(data) {
						//alert(data);
                            //called when successful
                            if(data){
                                //alert('email already registered.');
                                $(status_link).children('i').toggleClass("fa-ban fa-check-square-o");
                                $(status_link).data('status',status);
                                $(status_link).attr('title',changeStatus);
                                bootbox.alert(msg);
                                //BootstrapDialog.alert('success!');
                                //return false;
                                //location.reload();
                            }
                            return true;
                    },
                    error: function(e) {
                            //called when there is an error
                            console.log(e.message);
                            return false;
                    }
                });
		});
		
	}*/
	
	</script>

  </body>
</html>
