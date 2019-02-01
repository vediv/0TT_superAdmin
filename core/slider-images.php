<?php include_once 'auth.php';
include_once 'function.inc.php';
 $message='';
include_once '../include/connect_db.php';
$commanmsg = isset($_GET['val']) ? $_GET['val'] : '';
if($commanmsg=="Deactive")
{ $msgcall="Image Deactive Successfully";  }
if($commanmsg=="Active")
{ $msgcall="Image Active Successfully";  }
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
// this following code for active and deactive
 $imgid = isset($_GET['imgid']) ? $_GET['imgid'] : '';
 $imgStatus= isset($_GET['imgstatus']) ? $_GET['imgstatus'] : '';
 $imgname= isset($_GET['iname']) ? $_GET['iname'] : '';
  $imgStatusU= ($imgStatus==0) ? 1 : 0;
 
$upactive="update slider_image_detail set img_status='$imgStatusU' where img_id=$imgid";
 $ractive=$mysqli->query($upactive);
 if($ractive){
  $sucess_msg= ($imgStatus==0) ? "Active" : "Deactive";
  ?>
 <?php header("location:slider-images.php?val=$sucess_msg");
 
  /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Image $sucess_msg(".$imgname.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
 
 }
 ?>
 
 
  <?php
 
 // $img_type=array('image/gif','image/jpeg','image/png','image/tif');
  
if (isset($_FILES["userfile"]["name"])){
$path = "img/";
$status=0;



$err = $_FILES["userfile"]["error"];
	if($err > 0){
		echo "Error in Upload : ".$err;
	}else{
		
	    $img_url=$_POST['url'];
		$nameOfFile = $_FILES["userfile"]["name"];			
		$typeOfFile = $_FILES["userfile"]["type"];
		$sizeOfFile = $_FILES["userfile"]["size"];
		$locationOfFile=$_FILES["userfile"]["tmp_name"];
		list($width, $height, $type, $attr) = getimagesize($locationOfFile);
		
		 $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
		
		//if($width >2180){
		if (($_FILES['userfile']['type']=="image/gif") || ($_FILES['userfile']['type']=="image/tif") ||($_FILES['userfile']['type']=="image/jpg") ||($_FILES['userfile']['type']=="image/jpeg") || ($_FILES['userfile']['type']=="image/png")) {
		//if(is_array($img_type)){	
		move_uploaded_file($locationOfFile,"img/".$nameOfFile);
		//$url = $protocol.'://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI']);
		//$ptah_url= $url.'/img/'.$nameOfFile;		
 //$sql="insert into home_title_tag (title_tag_name,search_tag,tag_status,priority,create_date) Select '$ttag','$stag','0',ifnull(max(priority),0)+1,NOW() from home_title_tag";		
    if($width > 2116 AND $height < 530) {
    $query = "INSERT INTO slider_image_detail(img_name,img_url,image,img_status,priority,img_create_date) Select '$nameOfFile',' $img_url','$imgData','$status',ifnull(max(priority),0)+1,NOW() from slider_image_detail";
		$r=$mysqli->query($query);
	
	}else{$message="Image dimesion invalid";}
	
}
else{
 $message="Image Type Invalid";
 
}



    }
if($r)
{
	header("Location:slider-images.php?val=sucess");
	 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Upload image(".$nameOfFile.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
}

else 
{
	 header("slider-images.php?val=error"); 
}    
	


}

?>

      <!-- Left side column. contains the logo and sidebar -->
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Image Slider  <!--<ul class="list-unstyled legal-tabs" style="text-align:center;">-->
       <a href="#LegalModal" data-target=".bs-example-modal-lg" data-toggle="modal" title="Add New"><small><span class="glyphicon glyphicon-plus" style="color:#3290D4"></span></small></a></h1> 
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Image Slider</li>
          </ol>          
            <span style="color: red;"><?php  echo  $message;?>   </span>
   
        </section>
       
        <section class="content">
           <div class="row">
          <div class="col-xs-12">
          <div class="box">
        <div class="box-header">
        
          <?php     
     if(isset($_REQUEST['savechanges']))
     
	{
	 	$pidd=$_REQUEST['idd']; $prio=$_REQUEST['pr'];
        $i=0;
        foreach($pidd as $ptid)
		{
			    $ptid; $pri=$prio[$i];		
			    	
			    //echo $ptid; echo "----"; echo $pri=$prio[$i];			
		 $s="update slider_image_detail set priority='$pri' where img_id='$ptid'";
         $r=$mysqli->query($s);
		 
		 $i++;
		}  
		header("Location:slider-images.php?val=update");      
        
       // $sql="insert into home_title_tag (title_tag_name,search_tag,tag_status,priority,create_date) Select '$ttag','$stag','0',ifnull(max(priority),0)+1,NOW() from home_title_tag";
        //$r=$mysqli->query($sql);
	 
	  /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Image priority change(".$ptid.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
} ?>
            
        
        
     <?php
	
if(isset($_POST['img_up'] ))
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
                  <b>Image Upload</b>
                </h4>
            </div>
                  
             <br/>     
        <form action="" method="post" enctype="multipart/form-data" id="myForm" name="myForm"  >
             
                  <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <input type="file" id="input" name="userfile"   required />                      
                     <!-- <img id="output"/>-->
                      (Image dimenson :2216px * 500px - 2500px * 530px)
                   </div>                  
            
                  <div class="form-group">
                      <label>Image Url</label>
                      <textarea class="form-control hresize" id="encJs2" name="url" cols="num" rows="num"></textarea>  
                    </div>
                  
               <!--box-body 
             
               
                <div class="btn-group">
                  <button  type="button" name="submit" value="Submit" id="myFormSubmit" class="btn btn-primary" >Submit</button>-->
                </form>
        <div class="modal-footer">
									          
		<div class="col-sm-offset-2 col-sm-5">
        <button  type="button" name="submit" value="Submit" id="myFormSubmit" class="btn btn-primary" >Submit</button>
		</div>
		</div>
               
               
                  <!--<button type="button" name="submit" value="Submit" id="myFormSubmit" class="btn btn-primary">submit</button>-->
                
			
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
                  <h3 class="box-title">List of Uploaded Image</h3>
                 
                </div><!-- /.box-header -->
                <div class="box-body">
                <form action="#" id="form" name="form">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Images</th>
                       <!-- <th>Image Url</th>-->
                         <th>Date</th>
                          <th>Priority</th>
                          <th>Status</th>
                          <th>Action</th>
                       
                      </tr>                    </thead>
                    <tbody>
                    	
                  <?php $query1 = "Select *from slider_image_detail order by priority";
               $result= $mysqli->query($query1); 
			    $num=mysqli_num_rows($result);
			    $i=1;
            
					while($value=mysqli_fetch_array($result))
					{ 
					  $id=$value['img_id'];
					  $img_name=$value['img_name'];
					  $img_status=$value['img_status'];
					  $priority=$value['priority'];	
					  if( $img_status==1)
					  {
					  	 $img_status1='Active';
					  }else{ $img_status1='Deactive';}
						?>
					<tr id="<?php echo $value['img_id']; ?>">
                        <td><!--<img src ="<?php echo $value['img_url'];?>">-->
                       
               	<a class="fancybox" href="<?php echo 'data:image/jpeg;base64,' . base64_encode( $value['image'] );?>" data-fancybox-group="gallery" ><img style=" height:60px; width: 150px;width: 150px;" src="<?php echo 'data:image/jpeg;base64,'. base64_encode( $value['image'] );?>" alt=""/></a>
                        	<!--<style>
                       img{
 					   height: 60px;
    				   margin-top: 0;
                       width: 150px;
                       }</style>-->
                        </td>
                        <!--<td><?php echo $value['img_url'];?></td>-->
                        <td><?php echo $value['img_create_date'];?></td>
      
                         <td>
                          	<input type="hidden" name="idd[]" value="<?php echo $id; ?>" />
                          	<select class="form-control ranking" name="pr[]">
                          	
    <?php  for($j=1;$j<=$num;$j++){
    	        
		   ?>       	
    <option value="<?php echo $j;?>" <?php if ($priority==$j){ echo 'selected'; }?>><?php echo $j; ?></option>
   
    <?php 
	
	}?>		
    
    
    </select>
    
    
    </td>
    <td><?php echo $img_status1; ?></td>
                          <td>              	
                      	
                          	
                          	
                          	
      <a href="slider-images.php?imgid=<?php echo $id;?>&imgstatus=<?php echo $img_status; ?>&iname=<?php echo $img_name;?>" class="change-status" title="<?php echo ($img_status == 1) ? 'Active':'Deactive';?>">
      <i class="status-icon fa <?php echo ($img_status==1) ? 'fa-check-square-o':'fa-ban';?>"></i>   
      </a>	&nbsp;&nbsp;&nbsp;
      
    <!--<a href="#myModal" class="addnew" id="<?php echo $id; ?> title="Edit" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-edit " ></span></small></a> -->   	
            
              
              <a href="#myModal"  id="<?php echo $id; ?>"  data-target="#myModal" data-toggle="modal" title="Edit" class="addnew"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;
 
              <!--<a href="#" data-id="<?php echo $value['img_id']; ?>" class="delete" title="Delete" ><input type="button" name="btn1" id="btn2" value="delete" /></a>-->
            <a href="#" data-id="<?php echo $value['img_id']; ?>" data-status="<?php echo $img_status; ?>" class="delete" title="Delete" ><span class="glyphicon glyphicon-trash"></span></a>
               </td> 
                      	
           </tr>             
                      
                     
                      
                      
                    
                      
<?php //$i++; 
}?>
                    </tbody>
                                      </table>
        <p align="center"> <button type="submit" name="savechanges" class="btn btn-primary">Save Changes</button></p>
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
                  <b>Edit Imagr Url</b>
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
   // alert("hi" + info);

 $.ajax({
   type: "POST",
   url: "edit_image.php",
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
   url: "remove.php",
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
       	 if(name=='')
       	 {
       	 	alert("Field is blank");
       	 	return false;
       	 }                
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
<script>
	var _URL = window.URL;
$("#input").change(function (e) {
	
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onload = function () {
           // alert("Width:" + this.width + "   Height: " + this.height);
           var width=this.width;
           var height=this.height;
           if(width < 2000 )
           { 
           	alert("Image Type JPG,PNG,GIF,TIF and  dimenson 2216px * 500px - 2500px * 530px ");
           //document.getElementById("myFormSubmit").disabled = true;
           	 $('input').val("");
           	 
           	 return false;
           
           }
           if(width > 2000 && width < 2500)
           {
           	myFormSubmit.disabled = false;
           }
            if(height > 530 )
           { 
           alert("Image Type JPG,PNG,GIF,TIF and  dimenson 2216px * 500px - 2500px * 530px ");
           	document.getElementById("myFormSubmit").disabled = true;
           	  	 $('input').val("");
           	  	 return false;
           }
        };
        img.src = _URL.createObjectURL(file);
    }
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
 window.location.href='slider-images.php';
});
</script>

  </body>
</html>
