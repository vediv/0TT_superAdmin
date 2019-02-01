<?php
session_start();
if( !isset($_SESSION['super_dasbord_par_id'])){
	header("Location:index.php");
	exit;
}
include_once 'include/function.inc.php';
$action=$_REQUEST['action'];
$parID=trim($_POST['par_id']); $parEmail=trim($_POST['pemail']);
$query = "SELECT dbName,dbHostName,dbUserName,dbpassword from ott_publisher.publisher where acess_level='p' and par_id='".$parID."' and email='".$parEmail."'";
$fetch= db_select($query);
$dbName=$fetch[0]['dbName'];  $dbHostName=$fetch[0]['dbHostName']; 
$dbUserName=$fetch[0]['dbUserName']; $dbpassword=$fetch[0]['dbpassword']; 
$clientConnect =  mysqli_connect($dbHostName, $dbUserName, $dbpassword, $dbName);
if(!$clientConnect)    
header ("location:add_menu.php?next=$parID&email=$parEmail&emsg=1"); //die("Unable to connect Mysql please try some time"); 
if (!mysqli_select_db($clientConnect,$dbName))     
header ("location:add_menu.php?next=$parID&email=$parEmail&emsg=2"); //die("Unable to connect please try some time");
switch($action)
{
    case "add_menu":
    $main_menus=$_POST['menus'];  
    //print_r($main_menus);    
    foreach ($main_menus as $menuid)
    {
      $getMenu="select * from ott_publisher.menus where mid='".$menuid."'"; 
      $fmenu=db_select($getMenu);
      $mid=$fmenu[0]['mid']; $mname=$fmenu[0]['mname'];$menu_url=$fmenu[0]['menu_url'];
      $mparentid=$fmenu[0]['mparentid'];$mstatus=$fmenu[0]['mstatus'];
      $multilevel=$fmenu[0]['multilevel']; $child_id=$fmenu[0]['child_id']; $icon_class=$fmenu[0]['icon_class'];
       if($mparentid==0){
        $inClient="insert into $dbName.menus(mid,mname,menu_url,mparentid,mstatus,created_at,multilevel,child_id,icon_class,priority)
        Select '$mid','$mname','$menu_url','$mparentid','$mstatus',NOW(),'$multilevel','$child_id','$icon_class',ifnull(max(priority),0)+1 from $dbName.menus";
         }
        else
        {
         $inClient="insert into $dbName.menus(mid,mname,menu_url,mparentid,mstatus,created_at,multilevel,child_id,icon_class)
         values('$mid','$mname','$menu_url','$mparentid','$mstatus',NOW(),'$multilevel','$child_id','$icon_class')"; 
        } 
      $rr= mysqli_query($clientConnect, $inClient);
     }
   //print_r($main_menus);
    $menuexlpoad=implode(",",$main_menus);
    $up_publiser="UPDATE $dbName.publisher SET menu_permission = CONCAT_WS(',',NULLIF(menu_permission,''),$menuexlpoad),operation_permission='1,2,3,4' where par_id='".$parID."' and email='".$parEmail."'";
    $r=  mysqli_query($clientConnect, $up_publiser);
    mysqli_close($clientConnect);
       if($r){
          header ("location:add_menu.php?next=$parID&email=$parEmail&msg=success");
          }
          else{ header ("location:puserlist.php?msg=error_in_add_menu");
            } 
    break;    
    
    case "edit_menu":
    $main_menus=$_POST['menus'];   $other_permission=$_POST['other_permission'];
    foreach ($main_menus as $menuid)
    {
      $getMenu="select * from ott_publisher.menus where mid='".$menuid."'"; 
      $fmenu=db_select($getMenu);
      $mid=$fmenu[0]['mid']; $mname=$fmenu[0]['mname'];$menu_url=$fmenu[0]['menu_url'];
      $mparentid=$fmenu[0]['mparentid'];$mstatus=$fmenu[0]['mstatus'];
      $multilevel=$fmenu[0]['multilevel']; $child_id=$fmenu[0]['child_id']; $icon_class=$fmenu[0]['icon_class'];
      
      $inClient="insert into $dbName.menus(mid,mname,menu_url,mparentid,mstatus,created_at,multilevel,child_id,icon_class)
      values('$mid','$mname','$menu_url','$mparentid','$mstatus',NOW(),'$multilevel','$child_id','$icon_class')";
      $rr= mysqli_query($clientConnect, $inClient);  
      
      $menuexlpoad=trim(implode(",",$main_menus)); $other_permission_set=trim(implode(",",$other_permission));
      $up_publiser="update $dbName.publisher set menu_permission='$menuexlpoad',operation_permission='1,2,3,4',other_permission='$other_permission_set' where par_id='".$parID."' and email='".$parEmail."'";
      $r=  mysqli_query($clientConnect,$up_publiser);
      
    }
    mysqli_close($clientConnect);
    if($r){
    header ("location:puserlist.php?msg=edit_menu_success");
    }
    else{ header ("location:puserlist.php?msg=error_in_edit_menu");
        } 
    
    break; 
    case "priority":
     $munu_id=$_POST['munu_id']; $priority=$_POST['priority']; 
     $i=0;
     foreach($munu_id as $mids)
           {
              $pri=$priority[$i];	
              $upPriority="update $dbName.menus set priority='$pri' where mid='$mids'";  echo '<br>';
              $r=  mysqli_query($clientConnect,$upPriority);
              $i++;
     } 
     mysqli_close($clientConnect);
     header ("location:menuPermission.php?next=$parID&email=$parEmail&msg=priority_update");
     break; 
     case "save_resetPass":
     $confirmPassword=$_POST['confirmPassword'];   
     $cmd5=md5($confirmPassword);
     $up_ott="update ott_publisher.publisher set publisher_pass='$cmd5' where acess_level='p' and par_id='".$parID."' and email='".$parEmail."' ";
     $fott=db_query($up_ott);
     $up_ott_pub="update $dbName.publisher set publisher_pass='$cmd5' where acess_level='p' and par_id='".$parID."' and email='".$parEmail."' ";
     $r=  mysqli_query($clientConnect,$up_ott_pub);
     if($r)
     {
        echo 1;
        mysqli_close($clientConnect);
        exit;
     }   
     else{
         echo 2;
         mysqli_close($clientConnect);
         exit;
     }
    break; 
     
     
    
}
?>

