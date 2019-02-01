<?php
include_once 'auth.php';  
include_once '../include/connect_db.php';
$id=$_REQUEST['id'];
$query1 = "SELECT * FROM `dashbord_user` where did='$id' ";
$r= $mysqli->query($query1);
while($value=mysqli_fetch_array($r))
{
    $did=$value['did'];   $username=$value['dname']; $demail=$value['demail']; $gender=$value['dgender']; $date=$value['added_date'];	
}
 

?>


<form class="form-horizontal" role="form" action="#" method="post" id="confirm">
<div class="form-group">
<label class="control-label col-sm-3">Name:</label>
<div class="col-sm-7">
<input type="text" class="form-control" required name="dname" value="<?php  echo $username;  ?>" placeholder="Name">
 </div>
 </div>
 <div class="form-group">
<label class="control-label col-sm-3">Email:</label>
<div class="col-sm-7">
<input type="text" class="form-control" required name="demail" value="<?php  echo $demail;  ?>" placeholder="Email">
 </div>
 </div>
 <div class="form-group">
<label class="control-label col-sm-3">Gender:</label>
<div class="col-sm-7">
<input type="text" class="form-control" required name="dgender" value="<?php  echo $gender;  ?>" placeholder="Gender">
 </div>
 </div> 

<div class="form-group">
<label class="control-label col-sm-3"></label>
<div class="col-sm-8">
<input type="hidden" class="form-control" required name="did" value="<?php  echo $did;  ?>" placeholder="image url">
 </div>
 </div>
									    
<div class="modal-footer">
<div class="col-sm-offset-2 col-sm-5">
<button type="submit" name="save1" class="btn btn-primary" >Update</button>
</div>
</div>

</form>
												          
							