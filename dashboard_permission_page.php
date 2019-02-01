<?php
//error_reporting(E_ALL & ~E_NOTICE);
//ini_set('display_errors', TRUE);
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
    //echo $up;
    $rr=  mysqli_query($clientConnect, $up);
    sleep(1);    
    break;
    case "categoryLevel": 
    $categoryLevel=isset($_POST['categoryLevel'])?$_POST['categoryLevel']:''; 
    $upFilter="UPDATE $dbName.filter_setting SET value ='$categoryLevel'  WHERE tag='category_level' and status='1' ";
    $rr=  mysqli_query($clientConnect, $upFilter);
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
  
<div class="row" style="border:0px solid red; margin-left: 10px; margin-right: 10px;" id="menu_permission">
<div class="col-lg-12" >
 <div id="load" style="display:none;"></div>   
    <div class="panel panel-default">
        <div class="panel-heading">
            Dashboard Permission (<?php echo $publisherID;  ?>)
        </div>
<div class="panel-body">

<p><strong>Dashboard Permission : </strong>&nbsp; &nbsp;&nbsp;
<table  border="0" style="width:100%; height: 70px; margin-left: 5px;">
<tr>
<?php
$j=0;
$sub="SELECT module_id,module_name from module_table where status='1' and  tag='dashboard'";
$ff= db_select($sub);
//print_r($otherPermission);
foreach($ff as $m)
    {
       $module_id=$m['module_id']; $module_name=$m['module_name'];
        if(in_array($module_id,$otherPermission))
        { 
          $d=0;  $bname1='ON'; $bname2='OFF'; 
          $class1='btn-success active'; $class2="btn-danger"; $disable1="disabled";    $disable2="";
        } 
        
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
</div>
</div>
</div>
</div>
<div class="row" style="border:0px solid red; margin-left: 10px; margin-right: 10px;" id="menu_permission">
<div class="col-lg-12" >
 <div id="load" style="display:none;"></div>   
    <div class="panel panel-default">
        <div class="panel-heading">
            Cms Setting (<?php echo $publisherID;  ?>)
        </div>
<div class="panel-body">
<table  border="0"  cellspacing="1"  style="width:30%; height: 70px; margin-left: 5px;">
<tr>
<td>Set Category Level:
</td>
<td>
    <?php 
    $sql = "SELECT value FROM $dbName.filter_setting where tag='category_level' and status='1' ";
    $result=mysqli_query($clientConnect,$sql);
    $value=mysqli_fetch_array($result);
    $catVal=$value['value']; 
    ?>
    <select class="form-control" id="categoryLevel">
    <option value="0" <?php echo $catVal==0?"selected":"";  ?>>Level-0</option>    
    <option value="1" <?php echo $catVal==1?"selected":"";  ?>>Level-1</option>
    <option value="2" <?php echo $catVal==2?"selected":"";  ?>>Level-2</option>
    <option value="3" <?php echo $catVal==3?"selected":"";  ?>>Level-3</option>
    <option value="4" <?php echo $catVal==4?"selected":"";  ?>>Level-4</option>
    </select> 
</td>
<td><button class="btn  btn-success" onclick="cmsSetting('categoryLevel')"> Save</button>
</td>
</tr>
</table>    
</div>
</div>
</div>
</div>


