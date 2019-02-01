<?php ob_start();
include_once 'function.inc.php'; 
$commanmsg = isset($_GET['val']) ? $_GET['val'] : '';
if($commanmsg=="Deactive")
{ $msgcall="Tag Deactive Successfully";  }
if($commanmsg=="Active")
{ $msgcall="Tag Active Successfully";  }

if($commanmsg=="update")
{ $msgcall="priority Saved Successfully";  }
if($commanmsg=="edit")
{ $msgcall="Successfully Edit";  }
if($commanmsg=="sucess")
{ $msgcall="Successfully Added";  }
?>
<!DOCTYPE html>
<html>
  <head>

  	    <meta charset="UTF-8">
  	    <?php //if($PageName=="data"){?>
  	    	<?php include_once 'pagename.php';?>

     <title><?php echo PROJECT_TITLE."-".$PageName;?></title>
  </head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'header.php';?>
           <!-- Left side column. contains the logo and sidebar -->
      <?php include_once 'lsidebar.php';?>
      <!-- Content Wrapper. Contains page content -->

<?php
// this following code for active and deactive
 $tagID = isset($_GET['tagID']) ? $_GET['tagID'] : '';
 $tagStatus= isset($_GET['tagStatus']) ? $_GET['tagStatus'] : '';
  $tname= isset($_GET['tname']) ? $_GET['tname'] : '';
 
  $tagStatusU= ($tagStatus==0) ? 1 : '0';
 
 $upactive="update home_title_tag set tag_status='$tagStatusU' where tags_id=$tagID";
 $ractive=$mysqli->query($upactive);
 if($ractive){
 	
	
 $sucess_msg= ($tagStatus==0) ? "Active" : "Deactive";  
 
  ?>
 <?php header("location:home_setting.php?val=$sucess_msg");
 include_once 'function.inc.php'; 
 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Title $sucess_msg (".$tname.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
 
 }
 ?>




<?php    
if(isset($_REQUEST['save']))
	{
	 	$ttag=$_REQUEST['ttag']; $stag=$_REQUEST['stag'];
        $sql="insert into home_title_tag (title_tag_name,search_tag,tag_status,priority,create_date) Select '$ttag','$stag','0',ifnull(max(priority),0)+1,NOW() from home_title_tag";
        $r=$mysqli->query($sql);
if($r)
{
	header("Location:home_setting.php?val=sucess");
	
	/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Add Title(".$ttag.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
   
}

else 
{
	 header("home_setting.php?val=error"); 
}    
	
	 
}
	
	 ?>  
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          
          <h1>Home Setting
       <a href="#myModal" class="addnew" id="add" title="Add New" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>    	
 </h1>
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
                      <li class="active">Home Setting  </li>
          </ol>
        </section>
     <section class="content">
           <div class="row">
          <div class="col-xs-12">
          <div class="box">
        <div class="box-header">
 
 	     
           
        	
     <?php     
     if(isset($_REQUEST['savechanges']))
	{
	 	$pidd=$_REQUEST['idd']; $prio=$_REQUEST['pr'];
        $i=0;
        foreach($pidd as $ptid)
		{
			    $ptid; $pri=$prio[$i];		
			    	
			    //echo $ptid; echo "----"; echo $pri=$prio[$i];			
		 $s="update home_title_tag set priority='$pri' where tags_id='$ptid'";
         $r=$mysqli->query($s);
		 
		 $i++;
		}  
		header("Location:home_setting.php?val=update");      
        
       // $sql="insert into home_title_tag (title_tag_name,search_tag,tag_status,priority,create_date) Select '$ttag','$stag','0',ifnull(max(priority),0)+1,NOW() from home_title_tag";
        //$r=$mysqli->query($sql);
        
        /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Change Priority Home(".$ptid.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
   
	 
} ?>
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
                  <b>Add New Tags</b>
                </h4>
            </div>
       <br/>
						 	       <form class="form-horizontal" role="form" action="#" method="post" id="confirm">
													    <div class="form-group">
													      <label class="control-label col-sm-3">Tag Name:</label>
													      <div class="col-sm-5">
													        <input type="text" class="form-control" required name="ttag" placeholder="Tag Name">
													      </div>
													    </div>
									    <div class="form-group">
									      <label class="control-label col-sm-3" >Search Tag:</label>
									      <div class="col-sm-5">          
									        <input type="text" class="form-control" name="stag" required aria-required pattern="^[a-zA-Z\d@#$_-]*$" placeholder="Search Tag Name" title="Space Not Allowed">
									      </div>
									    </div>
									    
						    <div class="modal-footer">
									          
									      <div class="col-sm-offset-2 col-sm-5">
									        <button type="submit" name="save" class="btn btn-primary" >Submit</button>
									      </div>
									    </div>

						  </form>
			
		 </div> 
		
  </div>
    </div>
  </div>
</div>

			
		
	
        <!-- Main content -->
      
<?php
	
if(isset($_POST['sub'] ))
{
$id=$_POST['id'];
$ttag=$_POST['ttag'];
$stag=$_POST['stag'];
//$status=$_POST['status'];
//$priority=$_POST['priority'];
//$date=$_POST['date'];


$query3="update home_title_tag set title_tag_name='$ttag', search_tag='$stag',create_date=Now() where tags_id='$id'";

$q= $mysqli->query($query3);
 
if($q)
 {
    	header("Location:home_setting.php?val=edit");  
		
		/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Edit Title(".$ttag.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
  }
}

?>
      
          

              <div class="box">
 <!-- /.box-header -->
 


           <div class="box-body">
 	 <form method="post">
 	 	
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr>
                        <th>Tag No</th>
                          <th>Tag Name</th>
                          <th>Search Tag</th>
                          <th>Tag Status</th>
                         <th>Priority</th>
                        <th>Date</th>
                        <th>Action</th>
                         
                      </tr> 
                    
                    </thead>
                    <tbody>
 
                    	
                    <?php 
// value come from notification

$s="select * from home_title_tag";

//echo $query;
 $r= $mysqli->query($s);
  $num=mysqli_num_rows($r);
 //echo "Total Record=".$num;
 $i=1;
 while($fetch=mysqli_fetch_array($r))
  {
     $id=$fetch['tags_id'];
	 $ttag =$fetch['title_tag_name'];
	 $stag=$fetch['search_tag'];
	 $tagstatus=$fetch['tag_status'];	
	 
	 $priority=$fetch['priority'];
	 $date=$fetch['create_date'];
	if($tagstatus==1)
	{
		$tagstatus1='Active';
	}
	else{$tagstatus1='Deactive';}
 ?> <tr>
                           
                          <td class="first"><?php echo $i++; ?></td>
                          <td><?php echo $ttag; ?></td>
                          <td><?php echo $stag; ?></td>
                          <td><?php echo $tagstatus1; ?></td>
                          <td>
                          	<input type="hidden" name="idd[]" value="<?php echo $id; ?>" />
                          	<select class="form-control ranking" name="pr[]">
                          	
    <?php  for($j=1;$j<=$num;$j++){
    	        
		   ?>       	
    <option value="<?php echo $j;?>" <?php if ($priority==$j){ echo 'selected'; }?>><?php echo $j; ?></option>
   
    <?php 
	
	}?>		
    
    
    </select>
    
    
    </td>
    <td><?php echo $date; ?></td>
                                

                          
       <td> <a href="#" id="<?php echo $id; ?>&tname=<?php echo $ttag; ?>" data-status="<?php echo $tagstatus; ?>" class="delete" title="Delete"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;
        <!--<a href="edit_home_setting.php?eid=<?php echo $id; ?>" name="edit" class="fancybox fancybox.ajax" ><span class="glyphicon glyphicon-edit"></span></a>  &nbsp;&nbsp;&nbsp;
  	<a href="edit_home_setting.php?eid=<?php echo $id;?>" data-toggle="modal" class="btn btn-info" name="edit" data-backdrop="static" data-keyboard="false" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;
 

 <ul class="list-unstyled legal-tabs" style="text-align:center;">-->
 <a href="#LegalModal" id="<?php echo $id; ?>"  data-target=".bs-example-modal-lg" data-toggle="modal" title="Edit" class="result"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;&nbsp;
 

 	<div id="LegalModal" tabindex="-1" aria-labelledby="myModalLabel" role="dialog"  aria-hidden="true" class="modal fade bs-example-modal-lg" data-backdrop="static" data-keyboard="false">
<!--<div id="modal_id" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">-->
  <div class="modal-dialog">
          <div class="modal-content" style="border-radius: 14px;">
               <div class="modal-body">
                   <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"> <b>Edit Tags Details </b></h4> 
                 </div>
               
           
          
         <div class="tab-content" id="tabs">

							          

    <?php //include"model.php"; ?>
 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 
  	<a href="home_setting.php?tagID=<?php echo $id;?>&tagStatus=<?php echo $tagstatus; ?>&tname=<?php echo $ttag; ?>" class="sta" title="<?php echo ($tagstatus == 1) ? 'Active':'Deactive';?>">
      <i class="status-icon fa <?php echo ($tagstatus == 1) ? 'fa-check-square-o':'fa-ban';?>"></i> </a> </td> 
            </tr>       
                  <?php } ?>  
                          
                    </tbody>                  
                  </table> 
     
	<p align="center"> <button type="submit" name="savechanges" class="btn btn-primary">Save Changes</button></p>
					 
				   
									   
                  </form>         
     
 </div>
 </div>             
                
               <!-- /.box-body -->
 </div><!-- /.box -->  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      


      <?php
       include_once"footer.php";
      ?>
    </div><!-- ./wrapper -->
</script>
      <!--  <script type="">
$(function() {
  $('.legal-tabs li').on('click', function() {
    var tab = $(this).index();
    $('.nav nav-tabs .modal-body .nav-tabs a:eq(' + tab + ')').tab('show');
	 $('#LegalModal').modal({ backdrop: 'static', keyboard: true });
  });
});
</script>-->
 <script type="text/javascript">
 //bootbox.alert("Sucessfully Edit");
//window.location:"edit_home_setting.php?&edit=profile edit sucess";
	
</script>   
  
<script type="text/javascript">
$(document).ready(function() {
$(".delete").click(function(){
var element = $(this);
var del_id = element.attr("id");
//alert(del_id);
var st=$(this).data("status");
//alert(st);
if(st==1)
{
	alert('This tag is active so you can not delete');
	return false;
}

var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "delete_home.php",
   data: info,
   success: function(result){
   		//window.location.href='home_setting.php';
        if(result)
        {
        	alert("Delete Successfully");
        	
        }
         window.location.reload();
 }
});
var row = $(this).closest('tr');
var siblings = row.siblings();                      // *
            row.remove();                                       // *
            siblings.each(function(index) {                     // *
                $(this).children('td').first().text(index + 1); // *
            });
 // $(this).parents(".table tr").animate({ backgroundColor: "#003" }, "slow")
  //.animate({ opacity: "hide" }, "slow");
 
 }
return false;
});
});


</script> 
  
  
<script type="text/javascript">
$(document).ready(function() { //return false;
    
$(".result").click(function(){//alert ("param");
$('#LegalModal').modal({
            backdrop: 'static'
           
        });
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
   // alert("hi" + info);

 $.ajax({
   type: "POST",
   url: "edit_home_setting.php",
   data: info,
   success: function(result){
       //alert(result);
      
       $('#tabs').html(result);
      
     //$("#LegalModal").modal('show');
        //return false;
          
 }
 
});
return false;
    
});

});
</script>   
    
    
<script type="text/javascript">
	
	$(".ranking").each(function(){
    $(this).data('__old', this.value);
}).change(function() {
    var $this = $(this), value = $this.val(), oldValue = $this.data('__old');

    $(".ranking").not(this).filter(function(){
        return this.value == value;
    }).val(oldValue).data('__old', oldValue);

    $this.data('__old', value)
});

</script> 
  
  
  
  
    <script type="text/javascript">
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
  <script type="text/javascript">
bootbox.alert("<?php echo $msgcall;?>", function() {
 window.location.href='home_setting.php';
});


//window.location.reload='home_setting.php';
</script>  
       
  </body>
</html>
