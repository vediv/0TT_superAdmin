<?php 
include_once 'authm.php';
include_once 'pagenamem.php';
$parIDid =(isset($_REQUEST['next']))? $_REQUEST['next']:'';
$email =(isset($_REQUEST['email']))? $_REQUEST['email']:'';
if(isset($_POST['save_module']))
{     
        $m_name=ucwords($_POST['m_name']);  
        $Query_plan="insert into module_table(module_name,created_at,status)values('$m_name',NOW(),'1')";
        $saveplan = db_query($Query_plan);
        header("Location:module_setting.php?msg=success");       
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
      <h1>Create Module
        <a href="#myModal" class="addnew" id="add" title="Add New" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>    	
      </h1>
      <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Module Setting</li>
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
                  <b>Create Module</b>
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
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Module Name:<span style="color:red;">*</span></label>
            <div class="col-xs-7">
                <input type="text" class="form-control"   maxlength="50" required id="m_name" name="m_name" placeholder="Module Name" value="">
            </div>
        </div>
       
<div class="form-group">
    <div class="col-xs-offset-4 col-xs-8">
        <button type="submit" class="btn btn-primary btn-primary1" name="save_module">Save & Close</button>
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
                           <th>Module ID</th>
                           <th>Module-Name</th>
                           <th>Module-Tag</th>
                            <th>Create-Date</th>
			    <th>Status</th>
			    <th width="10%">Action</th>
                         
                      </tr> 
                    
                    </thead>
                    <tbody>
 
                    	
 <?php 

// value come from notification
$sql="SELECT * FROM module_table order by module_name DESC";		
$result = db_query($sql);	
$rr= db_select($sql);
//$num=db_totalRow($q);
 foreach($rr as $fetch)
   {
     $mid=$fetch['module_id'];  $module_name=$fetch['module_name']; 
     $m_added_date=$fetch['created_at']; $m_update_date=$fetch['updated_at']; 
     $mstatus=$fetch['status'];  $tag=$fetch['tag']; 
 ?> 
    <tr id="del<?php  echo $mid; ?>"> 
    <td><?php echo $mid; ?></td>
    <td><span id="module_name<?php echo $mid;  ?>"><?php echo ucwords($module_name); ?></span></td> 
    <td><?php echo $tag; ?></td>
    <td><?php echo $m_added_date; ?></td>
    <td id="getstatus<?php  echo $mid; ?>"><?php echo $mstatus==1?"Active": "DeActive"; ?></td>
    <input type="hidden" size="2" id="act_deact_status<?php echo $mid;  ?>" value="<?php echo $mstatus;  ?>" >        
<td> 

<a href="javascript:void(0)" class="myBtnn" onclick="edit_module('<?php echo $mid; ?>')"   id="<?php echo $id; ?>" title="Edit Module" class="addnew">
<span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;


<a href="#">
  <i id="icon_status<?php echo $mid; ?>" class="status-icon fa <?php  echo ($mstatus == 1) ? 'fa-check-square-o fa-check-square-o1':'fa-ban fa-ban1';?>" onclick="act_dect('<?php echo  $mid; ?>')" ></i>
</a>&nbsp;&nbsp;
<a href="#" class="delete" title="Delete" onclick="moduledelete('<?php echo  $mid; ?>')" ><span class="glyphicon glyphicon-trash glyphicon-trash1"></span></a> 


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
<div class="modal fade" id="myModal_edit_module" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
      <div class="modal-content" style="border-radius: 14px; " id="edit_module"></div>
    </div>
  </div>      

<script type="text/javascript">
function edit_module(mid)    
{
     $("#myModal_edit_module").modal();
      var info = 'action=edit_module&mid='+mid; 
        $.ajax({
	    type: "POST",
	    url: "PopUpModal.php",
	    data: info,
             success: function(result){
            // $("#flash").hide();
             $('#edit_module').html(result);
            return false;
        }
 
        });
     return false;  
}                
function moduledelete(moduleid){
var st=document.getElementById('act_deact_status'+moduleid).value;
if(st==1) { alert('This Module is active so you can not delete'); return false;} 
var d=confirm("Are you sure you want to Delete This?");
if(d)
{
       var info = 'moduleid='+ moduleid+'&action=module_delete';
       $.ajax({
       type: "POST",
       url: "coredelete.php",
       data: info,
       success: function(r){
         if(r==1)
         {
             var adstatus=document.getElementById('getstatus'+moduleid).innerHTML="delete";
             document.getElementById('getstatus'+moduleid).style.color = 'red';
             $("#del" + moduleid).remove();
            
         }   

         }
    });  
}    

}  
function act_dect(moduleid){
var adstatus=document.getElementById('act_deact_status'+moduleid).value;
var msg = (adstatus == 1) ? "Deactive":"Active";
var c=confirm("Are you sure you want to "+msg+ " This?");
if(c)
{
 $.ajax({
   type: "POST",
   url: "core_active_deactive.php",
   data:'moduleid='+moduleid+'&adstatus='+adstatus+'&action=module',
   success: function(r){
   	   if(r==0)
   	   { 
   	   	 var adstatus=document.getElementById('getstatus'+moduleid).innerHTML=msg;
   	   	
   	     $('#icon_status'+moduleid).removeClass('fa-check-square-o').addClass('fa-ban');
   	   }
   	   if(r==1)
   	   {
   	   	var adstatus=document.getElementById('getstatus'+moduleid).innerHTML=msg;
   	   
   	   	$('#icon_status'+moduleid).removeClass('fa-ban').addClass('fa-check-square-o');
   	   }
            $('#act_deact_status'+moduleid).val(r);
       
       
     }
 
   });
 }  
}
function save_edit_module(mid)
{
    var module_name = $('#module_name').val();
    
     var apiBody = new FormData();
     apiBody.append("mid",mid);
     apiBody.append("module_name",module_name); 
     
     apiBody.append("action","save_edit_module");
     $.ajax({
                url:'PopUpModal.php',
                method: 'POST',
                data:apiBody,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(rr){
                $('#myModal_edit_module').modal('hide');
                var status=rr.success;
                console.log(status);
                if(status==1)
                {
                     //mname page_link,icon_class 
                     var module_name=rr.data[0].module_name;
                    
                     console.log(module_name+"------"+mid);
                     $("#module_name"+mid).html(module_name);
                    
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
