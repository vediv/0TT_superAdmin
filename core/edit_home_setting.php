<?php
include_once 'auth.php';  
include_once '../include/connect_db.php';
//if(isset($_GET['id']))
	
  $id=$_REQUEST['id'];
 
$query1="select tags_id,title_tag_name,search_tag from home_title_tag where tags_id='$id'";
$r= $mysqli->query($query1);
$query2=mysqli_fetch_array($r);

?>
    
      <!-- Modal content-->
   <html>
   
  <body>
  	 
   <div class="tab-pane active" id="tab1" >
  	 
  <form class="form-horizontal" role="form" action="#" method="post" ><br/>
									<div class="form-group">
									<label class="control-label col-md-10">Tag Name:</label>
									<div class="col-md-10">
									<input type="text" style="width:450px" class="form-control" value="<?php echo $query2['title_tag_name']; ?>"  name="ttag">
								</div>
							</div>
								<br/>
									   <div class="form-group"> <br/>
									      <label class="control-label col-md-10" >Search Tag:</label>
									      <div class="col-md-10"> 
									        <input type="text" style="width:450px" class="form-control" name="stag" value="<?php echo $query2['search_tag']; ?>" required aria-required pattern="^[a-zA-Z\d@#$_-]*$" placeholder="Enter Search Tag Name" title="Space Not Allowed">
									      </div>	
									    </div>
								
									   
									   
				          <input type="hidden" class="form-control" name="id" value="<?php echo $query2['tags_id']; ?>">
									   <div class="modal-footer" style="margin-top:25px;">
									    <div class="col-sm-offset-2 col-sm-10" style="margin-left: -140px;">
									    <button type="submit" name="sub" class="btn btn-primary" id="edit">Update</button>
									   </div>
									  </div>

						  </form>
							 
   </div>
   
  
</body>
</html>
  
<!--<form action ="#"  method="post"' >
	<strong>Title Name::</strong><br/>
<input type="text" name="ttag" value="<?php echo $query2['title_tag_name']; ?>"  /><br/>
    <strong>Search Tag:</strong><br/> 
<input type="text" name="stag" value="<?php echo $query2['search_tag']; ?>" /><br/>
    <<strong>Tag Status:</strong><br/>
<input type="text" name="status" value="<?php echo $query2['tag_status']; ?>" style='width:300px; height:30px;'/>
    <strong>Priority:</strong><br/>
<input type="text" name="priority" value="<?php echo $query2['priority']; ?>" style='width:300px; height:30px;'/><br/>--
    <strong>Date:</strong><br/> 
<input type="text" name="date" value="<?php echo $query2['create_date']; ?>" /><br/>
<input type="hidden" name="id" value="<?php echo $query2['tags_id']; ?>" />
 <div class="box-footer">
                    <button type="submit" name="sub" value="Submit"  class="btn btn-primary" >Save</button>
                  </div>
        
</form>
</table>-->


