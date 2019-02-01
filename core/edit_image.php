<?php
include_once 'auth.php'; 
include_once 'function.inc.php'; 

include_once '../include/connect_db.php';
//if(isset($_GET['id']))
	
  $id=$_REQUEST['id'];
 
 $query1="select img_url,img_id from slider_image_detail where img_id='$id'";
$r= $mysqli->query($query1);
while($row=mysqli_fetch_array($r))
{
$url1=$row['img_url'];	
$id1=$row['img_id'];	
/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Edit image url (".$url1.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
 
}
 

 
 
 

?>


<form class="form-horizontal" role="form" action="#" method="post" id="confirm">
<div class="form-group">
<label class="control-label col-sm-3">Image Url:</label>
<div class="col-sm-10">
<!--<input type="" class="form-control" required name="iurl" value="<?php  echo $url1;  ?>" placeholder="image url">-->
<textarea class="form-control hresize" id="encJs2" name="iurl"><?php  echo $url1;  ?></textarea>  

 </div>
 </div>


<div class="form-group">
<label class="control-label col-sm-3"></label>
<div class="col-sm-8">
<input type="hidden" class="form-control" required name="id1" value="<?php  echo $id1;  ?>" placeholder="image url">
 </div>
 </div>
									    
<div class="modal-footer">
<div class="col-sm-offset-2 col-sm-5">
<button type="submit" name="img_up" class="btn btn-primary" >Update</button>
</div>
</div>

</form>
												          
							