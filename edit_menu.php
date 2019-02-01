<?php 
include_once 'authm.php';
include_once 'pagenamem.php';
$parIDid =(isset($_REQUEST['next']))? $_REQUEST['next']:'';
$email =(isset($_REQUEST['email']))? $_REQUEST['email']:'';
$error_msg =(isset($_REQUEST['emsg']))? $_REQUEST['emsg']:'';
$emessage=''; $alert="";
if($error_msg==1)
{ $emessage="Unable to connect Mysql please try some time"; $alert="alert-danger";} 
if($error_msg==2){ $emessage="Unable to Select DB please try some time"; $alert="alert-danger";}
$query ="SELECT name,dbName,dbHostName,dbUserName,dbpassword from ott_publisher.publisher where acess_level='p' and par_id='".$parIDid."' and email='".$email."'";
$fetch= db_select($query);
//print_r($fetch);
$dbName=$fetch[0]['dbName'];  $dbHostName=$fetch[0]['dbHostName']; $name=$fetch[0]['name']; 
$dbUserName=$fetch[0]['dbUserName']; $dbpassword=$fetch[0]['dbpassword']; 
$clientConnect =  mysqli_connect($dbHostName, $dbUserName, $dbpassword, $dbName);
if(!$clientConnect)    
header ("location:add_menu.php?next=$parIDid&email=$email&emsg=1"); //die("Unable to connect Mysql please try some time"); 
if (!mysqli_select_db($clientConnect,$dbName))     
header ("location:add_menu.php?next=$parIDid&email=$email&emsg=2");  

$sql = "SELECT par_id,name,email,menu_permission,operation_permission,other_permission FROM $dbName.publisher where par_id='$parIDid' ";
$result=mysqli_query($clientConnect,$sql);
$value=mysqli_fetch_array($result);
$par_id=$value['par_id'];  $username=$value['name']; $demail=$value['email']; $other_permission=$value['other_permission'];
$menu_permission=$value['menu_permission']; $operation_permission=$value['operation_permission'];
$mpermission=explode(",",$menu_permission);
$om=explode(",",$operation_permission);
$otherPermission=explode(",",$other_permission);
?>
<!DOCTYPE html>
<html>
  <head>
   <meta charset="UTF-8">
 <title><?php echo PROJECT_TITLE." | Menu Permissions";?></title>
<style type="text/css">
fieldset.scheduler-border { border: 1px groove #ddd !important;    padding: 0 1.4em 1.4em 1.4em !important;    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;    box-shadow:  0px 0px 0px 0px #000;}
    legend.scheduler-border {text-align: left !important; width:auto; height:20px; padding:12px 3px 0px 3px; font-size:12px; font-weight: bold;
        border-bottom:none;        color:#3290D4;     }
         
    .btn.disabled, .btn[disabled], fieldset[disabled] .btn {     opacity: 1 !important;}
         </style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
           <!-- Left side column. contains the logo and sidebar -->
      <?php include_once 'leftmenu.php';?>
      
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1>Edit Menu Permissions
             <a href="add_menu.php?next=<?php echo $parIDid; ?>&email=<?php echo $email; ?>"  title="Add Menu Permissions"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus"></span></small></a>    	
          </h1>
      <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Edit</li>
      </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="col-xs-12">
         
          <div class="box"> 
                            <div style="text-align: center;"><b><h5><?php echo $name.'('.$dbName.')'; ?></h5></b></div> 

  <?php if($error_msg!=''){?>            
  <div class="alert <?php echo $alert; ?> alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <?php echo $emessage;  ?>
  </div>
  <?php } ?>            
          <hr/>
          
<div class="container">
<div class="row" style="margin:10px 90px 0 2px;">
<form class="form-inline" role="form" action="common_save.php?action=edit_menu" method="POST">
<div class="row">
<?php
$get_main_menu_query = "SELECT mid,mname,menu_url,mparentid,multilevel,child_id,icon_class FROM menus where mparentid='0' and multilevel!='1' and mstatus='1'";
$results=  db_select($get_main_menu_query);
foreach ($results as $get_main_menu) {  
    $munu_id=$get_main_menu['mid']; $menu_name=$get_main_menu['mname'];
if(in_array($munu_id,$mpermission)){ $chk="checked"; } else {$chk="";}

?>

<div class="col-sm-3">
    <label class="checkbox-inline" style="color: #3290D4;">
        <input type="checkbox" name="menus[]" <?php echo $chk; ?> value="<?php echo $munu_id;  ?>"><?php echo ucwords($menu_name); ?>
</label>
</div>
<?php
}
?>
</div>
<div class="row">
<?php
$get_main_menu_query = "SELECT mid,mname,menu_url,mparentid,multilevel,child_id,icon_class FROM menus where  mparentid='0' and multilevel='1' and mstatus='1'";
$results=  db_select($get_main_menu_query);$boxCount=1;
foreach ($results as $get_main_menu) {
    $munuid=$get_main_menu['mid']; $menuname=$get_main_menu['mname'];
    if(in_array($munuid,$mpermission)){ $chk1="checked"; } else {$chk1="";}
?>
<div class="col-sm-4">
    <fieldset class="scheduler-border" style="min-height: 180px;">
    <legend class="scheduler-border">
        <input type="checkbox" name="menus[]" <?php echo $chk1; ?> id="<?php echo $munuid;  ?>"  class="parent_main"  value="<?php echo $munuid;  ?>">
        <?php  echo ucwords($menuname) ?></legend> 
    <div class="control-group"> 
        <table style="width: 100%;">
            <?php
            $sub="SELECT mid,mname,menu_url,mparentid,multilevel FROM menus where  mparentid='".$munuid."' and mstatus='1' ";
            $res=  db_select($sub);
            foreach ($res as $get_submain_menu) {
            $submunuid=$get_submain_menu['mid']; $submenuname=$get_submain_menu['mname'];
            if(in_array($submunuid,$mpermission)){ $chk2="checked"; } else {$chk2="";}

            ?>
            <tr>
                <td> <input type="checkbox" name="menus[]" <?php echo $chk2; ?> id="<?php echo $submunuid;  ?>" class="parent-<?php echo $munuid;?>" value="<?php echo $submunuid;  ?>">  </td> <td> <?php  echo ucwords($submenuname); ?></td>
            </tr>
            <?php } ?>
            
        </table>
    
    </div>
</fieldset>

</div>
<?php $boxCount++;} ?>
</div>
<p><strong>Other Permission: </strong>&nbsp; &nbsp;&nbsp;
<label class="checkbox-inline" style="color: #3290D4;">
    <?php if(in_array(5, $otherPermission)) { $opcheked1="checked"; } else {$opcheked1="";} ?>
    
    <input type="checkbox" name="other_permission[]" <?php echo $opcheked1; ?> value="5"> Plan 
</label>
    <label class="checkbox-inline" style="color: #3290D4;">
        <?php if(in_array(6, $otherPermission)) { $opcheked2="checked"; } else {$opcheked2="";} ?>
     <input type="checkbox" name="other_permission[]" <?php echo $opcheked2; ?>  value="6"> Advertisements 
</label>
</p>    
<input type="hidden" name="par_id" value="<?php echo $parIDid; ?>">  <input type="hidden" name="pemail" value="<?php echo $email; ?>">
<div class="modal-footer">
    <div class="col-sm-offset-2 col-sm-5">
        <button type="submit"  class="btn btn-primary btn-primary1" id="submit">Edit</button>
    </div>
</div>    
</form>
</div>
 </div>             
                
              </div>
 </div><!-- /.box -->  </div>
           
        
        </section><!-- /.content -->
    </div><!-- /.col -->
<?php  include_once"footer.php"; mysql_close($clientConnect);  ?>
  </div><!-- /.content-wrapper --> 
<script type="text/javascript">
$(document).ready(function() {   
$(".parent_main").change(function(){
var tt= $(this).is(':checked');
    if(tt) {
        var cls = '.parent-' + $(this).prop('id');
        $(cls).prop('checked', 'checked');   
    }
    else
    {   
        var cls = '.parent-' + $(this).prop('id');
        $(cls).prop('checked',false);   
    }    
});

$('input[class*="parent"]').change(function(){
    var cls = '.' + $(this).prop('class') + ':checked';
    var len = $(cls).length;
     //alert(len);
    var parent_id = '#' + $(this).prop('class').split('-')[1];
    // 3. Check parent if at least one child is checked
    if(len) {
        $(parent_id).prop('checked', 'checked');
    } else {
        // 2. Uncheck parent if all childs are unchecked.
        $(parent_id).prop('checked', false);
    }
});
});

/*$('#submit').prop("disabled", true);
$('input:checkbox').click(function() {
        if ($(this).is(':checked')) {
			$('#submit').prop("disabled", false);
        } else {
		if ($('.chk').filter(':checked').length < 1){
			$('#submit').attr('disabled',true);}
		}
});*/
</script>   
</body>
</html>