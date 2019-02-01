<?php
include_once 'auth.php';  
include_once '../include/connect_db.php';
//if(isset($_GET['id']))
$id=$_REQUEST['id'];
 
$query1="select uid,uname,uemail,dob,ugender,ulocation from user_registration where uid='$id'";
$r= $mysqli->query($query1);
$query2=mysqli_fetch_array($r);

?>

<html>
   
  <body>
  	 
<div class="tab-pane active" id="tab1" >
  	 <form class="form-horizontal" role="form" action="#" method="post" ><br/>
 
									    
						
						
									<div class="form-group">
									<label class="control-label col-md-1">Name:</label><br/><br/>
									  <div class="col-md-10">
										<input type="text" style="width:450px" class="form-control" value="<?php echo $query2['uname']; ?>"  name="name">
										</div>
										</div>
						
									   <div class="form-group">  
									      <label class="control-label col-md-1" >Email:</label><br/><br/>
									       <div class="col-md-10">
									        <input type="text" style="width:450px" class="form-control" name="email" value="<?php echo $query2['uemail']; ?>" required>
									      </div>	
									    </div>
								

									   <div class="form-group"> 
									      <label class="control-label col-md-1" >DOB:</label> <br/><br/>
									       <div class="col-md-10">
									        <input type="text" style="width:450px" class="form-control" name="dob" value="<?php echo $query2['dob']; ?>" required>
									      </div>	
									    </div>
				
									   <div class="form-group">
									      <label class="control-label col-md-1" >Gender:</label><br/><br/>
									      <div class="col-md-10">
									        <input type="text" style="width:450px" class="form-control" name="gender" value="<?php echo $query2['ugender']; ?>" required>
									      </div>	
									    </div>
		
							
									   <div class="form-group">  
									      <label class="control-label col-md-1" >Location:</label><br/><br/>
									      <div class="col-md-10">
									        <input type="text" style="width:450px" class="form-control" name="location" value="<?php echo $query2['ulocation']; ?>" required>
									      </div>	
									   </div>
									   
								
				          <input type="hidden" class="form-control" name="id" value="<?php echo $query2['uid']; ?>">
									  
									   <div class="modal-footer" style="margin-top:25px; ">
									           <div class="col-sm-offset-2 col-sm-5" >
									    <button type="submit" name="sub" class="btn btn-primary" id="edit">Update</button>
									   </div>
									  </div>
 
						 	  </form>
	 </div>
</body>
</html>
  