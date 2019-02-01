<div class="modal-body">
         <?php  $partnerid=$_REQUEST['partnerid'];?>   
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>    
                <h4 class="modal-title" id="myModalLabel">
                  <b>Add DB Credential</b>
                </h4>
            </div>
<div class="box-header" id="msg" style="border:0px solid red; text-align: center; padding-top:3px;">  </div>     
           
<br/>
<form class="form-horizontal" method="post" name="myForm">
        
    <div class="form-group" style="margin-bottom: 0px !important;">
        <label for="text" class="control-label col-xs-4">Partner ID<span style="color:red;">*</span></label>
         <div class="col-xs-5">
             <input type="text" class="form-control" id="partnerid" name="partnerid" value="<?php echo $partnerid; ?>" disabled>
            <span class="help-block has-error" id="company_name-error"></span>
            </div>
        </div>
    <div class="form-group" style="margin-bottom: 0px !important;">
        <label for="text" class="control-label col-xs-4">DB HostName:  <span style="color:red;">*</span></label>
         <div class="col-xs-5">
             <input type="text" class="form-control" name="dbhostname" id="dbhostname" value=""  placeholder="DB Host Name">
            <span class="help-block has-error" id="company_name-error"></span>
            </div>
        </div>
           
          <div class="form-group" style="margin-bottom: 0px !important;">
              <label for="text" class="control-label col-xs-4">DB UserName: <span style="color:red;">*</span></label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="dbuname" id="dbuname"  placeholder="DB User Name">
                <span class="help-block has-error" id="admin_secret-error"></span> 
            </div>
        </div>
        
        <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="dbpassword" class="control-label col-xs-4">DB Password:</label>
         <div class="col-xs-5">
         <input type="password"  class="form-control" id="dbpassword" name="dbpassword"   placeholder="DB Password">
             <span class="help-block has-error" id="inputPassword-error"></span>
         </div>
        </div>
       <div class="form-group" style="margin-bottom: 0px !important;">
            <label for="dbname" class="control-label col-xs-4">Database Name:  <span style="color:red;">*</span></label>
            <div class="col-xs-5">
                <input type="text" class="form-control" id="dbname" name="dbname"  placeholder="database name">
                 <span class="help-block has-error" id="inputEmail-error"></span>
            </div>
        </div>
        <div class="form-group" style="margin-bottom: 0px !important;">
            <div class="col-xs-offset-4 col-xs-6">
                <button type="button"  class="btn btn-primary"  onclick="saveCredentialDB('createDB');" >Save</button>
            </div>
        </div>
    </form>       
	    
 </div>
<script type="text/javascript">
function saveCredentialDB(act)
{      var dbhostname2="blank";
      var partnerid=document.getElementById('partnerid').value;
      var dbhostname1=document.forms["myForm"]["dbhostname"].value;
       //var dbhostname2=document.myForm.dbhostname.value;
        var dbhostname3=document.getElementById('dbhostname').value;
       
      var dbhostname4=$("#dbhostname").val();
      var dbuname=$("#dbuname").val();
      var dbpassword=$("#dbpassword").val();
      var dbname=$("#dbname").val();
      console.log("dbhostname1="+dbhostname1, " dbhostname2 ",partnerid, " dbhostname3 ",dbhostname3, " dbhostname4 ",dbhostname4);
      
      
    
    /*  $.ajax({
      url: "createdb.php",
      data:'partnerid='+partnerid+'&dbhostname='+dbhostname+'&dbuname='+dbuname+'&dbpassword='+dbpassword+'&dbname='+dbname+'&act='+act,
      type: "POST",
      success:function(res){
      if(res==1)
               {   
                  //window.location.href="puserlist.php?msg=RemovePublisher";   
               }
             },
             error:function (){}
	});  */
}
</script>
