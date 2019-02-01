<?php 
include_once 'authm.php';
include_once 'pagenamem.php';
$parIDid =(isset($_REQUEST['next']))? $_REQUEST['next']:'';
$email =(isset($_REQUEST['email']))? $_REQUEST['email']:'';
if(isset($_POST['save_menu']))
{     
        $menu_value=$_POST['menu_value'];  $m_name=$_POST['m_name'];  $m_url=$_POST['m_url']; $icon=$_POST['icon']; 
        if($menu_value==0)
        {
            $Query_plan="insert into menus(mname,menu_url,mparentid,mstatus,created_at,icon_class)
   	    values('$m_name','$m_url','$menu_value','1',NOW(),'$icon')";
            $saveplan = db_query($Query_plan);
        }    
        else{
        $Query_plan="insert into menus(mname,menu_url,mparentid,mstatus,created_at,icon_class)
   	values('$m_name','$m_url','$menu_value','1',NOW(),'$icon')";
        $saveplan = last_insert_id($Query_plan);
        $getChild_id="select child_id from menus where mid='$menu_value'";
        $ff=  db_select($getChild_id);
        $child_id=$ff[0]['child_id'];
        if($child_id!='')
        {
            $childID=$child_id.",".$saveplan;
        } 
        else {$childID=$saveplan; }
        $up="update menus set multilevel='1',child_id='$childID' where mid='$menu_value'";
        $save_plan = db_query($up);
        }
                {
                         //header("Location:menusetting.php?msg=success");       
                }
} 
?>

<!DOCTYPE html>
<html>
  <head>
   <meta charset="UTF-8">
 <title><?php echo PROJECT_TITLE." | Menu Permissions";?></title>
 <link href="css/navAccordion.css" rel="stylesheet">
  </head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
           <!-- Left side column. contains the logo and sidebar -->
      <?php include_once 'leftmenu.php';?>
      

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
             <h1>Create Menu
       <a href="#myModal" class="addnew" id="add" title="Add New" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>    	
 </h1>
      <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Menu Setting</li>
      </ol>
        </section>

 	<!-- create menu Model start -->
<section class="content">
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 14px; ">
        <div class="modal-body">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Create Menu</b>
                </h4>
            </div>
       <br/>
	<!-- <form class="form-horizontal" role="form" action="#" method="post" id="confirm" style="border: 0px solid red;">-->
		  <div style="border: 1px solid #c7d1dd ; padding-top: 20px ">
<form id="myform" method="post" class="form-horizontal" >
<div class="col-lg-12">
  <div class="form-inline">
  <div class="col-sm-6 col-md-6 col-lg-6 pull-right">
 <!-- <input type="text" class="form-control" name="category_search" style="  width: 271px !important; margin-left: 9em;"   value="" placeholder="Search Categories">-->
  </div>
  </div>
</div>       
<hr style="border-top:2px solid red; margin-top: 0px; padding: 0px 0px 0px 0px">  </hr>
<div class="form-group" >
<label for="inputPassword" class="control-label col-xs-4">Menu Category:</label>
<div class="col-xs-8">
<div class="container1"> 	                 
<div class="row"> 
<div class="col-md-12" style="padding-right: 20px">
<div id="sidebar" class="well sidebar-nav" style="border: 0px solid red;"> 
<div class="mainNav">
 <div style="margin: 0px 0 9px 0px !important">
     <input type="radio" name="menu_value"  id="menu_value" required value="0" style="margin: 3px 23px 10px 6px  !important"> No Parent </label>
 </div>
<ul style="height:170px;overflow-y: scroll;display: block;   border: 1px solid #c7d1dd; padding: 10px 2px;">
<?php
$que="SELECT mid,mname,mparentid FROM menus where mparentid=0" ;
$row=db_select($que);
foreach ($row as  $menu) {                                    
$mid=$menu['mid']; $mname=$menu['mname'];  $mparentid=$menu['mparentid']; $icon=$menu['icon'];
?>    
<li style="border-bottom: 1px solid #c7d1dd !important; border-top: 0px solid #c7d1dd !important;"> <input type="radio" name="menu_value"    id="menu_value" required value="<?php  echo $mid; ?>">	
<a href="#" style="font-size: 13px !important; color: #555;"><?php echo strtoupper($mname);?></a>
<ul>
<?php
 $ques="SELECT mid,mname FROM menus where mparentid='$mid'" ;
$rows=db_select($ques);
foreach ($rows as  $menus) {                                    
$mids=$menus['mid'];  $mnames=$menus['mname'];

   ?>	
<li>
<a href="#"> <?php  echo strtoupper($mnames); ?></a>

</li>
<?php } ?>
</ul>
</li>			
<?php 
  }
 ?>
</ul>
</div>
  </div>
        </div>    
    </div>                                                                                                           
</div> 
  </div>
     </div>

       <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Menu Name:<span style="color:red;">*</span></label>
            <div class="col-xs-7">
                <input type="text" class="form-control"  pattern="[A-Za-z]+" maxlength="30" required id="m_name" name="m_name" placeholder="Menu Name" value="">
            </div>
        </div>
         <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-4">Menu URL:</label>
            <div class="col-xs-7">
            <input class="form-control" rows="1" id="m_url" name="m_url" placeholder="Page URL" ></input>
            </div> 
        </div>
         <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Menu Icon Class:<span style="color:red;">*</span></label>
            <div class="col-xs-7">
                <input type="text" class="form-control" maxlength="30" required id="icon" name="icon" placeholder="Menu Icon Class" value="">
            </div>
        </div>
       
<div class="form-group">
    <div class="col-xs-offset-4 col-xs-8">
        <button type="submit" class="btn btn-primary btn-primary1" name="save_menu">Save & Close</button>
    </div>
 </div>

   </form> </div> </div>
		
  </div>
    </div>
  </div>       
       
          <div class="box">
          <div class="box-body">
 	 <form method="post">
             
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                            <th>Menu ID</th>
                            <th>Menu-Name</th>
                           <th>Page-Link</th>
                            <th>Fa Icon</th>
                            <th>Create-Date</th>
			    <th>Status</th>
			    <th width="10%">Action</th>
                         
                      </tr> 
                    
                    </thead>
                    <tbody>
 
                    	
 <?php 

// value come from notification
$sql="SELECT * FROM menus order by mname DESC";		
//$sql="select uid,user_id,uname,uemail,dob,ugender,ulocation,added_date,status,oauth_provider from user_registration where partner_id='$partnerID' $addquery $query_search order by uid DESC LIMIT $start, $limit";
$result = db_query($sql);	
$rr= db_select($sql);
//$num=db_totalRow($q);
 foreach($rr as $fetch)
   {
     $mid=$fetch['mid'];  $mname=$fetch['mname']; $menu_url=$fetch['menu_url']; $mparentid=$fetch['mparentid']; 
     $menu_added_date=$fetch['created_at']; $menu_update_date=$fetch['updated_at']; $mstatus=$fetch['mstatus'];$icon_class=$fetch['icon_class']; 
 ?> 
    <tr id="del<?php  echo $mid; ?>"> 
    <td><?php echo $mid; ?></td>
    <td><span id="mname<?php echo $mid;  ?>"><?php echo ucwords($mname); ?></span></td> 
    <td ><span id="page_link<?php echo $mid;  ?>"><?php echo $menu_url; ?></span></td>
    <td ><span id="icon_class<?php echo $mid;  ?>"><?php echo $icon_class; ?> </span>(<i class="fa <?php echo $icon_class; ?>"></i>)</td>
    <td><?php echo $menu_added_date; ?></td>
    <td id="getstatus<?php  echo $mid; ?>"><?php echo $mstatus==1?"Active": "DeActive"; ?></td>
    <input type="hidden" size="2" id="act_deact_status<?php echo $mid;  ?>" value="<?php echo $mstatus;  ?>" >        
<td> 

<a href="javascript:void(0)" class="myBtnn" onclick="edit_menu('<?php echo $mid; ?>')"   id="<?php echo $id; ?>" title="Edit menu" class="addnew">
<span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;


<a href="#">
  <i id="icon_status<?php echo $mid; ?>" class="status-icon fa <?php  echo ($mstatus == 1) ? 'fa-check-square-o fa-check-square-o1':'fa-ban fa-ban1';?>" onclick="act_dect('<?php echo  $mid; ?>')" ></i>
</a>&nbsp;&nbsp;
<a href="#" class="delete" title="Delete" onclick="mdelete('<?php echo  $mid; ?>')" ><span class="glyphicon glyphicon-trash glyphicon-trash1"></span></a> 


</td>                
     
  
            </tr>       
                  <?php } ?>  
                          
                    </tbody>                  
                  </table> 
      </form>         
 </div>                
            </div></section>
 </div><!-- /.box --> 
   
<?php  include_once"footer.php";  ?>

</div>
<div class="modal fade" id="myModal_edit_menu" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
      <div class="modal-content" style="border-radius: 14px; " id="edit_menu"></div>
    </div>
  </div>      
<script src="js/navAccordion.min.js" type="text/javascript"></script>
<script type="text/javascript">
		jQuery(document).ready(function(){
			//Accordion Nav
			jQuery('.mainNav').navAccordion({
				expandButtonText: '<i class="fa fa-chevron-right"></i>',  //Text inside of buttons can be HTML
				collapseButtonText: '<i class="fa fa-chevron-down"></i>'
			}, 
			function(){
				//console.log('Callback')
			});
			
		});
function edit_menu(mid)    
{
     $("#myModal_edit_menu").modal();
      var info = 'action=edit_menu&mid='+mid; 
        $.ajax({
	    type: "POST",
	    url: "PopUpModal.php",
	    data: info,
             success: function(result){
            // $("#flash").hide();
             $('#edit_menu').html(result);
            return false;
        }
 
        });
     return false;  
}                
function mdelete(menuid){
var st=document.getElementById('act_deact_status'+menuid).value;
if(st==1) { alert('This Menu is active so you can not delete'); return false;} 
var d=confirm("Are you sure you want to Delete This?");
if(d)
{
       var info = 'menuid='+ menuid+'&action=menu_delete';
       $.ajax({
       type: "POST",
       url: "coredelete.php",
       data: info,
       success: function(r){
         if(r==1)
         {
             var adstatus=document.getElementById('getstatus'+menuid).innerHTML="delete";
             document.getElementById('getstatus'+menuid).style.color = 'red';
             $("#del" + menuid).remove();
            
         }   

         }
    });  
}    

}  
function act_dect(menuid){
var adstatus=document.getElementById('act_deact_status'+menuid).value;
var msg = (adstatus == 1) ? "Deactive":"Active";
var c=confirm("Are you sure you want to "+msg+ " This?");
if(c)
{
 $.ajax({
   type: "POST",
   url: "core_active_deactive.php",
   data:'menuid='+menuid+'&adstatus='+adstatus+'&action=menu',
   success: function(r){
   	   if(r==0)
   	   { 
   	   	 var adstatus=document.getElementById('getstatus'+menuid).innerHTML=msg;
   	   	
   	     $('#icon_status'+menuid).removeClass('fa-check-square-o').addClass('fa-ban');
   	   }
   	   if(r==1)
   	   {
   	   	var adstatus=document.getElementById('getstatus'+menuid).innerHTML=msg;
   	   
   	   	$('#icon_status'+menuid).removeClass('fa-ban').addClass('fa-check-square-o');
   	   }
            $('#act_deact_status'+menuid).val(r);
       
       
     }
 
   });
 }  
}
function save_edit_menu(mid)
{
     var mname = $('#mname').val();
     var menu_url=$("#menu_url").val();   
     var icon_class=$("#icon_class").val();
     var apiBody = new FormData();
     apiBody.append("mid",mid);
     apiBody.append("mname",mname); 
     apiBody.append("menu_url",menu_url);
     apiBody.append("icon_class",icon_class);
     apiBody.append("action","save_edit_menu");
     $.ajax({
                url:'PopUpModal.php',
                method: 'POST',
                data:apiBody,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(rr){
                $('#myModal_edit_menu').modal('hide');
                var status=rr.success;
                console.log(status);
                if(status==1)
                {
                     //mname page_link,icon_class 
                     var mname=rr.data[0].mname;
                     var menu_url=rr.data[0].menu_url;
                     var icon_class=rr.data[0].icon_class;
                     console.log(mname+"---"+menu_url+"--"+icon_class+"---"+mid);
                     $("#mname"+mid).html(mname);
                     $("#page_link"+mid).html(menu_url);
                     $("#icon_class"+mid).html(icon_class);
                     //$("#del"+mid+"tr").css('background-color', 'Red');
                    
                } 
                
                
                }
            });	
     
    
}
  
  $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });               
            </script>    
        </body>
        
</html>
