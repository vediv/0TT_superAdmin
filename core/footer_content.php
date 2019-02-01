   <?php ob_start(); 
   include_once 'function.inc.php';
$commanmsg = isset($_GET['val']) ? $_GET['val'] : '';
if($commanmsg=="Deactive")
{ $msgcall="Deactive Successfully";  }
if($commanmsg=="Active")
{ $msgcall="Active Successfully";  }

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
  	    <?php include_once 'pagename.php';?>

  	    <?php //if($PageName=="data"){?>
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
 $fID = isset($_GET['fID']) ? $_GET['fID'] : '';
 $fStatus= isset($_GET['fStatus']) ? $_GET['fStatus'] : '';
 $fhyper= isset($_GET['hyper']) ? $_GET['hyper'] : '';
  $fStatusU= ($fStatus==0) ? 1 : '0';
 
 $upactive="update dashbord_footer set f_status='$fStatusU' where f_id=$fID";
 $ractive=$mysqli->query($upactive);
 if($ractive){
 	
	
 $sucess_msg= ($fStatus==0) ? "Active" : "Deactive";
  ?>
 <?php header("location:footer_content.php?val=$sucess_msg");
 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="footer $sucess_msg(".$fhyper.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
 }
 ?>

   
   
   
     <?php
 include_once '../include/connect_db.php';
 include_once 'pagename.php';
include_once 'function.inc.php';

 if(isset($_REQUEST['save']))
{
	 $year=$_REQUEST['year']; $content=$_REQUEST['content'];
	 $url=$_REQUEST['url']; 
     
 
$sql="insert into dashbord_footer(f_year,f_content,f_hyperlink,f_date,f_status) values('$year','$content','$url',NOW(),'0')";

//(`f_id`, `f_year`, `f_content`, `f_hyperlink`, `f_date`) VALUES (NULL, 'hghfgh', 'hfgh', 'hh', '');


$r=$mysqli->query($sql);
if($r)
{
	header("Location:footer_content.php?val=sucess");
	/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Insert footer(". $url.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
	
}

else 
{
	 header("footer_content.php?val=error"); 
}    
	
	 
}
 ?>
    
     
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          
          <h1>Footer Content
       <a href="#myModal" class="addnew" id="add" title="Add New" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>    	
 </h1>
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
                      <li class="active">Footer Content </li>
          </ol>
        </section>
     <section class="content">
           <div class="row">
          <div class="col-xs-12">
          <div class="box">
        <div class="box-header">
 
 	     
       	<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 14px; ">
        <div class="modal-body">
          <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Add New Content</b>
                </h4>
            </div>
       <br/>
						 	       <form class="form-horizontal" role="form" action="#" method="post" id="confirm">
													    <div class="form-group">
													      <label class="control-label col-sm-3">Year:</label>
													      <div class="col-sm-5">
													      	<select class="form-control" name="year" required>
															    <option value="2015">2015</option>
															    <option value="2016">2016</option>
															    <option value="2017">2017</option>
															    <option value="2018">2018</option>
															    <option value="2019">2019</option>
															     <option value="2020">2020</option>
															</select>
								 
													     </div>
													    </div>
									    <div class="form-group">
									      <label class="control-label col-sm-3" >Content:</label>
									      <div class="col-sm-5">          
									        <input type="text" class="form-control" name="content" required placeholder="Contents">
									      </div>
									    </div>
									    
									     <div class="form-group">
									      <label class="control-label col-sm-3" >URL:</label>
									      <div class="col-sm-5">          
									        <input type="url" class="form-control"  id="url" name="url"  placeholder=" URL" onblur="checkURL(this)" required="" pattern="^(https?://)?([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$">
									       
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
    <script>
   function checkURL (abc) {
    var string = abc.value;
    console.log(abc);
    if (!~string.indexOf("http")){
        console.log("abcd");
        string = "http://" + string;
    }
    abc.value = string;
    return abc
}
    </script>              	
  

<?php

if(isset($_POST['submit'] ))
{
 $id=$_POST['id'];
$year=$_POST['year'];
$content=$_POST['content'];
$url=$_POST['url'];



 $query3="update dashbord_footer set f_year='$year', f_content='$content',f_hyperlink='$url',f_date=Now() where f_id='$id'";
$q=$mysqli->query($query3);
if($q)
  {
    header("Location:footer_content.php?val=edit");  
	/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Edit footer(". $url.")"; $username=$_SESSION['username'];
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
                        <th>S.No</th>
                          <th>Year</th>
                        <th>Footer Content</th>
                          <th>URL</th>
                        <th>Date</th>
                         <th>Status</th>
                        <th>Action</th>
                         
                      </tr>
                     </thead>
                    <tbody> 

   <?php
            
 $s="select * from dashbord_footer ";
 $r= $mysqli->query($s);
 //$num=mysqli_num_rows($r);
 //echo "Total Record=".$num;
 $i=1;
 while($fetch=mysqli_fetch_array($r)){

  
     $id=$fetch['f_id'];
	 $year=$fetch['f_year'];
	 $content=$fetch['f_content'];
	 $hyperlink=$fetch['f_hyperlink'];	
	 $date=$fetch['f_date'];
	 $fstatus=$fetch['f_status'];
	 	if($fstatus==1)
		{
			$fstatus1='Active';
		}else{$fstatus1='Deactive';}
				 	
	 
 ?> 
 <tr>                     <td><?php echo $i++; ?></td>
                        <td><?php echo $year; ?></td>
                        <td><?php echo $content; ?></td>
                         <td><?php echo $hyperlink; ?></td>
                         <td><?php echo $date; ?></td>
                          <td><?php echo $fstatus1; ?></td>
                         
       <td><a href="#" id="<?php echo $id; ?>&hyp=<?php echo $hyperlink; ?>" data-status="<?php echo $fstatus; ?>" class="delete" title="Delete"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;
                	
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
                <h4 class="modal-title" id="myModalLabel"> <b>Edit Content Details </b></h4> 
                 </div>
               
           
          
         <div class="tab-content" id="tabs">

							          

    <?php //include"model.php"; ?>
 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

   	   <a href="footer_content.php?fID=<?php echo $id;?>&fStatus=<?php echo $fstatus; ?>&hyper=<?php echo $hyperlink; ?>"  title="<?php echo ($fstatus == 1) ? 'Active':'Deactive';?>">
      <i class="status-icon fa <?php echo ($fstatus == 1) ? 'fa-check-square-o':'fa-ban';?>"></i> </a> </td> 
            </tr>             
  	               
  	   <!--<a href="home_setting.php?tagID=<?php echo $id;?>&tagStatus=<?php echo $tagstatus; ?>" class="change-status" data-id="<?php echo $id; ?>" data-status="<?php $f_status; ?>" title="<?php echo ($f_status == 1) ? 'Activate':'Deactivate';?>">--></a>
        
                            <?php } ?>  
		                    </tbody>
                             </table>
              
				   
									   
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
     include"footer.php";
      ?>
    </div>
   
<script type="text/javascript">
$(document).ready(function() {
$(".delete").click(function(){
var element = $(this);
var del_id = element.attr("id");

var info = 'id=' + del_id;
var st=$(this).data("status");
//alert(st);
if(st==1)
{
	alert('This Content is active so you can not delete');
	return false;
}
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "delete_footer.php",
   data: info,
   success: function(result){
  	//href='user_list.php';
  	//alert(result);
      if(result)  
      {
      	alert("Delete successfully");
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
   url: "editfooter.php",
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
 window.location.href='footer_content.php';
});

 </script> 
	
		
	
	</body>
	</html>


