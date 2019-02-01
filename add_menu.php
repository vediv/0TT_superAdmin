<?php 
include_once 'authm.php';
include_once 'pagenamem.php';
$parIDid =(isset($_REQUEST['next']))? $_REQUEST['next']:'';
$email =(isset($_REQUEST['email']))? $_REQUEST['email']:'';
$error_msg =(isset($_REQUEST['emsg']))? $_REQUEST['emsg']:'';
$emessage=''; $alert="";
if($error_msg==1)
{ $emessage="Unable to connect to Database please try after sometime"; $alert="alert-danger";} 
if($error_msg==2){ $emessage="Unable to Select Database, please try after sometime"; $alert="alert-danger";}
//$parID=trim($_POST['par_id']); $parEmail=trim($_POST['pemail']);
$query ="SELECT name,dbName,dbHostName,dbUserName,dbpassword from ott_publisher.publisher where acess_level='p' and par_id='".$parIDid."' and email='".$email."'";
$fetch= db_select($query);
//print_r($fetch);
$dbName=$fetch[0]['dbName'];  $dbHostName=$fetch[0]['dbHostName']; $name=$fetch[0]['name'];
$dbUserName=$fetch[0]['dbUserName']; $dbpassword=$fetch[0]['dbpassword']; 
$clientConnect =  mysqli_connect($dbHostName, $dbUserName, $dbpassword, $dbName);
if(!$clientConnect)    
header ("location:add_menu.php?next=$parIDid&email=$email&emsg=1"); //die("Unable to connect to Database please try some time"); 
if (!mysqli_select_db($clientConnect,$dbName))     
header ("location:add_menu.php?next=$parIDid&email=$email&emsg=2");  

$sql = "SELECT mid FROM $dbName.menus";
$result=mysqli_query($clientConnect,$sql);
$client_menu_id=array();
while($value=mysqli_fetch_array($result))
{
    $client_menu_id[]=$value['mid'];
}
$sql = "SELECT other_permission FROM $dbName.publisher where par_id='$parIDid' ";
$result=mysqli_query($clientConnect,$sql);
$value=mysqli_fetch_array($result);
$other_permission=$value['other_permission'];
$otherPermission=explode(",",$other_permission);
?>
<!DOCTYPE html>
<html>
  <head>
   <meta charset="UTF-8">
 <title><?php echo PROJECT_TITLE." | Add Menu ";?></title>
<style type="text/css">
fieldset.scheduler-border {    border: 1px groove #ddd !important;    padding: 0 1.4em 1.4em 1.4em !important;    margin: 0 0 1.5em 0 !important;
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
           <h1>Add Menu
               <a href="menuPermission.php?next=<?php echo $parIDid; ?>&email=<?php echo $email; ?>"  title="Menu Permissions"><span class="glyphicon glyphicon-edit" style="font-size:16px; color:#41495c !important"></span></a>    	
          </h1>
      <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Add Menu</li>
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
<?php //print_r($client_menu_id); ?>    
<div class="row" style="margin:10px 90px 0 2px;">
<form class="form-inline" role="form" action="common_save.php?action=add_menu" method="POST">
<div class="row">
<?php
$get_main_menu_query="SELECT mid,mname,menu_url,mparentid,multilevel,child_id,icon_class FROM ott_publisher.menus where  mparentid='0' and multilevel!='1' and mstatus='1'";
//$results = mysqli_query($clientConnect,$get_main_menu_query);
$results=  db_select($get_main_menu_query);
foreach ($results as $get_main_menu) {  
     $munu_id=$get_main_menu['mid']; $menu_name=$get_main_menu['mname'];
     if(in_array($munu_id,$client_menu_id)){ $munu_id; $cheked_parent='checked';  $disable_parent='disabled';  }
     else{  $cheked_parent=''; $disable_parent=''; }
     
?>
<div class="col-sm-3">
<label class="checkbox-inline" style="color: #3290D4;">
<input type="checkbox" name="menus[]"  <?php echo $cheked_parent;?> <?php echo $disable_parent; ?> value="<?php echo $munu_id;  ?>"><?php echo ucwords($menu_name); ?>
</label>
</div>
    
<?php
}
?>
</div>
<div class="row">
<?php
$get_main_menu_query = "SELECT mid,mname,menu_url,mparentid,multilevel,child_id,icon_class FROM ott_publisher.menus where  mparentid='0' and multilevel='1' and mstatus='1'";
//$results = mysqli_query($clientConnect,$get_main_menu_query) ;
$results=  db_select($get_main_menu_query);
$boxCount=1;
foreach ($results as $get_main_menu) {
    $munuid=$get_main_menu['mid']; $menuname=$get_main_menu['mname'];
    if(in_array($munuid,$client_menu_id)){ $cheked_parent1='checked';  $disable_parent1='disabled';  }
     else{  $cheked_parent1=''; $disable_parent1=''; }
?>
<div class="col-sm-4">
    <fieldset class="scheduler-border" style="min-height: 180px;">
    <legend class="scheduler-border">
        <input type="checkbox" name="menus[]" id="<?php echo $munuid;  ?>" <?php echo $cheked_parent1;?> <?php echo $disable_parent1; ?>  class="parent_main"  value="<?php echo $munuid;  ?>">
        <?php  echo ucwords($menuname) ?></legend> 
    <div class="control-group"> 
        <table style="width: 100%;">
            <?php
            $sub="SELECT mid,mname,menu_url,mparentid,multilevel FROM ott_publisher.menus where  mparentid='".$munuid."' and mstatus='1' ";
            $res=  db_select($sub);
            foreach ($res as $get_submain_menu) {
            $submunuid=$get_submain_menu['mid']; $submenuname=$get_submain_menu['mname'];
            if(in_array($submunuid,$client_menu_id)){ $cheked_parent2='checked';  $disable_parent2='disabled';  }
            else{  $cheked_parent2=''; $disable_parent2=''; }
            ?>
            <tr>
                <td> <input type="checkbox" name="menus[]" id="<?php echo $submunuid;  ?>" <?php echo $cheked_parent2;?> <?php echo $disable_parent2; ?> class="parent-<?php echo $munuid;?>" value="<?php echo $submunuid;  ?>">  </td> <td> <?php  echo ucwords($submenuname); ?></td>
            </tr>
            <?php } ?>
            
        </table>
    
    </div>
</fieldset>

</div>
<?php $boxCount++;} ?>
</div>
  
    
<input type="hidden" name="par_id" value="<?php echo $parIDid; ?>">  <input type="hidden" name="pemail" value="<?php echo $email; ?>">
<div class="modal-footer">
    <div class="col-sm-offset-2 col-sm-5">
        <button type="submit"  class="btn btn-primary btn-primary1" id="submit">Save</button>
    </div>
</div>    
</form>
</div>
 </div>             
                
              </div>
 </div><!-- /.box --> 
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
<?php  include_once"footer.php";  ?>
       </div>
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

/* save button enable and disabled on checkbox */
$('#submit').prop("disabled", true);
$('input:checkbox').click(function() {
        if ($(this).is(':checked')) {
			$('#submit').prop("disabled", false);
        } else {
		if ($('.chk').filter(':checked').length < 1){
			$('#submit').attr('disabled',true);}
		}
});
</script>   
</body>
</html>
