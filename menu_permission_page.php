<?php
include_once 'include/function.inc.php';
$parIDid =(isset($_REQUEST['par_id']))? $_REQUEST['par_id']:'';
$email =(isset($_REQUEST['pemail']))? $_REQUEST['pemail']:'';
$error_msg =(isset($_REQUEST['emsg']))? $_REQUEST['emsg']:'';
$emessage=''; $alert="";
if($error_msg==1)
{ $emessage="Unable to connect to Database please try after sometime"; $alert="alert-danger";} 
if($error_msg==2){ $emessage="Unable to Select Database please try after sometime"; $alert="alert-danger";}
$query ="SELECT name,dbName,dbHostName,dbUserName,dbpassword,publisherID from ott_publisher.publisher where acess_level='p' and par_id='".$parIDid."' and email='".$email."'";
$fetch= db_select($query);
//print_r($fetch);
$dbName=$fetch[0]['dbName'];  $dbHostName=$fetch[0]['dbHostName']; $name=$fetch[0]['name']; 
$dbUserName=$fetch[0]['dbUserName']; $dbpassword=$fetch[0]['dbpassword'];  $publisherID=$fetch[0]['publisherID'];  
$clientConnect =  mysqli_connect($dbHostName, $dbUserName, $dbpassword, $dbName);
if(!$clientConnect) {   
die("Unable to connect to Database please try after sometime");}
if (!mysqli_select_db($clientConnect,$dbName)) {    
die("Unable to connect to Database please try after sometime");  exit; }  

$munulevel=isset($_POST['munulevel'])?$_POST['munulevel']:'';
switch($munulevel)
{
    case "only_parent":
    $munuids=isset($_POST['munuids'])?$_POST['munuids']:'';
    $mstatus=isset($_POST['mstatus'])?$_POST['mstatus']:'';    
    if($mstatus==0)
    {
      $up="update $dbName.publisher set menu_permission=TRIM(BOTH ',' FROM REPLACE(CONCAT(',',menu_permission,',') , ',$munuids,', ',')) where FIND_IN_SET($munuids,menu_permission) and publisherID='$publisherID'";
    } 
    if($mstatus==1)           
    {
      $up="UPDATE $dbName.publisher SET menu_permission = CONCAT_WS(',',NULLIF(menu_permission,''),$munuids) WHERE  par_id='".$parIDid."' and email='".$email."'";
    } 
    $rr=  mysqli_query($clientConnect, $up);
    sleep(1);    
    break;    
    case "other_permission":
    $munuids=isset($_POST['munuids'])?$_POST['munuids']:'';
    $mstatus=isset($_POST['mstatus'])?$_POST['mstatus']:'';    
    if($mstatus==0)
    {
      $up="update $dbName.publisher set other_permission=TRIM(BOTH ',' FROM REPLACE(CONCAT(',',other_permission,',') , ',$munuids,', ',')) where FIND_IN_SET($munuids,other_permission) and publisherID='$publisherID'";
    } 
    if($mstatus==1)           
    {
      $up="UPDATE $dbName.publisher SET other_permission = CONCAT_WS(',',NULLIF(other_permission,''),$munuids) WHERE  par_id='".$parIDid."' and email='".$email."'";
    }
    $rr=  mysqli_query($clientConnect, $up);
    sleep(1);    
    break;
}

$sql = "SELECT par_id,name,email,menu_permission,operation_permission,other_permission FROM $dbName.publisher where par_id='$parIDid' ";
$result=mysqli_query($clientConnect,$sql);
$value=mysqli_fetch_array($result);
$par_id=$value['par_id'];  $username=$value['name']; $demail=$value['email']; $other_permission=$value['other_permission'];
$menu_permission=$value['menu_permission']; $operation_permission=$value['operation_permission'];
$mpermission=explode(",",$menu_permission);
$om=explode(",",$operation_permission);
$otherPermission=explode(",",$other_permission);
?>
<div style="text-align: center; padding: 8px 1px; margin-bottom: 1px; border-radius: 1px; " >
 <strong><?php echo $name.'('.$dbName.')'; ?></strong></div> 
<?php if($error_msg!=''){?>            
<div class="alert <?php echo $alert; ?> alert-dismissable">
<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <?php echo $emessage;  ?>
  </div>
  <?php } ?>            
<hr/>
<?php
$i=0;
$get_main_menu_query = "SELECT mid,mname,menu_url,mparentid,multilevel,child_id,icon_class FROM $dbName.menus
where mparentid='0' and multilevel!='1' and mstatus='1'";
$q_main=mysqli_query($clientConnect,$get_main_menu_query);
?>          

<div class="row" style="border:0px solid red; margin-left: 10px; margin-right: 10px;" id="menu_permission">
<div class="col-lg-9" >
 <div id="load" style="display:none;"></div>   
    <div class="panel panel-default">
        <div class="panel-heading">
            Menu Permission (<?php echo $publisherID;  ?>)
        </div>
        <div class="panel-body">
           
<!--<form class="form-inline" action="#" >-->
<div class="row">
<table  border="0" style="width:98%; height: 70px; margin-left: 5px;">
<tr>
<?php
while($get_main_menu=mysqli_fetch_array($q_main))
{  
$munu_id=$get_main_menu['mid']; $menu_name=$get_main_menu['mname'];
if(in_array($munu_id,$mpermission)){
$statusMenu=1; $d=0;  $bname1='ON'; $bname2='OFF'; $class1='btn-success active'; $class2="btn-danger"; $disable1="disabled";    $disable2="";
} 
else {
$statusMenu=0; $d=1; $bname1="ON"; $bname2='OFF'; $class2="btn-success active"; $class1="btn-danger"; 
$disable1=""; $disable2="disabled"; 
}
?>
<td><?php echo ucwords($menu_name);  ?></td>
<td>
<div class="btn-group btn-toggle"> 
<button id="<?php echo $munu_id."_on"; ?>" <?php echo $disable1; ?>  class="btn btn-xs <?php echo $class1; ?>" style=""   onclick="on_off_menu1('<?php echo $d; ?>','<?php echo $munu_id; ?>','only_parent')"><?php echo $bname1; ?></button>
<button id="<?php echo $munu_id."_off"; ?>" <?php echo $disable2; ?> class="btn btn-xs <?php echo $class2; ?>" onclick="on_off_menu2('<?php echo $d; ?>','<?php echo $munu_id; ?>','only_parent')"><?php echo $bname2; ?></button>
</div>
</td>
<?php if(++$i%5 == 0) echo '</tr><tr>'; ?>
<?php
}
?>
 </tr>
</table>    
</div>
<div class="row">
<?php
$get_main_menu_query1 = "SELECT mid,mname,menu_url,mparentid,multilevel,child_id,icon_class FROM $dbName.menus where  mparentid='0' and multilevel='1' and mstatus='1'";
$q_main_l=mysqli_query($clientConnect,$get_main_menu_query1);
$boxCount=1;
while($get_main_menu=mysqli_fetch_array($q_main_l)) 
    {
        $munuid=$get_main_menu['mid']; $menuname=$get_main_menu['mname'];
        if(in_array($munuid,$mpermission)){
         $d=0;  $bname1='ON'; $bname2='OFF'; $class1='btn-success active'; $class2="btn-danger"; $disable1="disabled";    $disable2="";
         $parentStatus=1;
        } 
     else 
     {
        $d=1; $bname1="ON"; $bname2='OFF'; $class2="btn-success active"; $class1="btn-danger"; $disable1=""; $disable2="disabled";   
        $parentStatus=0;
     }
?>
<div class="col-sm-4">
    <fieldset class="scheduler-border" style="min-height: 180px;">
    <legend class="scheduler-border">
        <span style="font-size: 14px  !important;"><?php  echo ucwords($menuname); ?></span>
<div class="btn-group btn-toggle" style="margin-left: 3px;"> 
<button id="<?php echo $munuid."_on"; ?>" <?php echo $disable1; ?>  class="btn btn-xs <?php echo $class1; ?>" style=""   onclick="on_off_menu1('<?php echo $d; ?>','<?php echo $munuid; ?>','only_parent')"><?php echo $bname1; ?></button>
<button id="<?php echo $munuid."_off"; ?>" <?php echo $disable2; ?> class="btn btn-xs <?php echo $class2; ?>" onclick="on_off_menu2('<?php echo $d; ?>','<?php echo $munuid; ?>','only_parent')"><?php echo $bname2; ?></button>
</div>    
</legend> 
    <div class="control-group"> 
    <table cellspacing="1" style="width: 100%; border-collapse: separate; border-spacing: 0 .2em;" border='0' >
<?php
$sub="SELECT mid,mname,menu_url,mparentid,multilevel FROM $dbName.menus where  mparentid='".$munuid."' and mstatus='1'";
$q_main_sub=mysqli_query($clientConnect,$sub);
$boxCount=1;
   while($get_submain_menu=mysqli_fetch_array($q_main_sub)) 
    {
        $submunuid=$get_submain_menu['mid']; $submenuname=$get_submain_menu['mname'];
        if(in_array($submunuid,$mpermission))
        { $d=0;  $bname1='ON'; $bname2='OFF'; $class1='btn-success active'; $class2="btn-danger"; $disable1="disabled";    $disable2="";} 
        else { $d=1; $bname1="ON"; $bname2='OFF'; $class2="btn-success active"; $class1="btn-danger"; $disable1=""; $disable2="disabled";}
        if($parentStatus==0){ $disable1="disabled"; $disable2="disabled";  }
       ?>
       <tr>
       <td><?php  echo ucwords($submenuname); ?></td>
       <td>
           <div class="btn-group btn-toggle"> 
           <button id="<?php echo $submunuid."_on"; ?>" <?php echo $disable1; ?>  class="btn btn-xs <?php echo $class1; ?>" style=""   onclick="on_off_menu1('<?php echo $d; ?>','<?php echo $submunuid; ?>','only_parent')"><?php echo $bname1; ?></button>
           <button id="<?php echo $submunuid."_off"; ?>" <?php echo $disable2; ?> class="btn btn-xs <?php echo $class2; ?>" onclick="on_off_menu2('<?php echo $d; ?>','<?php echo $submunuid; ?>','only_parent')"><?php echo $bname2; ?></button>
           </div>    
       </td>
       </tr>
<?php } ?>
</table>
</div>
</fieldset>
</div>
<?php $boxCount++;} ?>
</div>
<hr>
<p><strong>Module Permission VOD: </strong>&nbsp; &nbsp;&nbsp;
<table  border="0" style="width:100%; height: 70px; margin-left: 5px;">
<tr>
<?php
$j=0;
$sub="SELECT module_id,module_name from module_table where status='1' and  tag='vod'";
$ff= db_select($sub);
foreach($ff as $m)
    {
        $module_id=$m['module_id']; $module_name=$m['module_name'];
        if(in_array($module_id,$otherPermission))
        { $d=0;  $bname1='ON'; $bname2='OFF'; $class1='btn-success active'; $class2="btn-danger"; $disable1="disabled";    $disable2="";} 
        else { $d=1; $bname1="ON"; $bname2='OFF'; $class2="btn-success active"; $class1="btn-danger"; $disable1=""; $disable2="disabled";}
       ?>    
<td><?php echo $module_name; ?></td>
<td>
           <div class="btn-group btn-toggle"> 
           <button id="<?php echo $module_id."_on"; ?>" <?php echo $disable1; ?>  class="btn btn-xs <?php echo $class1; ?>" style=""   onclick="on_off_menu1('<?php echo $d; ?>','<?php echo $module_id; ?>','other_permission')"><?php echo $bname1; ?></button>
           <button id="<?php echo $module_id."_off"; ?>" <?php echo $disable2; ?> class="btn btn-xs <?php echo $class2; ?>" onclick="on_off_menu2('<?php echo $d; ?>','<?php echo $module_id; ?>','other_permission')"><?php echo $bname2; ?></button>
           </div>    
</td>
<?php if(++$j%4 == 0) echo '</tr><tr>'; ?>
<?php } ?>
</tr>
</table>    
<hr>
<p><strong>Module Permission Categories: </strong>&nbsp; &nbsp;&nbsp;
<table  border="0" style="width:100%; height: 70px; margin-left: 5px;">
<tr>
<?php
$j=0;
$sub="SELECT module_id,module_name from module_table where status='1' and tag='category'";
$ff= db_select($sub);
foreach($ff as $m)
    {
        $module_id=$m['module_id']; $module_name=$m['module_name'];
        if(in_array($module_id,$otherPermission))
        { $d=0;  $bname1='ON'; $bname2='OFF'; $class1='btn-success active'; $class2="btn-danger"; $disable1="disabled";    $disable2="";} 
        else { $d=1; $bname1="ON"; $bname2='OFF'; $class2="btn-success active"; $class1="btn-danger"; $disable1=""; $disable2="disabled";}
       ?>    
<td><?php echo $module_name; ?></td>
<td>
           <div class="btn-group btn-toggle"> 
           <button id="<?php echo $module_id."_on"; ?>" <?php echo $disable1; ?>  class="btn btn-xs <?php echo $class1; ?>" style=""   onclick="on_off_menu1('<?php echo $d; ?>','<?php echo $module_id; ?>','other_permission')"><?php echo $bname1; ?></button>
           <button id="<?php echo $module_id."_off"; ?>" <?php echo $disable2; ?> class="btn btn-xs <?php echo $class2; ?>" onclick="on_off_menu2('<?php echo $d; ?>','<?php echo $module_id; ?>','other_permission')"><?php echo $bname2; ?></button>
           </div>    
</td>
<?php if(++$j%4 == 0) echo '</tr><tr>'; ?>
<?php } ?>
</tr>
</table>    
</p>  
    </div>
                       
                       
                    </div>
                   
                </div>
               
                <div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Menu Priority
                        </div>
                        <div class="panel-body">
                        <form class="form-horizontal" method="post" action="common_save.php?action=priority" >       
                           <table border='2' width='100%' class="table-bordered">
                           <tr><th>Menu Name</th><th>Current Priority</th><th>Set Priority</th></tr>    
                           <?php 
                           $get_main_menu_query = "SELECT mid,mname,priority FROM $dbName.menus 
                           where mparentid='0' and mstatus='1' order by priority ";
                           $q_main=mysqli_query($clientConnect,$get_main_menu_query);
                           $countRow=mysqli_num_rows($q_main);
                           while($get_main_menu=mysqli_fetch_array($q_main))
                           {  
                              $munu_id=$get_main_menu['mid']; $menu_name=$get_main_menu['mname']; 
                              $priority=$get_main_menu['priority'];
                           ?>
                           <tr>
                              <td width='60'><?php echo ucwords($menu_name); ?></td>
                              <td width='15'><?php echo $priority; ?></td>
                              <td width='15'>
                                  <input type="hidden" size="5" name="munu_id[]"  value="<?php echo $munu_id; ?>" />
                                   <select class="ranking" name="priority[]" style="width: 60px;">
                                   <?php
                                   for($j=1;$j<=$countRow;$j++){ ?>       	
                                   <option value="<?php echo $j;?>" <?php if ($priority==$j){ echo 'selected'; }?>><?php echo $j; ?></option>
                                   <?php } ?>		
                                   </select>
                              </td>
                           </tr>
                           <?php $count++; } ?>
                           </table>
                            <br>
                            <input type="hidden" name="par_id" value="<?php echo $parIDid; ?>">
                            <input type="hidden" name="pemail" value="<?php echo $email ?>">
                            <button type="submit"  name="save_priority"  class="btn btn-primary center-block">Save Priority</button>
                        </form>    
                        </div>
                    </div>
                </div>
                
            </div>

<script type="text/javascript">
$(".ranking").each(function(){   
    $(this).data('__old', this.value);
}).change(function(){
    var $this = $(this), value = $this.val(),oldValue = $this.data('__old');
    $(".ranking").not(this).filter(function(){
     return this.value == value;
    }).val(oldValue).data('__old', oldValue);
    $this.data('__old', value);
});
</script>
