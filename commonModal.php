<?php 
include_once 'include/function.inc.php';
$action=$_REQUEST['action'];

switch($action)
{    
    case 'reasetPass':
     $parID=trim($_POST['pub_id']); $parEmail=trim($_POST['pemail']);
     $query = "SELECT publisherID from ott_publisher.publisher where acess_level='p' and par_id='".$parID."' and email='".$parEmail."'";
     $row= db_select($query);
     $publisherID=$row[0]['publisherID'];
?>	   
<style>
.col-md-4{
        min-height: 44px;
}
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Password Reset for <strong><?php echo $parEmail; ?></strong> (<?php echo  $publisherID; ?>)   </h4>
</div>
<div class="modal-body" >
   <div id="error"></div>  
  <div class="row" style="margin-top: 10px;">
      <form class="form-horizontal" role="form" action="javascript:" method="post" onsubmit="return saveR('save_resetPass','<?php echo $parID; ?>','<?php echo $parEmail; ?>')" id="resetPassForm" style="border: 0px solid red;">
      <div class="col-xs-1"></div>
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-3">Email Address:</label>
               <div class="col-xs-6">
                   <input type="email" class="form-control" id="inputEmail" placeholder="Email" readonly value="<?php echo $parEmail; ?>" required>
            </div>
        </div>
         
     <div class="col-xs-1"></div>
        <div class="form-group">
            <label for="text" class="control-label col-xs-3">New Password:</label>
             <div class="col-xs-6">
                 <input type="password" name="newpassword" id="newpassword" class="form-control"  placeholder="New Password" required>
             </div>
        </div>
         <div class="col-xs-1"></div>
           <div class="form-group">
            <label for="text" class="control-label col-xs-3">Confirm Password:</label>
              <div class="col-xs-6">
                  <input type="password" name="confirmPassword"  id="confirmPassword"  class="form-control"  placeholder="Confirm Password" required>
              </div>
        </div>
       
         <div class="col-xs-1"></div>
            <div class="form-group">
            <div class="col-xs-offset-2 col-xs-6">
                <button type="submit"  name="reset_password" id="reset_password"  class="btn btn-primary btn-primary">Save</button>
                 <span id="saving_loader"> </span>
            </div>
        </div>

    </form>
  </div>
</div>
<script type="text/javascript">  
function saveR(act,par_id,pemail)
{
   
   $("#error").html('');
   var newpassword=$("#newpassword").val();
   var confirmPassword=$("#confirmPassword").val();
   if(newpassword!=confirmPassword)  
   {
     var msg='<div class="alert alert-danger alert-dismissible fade in">';
                msg+='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                msg+='<strong>Warning :</strong>new password and confirm password do not match.';
     $("#error").html(msg); 
     return false;
   }    
        
   $("#saving_loader").fadeIn(400).html('Saving... <img src="img/image_process.gif" />');
   $('#reset_password').attr('disabled',true);
    $.ajax({
      method : 'POST',
      url : 'common_save.php',
      data : $('#resetPassForm').serialize() +"&action="+act+"&par_id="+par_id+"&pemail="+pemail,
      success: function(jsonResult){
            if(jsonResult==1) 
            {
                $('#myModal_reset_password').modal('show');
                $("#saving_loader").hide(); 
                $('#reset_password').attr('disabled',false);
                var msg='<div class="alert alert-success alert-dismissible fade in">';
                msg+='<strong>success :</strong> publisher password reset successfully .'
                msg+='</div>';
                $("#error").html(msg);
                return false;
            }    
            if(jsonResult==2) 
            {
                $('#myModal_reset_password').modal('show');
                $("#saving_loader").hide(); 
                $('#reset_password').attr('disabled',false);
                var msg='<div class="alert alert-danger alert-dismissible fade in">';
                msg+='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'
                msg+='<strong>Warning :</strong> Not updated ,somethig wrong. please try again!.'
                msg+='</div>';
                $("#error").html(msg);
                return false;
            }  
             
        }
      });  
}   
    
    
$('input[type=text]').blur(function(){ 
           $(this).val($.trim($(this).val().replace(/\t+/g,' ')));
        });
</script>    
<?php
break;
    case "viewUsers":
     $parID=trim($_POST['pub_id']); $partnerid=trim($_POST['partnerid']); $publisherUniqueID=trim($_POST['publisherUniqueID']);
     $query = "SELECT par_id,name,email,pstatus,acess_level from ott_publisher.publisher where acess_level!='p' and publisherID='".$publisherUniqueID."' and partner_id='".$partnerid."' ";
     $row= db_select($query);
     $totalMember= db_totalRow($query);
    ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">All User List Reset for - <?php echo  $publisherUniqueID; ?>   </h4>
</div>
<div class="modal-body" >
 <div id="error"></div>  
    <div class="box-body">
            <p>Total Members: <?php echo $totalMember; ?>
                <table class="table table-bordered">
                    <tr>
                      <th>id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Access Level</th>
                      <th>Status</th>
                    </tr>
                    <?php
                    foreach($row as $fetch)
                    {    
                        $par_id=$fetch['par_id'];$name=$fetch['name'];$email=$fetch['email'];
                        $acess_level=$fetch['acess_level'];$pstatus=$fetch['pstatus'];
                        $status=$pstatus==1? "<span class='label label-success'>active</span>": "<span class='label label-danger'>inactive</span>";
                    if($acess_level=='u'){ $level="<span class='label label-warning'>User</span> "; } 
                    if($acess_level=='c'){ $level="<span class='label label-warning'>Content Partner</span> "; } 
                    ?>
                     <tr>
                      <td><?php echo $par_id; ?></td>
                      <td><?php echo $name; ?></td>
                     <td><?php echo $email; ?></td>
                     <td><?php echo $level; ?></td>
                     <td><?php echo $status; ?></td>
                    </tr>
                   <?php }?>
                  </table>
   </div>
  
</div>
        
<?php 
    break;    
}
?>
