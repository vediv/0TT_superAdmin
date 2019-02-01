<?php ob_start();
include_once 'function.inc.php';
include_once '../include/connect_db.php';
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
 $fontID = isset($_GET['fontID']) ? $_GET['fontID'] : '';
 $fontStatus= isset($_GET['fontStatus']) ? $_GET['fontStatus'] : '';
 //$bdcolor= isset($_GET['bdcolor']) ? $_GET['bdcolor'] : '';
 $fontStatusU= ($fontStatus==0) ? 1 : '0';
 
 $upactive="update setting set s_status='$fontStatusU' where sid=$fontID";
 $ractive=$mysqli->query($upactive);
 if($ractive){
 	$sucess_msg= ($fontStatus==0) ? "Active" : "Deactive";
  ?>
 <?php header("location:display_setting.php?val=$sucess_msg");
  /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="display setting $sucess_msg (".$fontID.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
 }
 ?>
 <?php
 if(isset($_REQUEST['save']))
{    $status=0;
	 $bodycolor=$_REQUEST['bcolor']; 
	 $fontcolor=$_REQUEST['fcolor'];
	 $fontsize=$_REQUEST['confirmm']; 
     
 
$sql="insert into setting(body_color,font_color,font_size,s_status,s_create_date) values('$bodycolor','$fontcolor','$fontsize','$status',NOW())";
$r=$mysqli->query($sql);
if($r)
{
	header("Location:display_setting.php?val=sucess");
		 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="display Insert bdcolor (".$bodycolor.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
}

else 
{
	 header("display_setting.php?val=error"); 
}    
	
	 
}
 ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Display Setting <a href="#myModal" class="addnew" id="add" title="Add New" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>
            </h1>
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
             <li class="active">User List</li>
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
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Add Font Color</b>
                </h4>
            </div>
       <br/>
				 <form class="form-horizontal" role="form" action="#" method="post" id="confirm">
						<div class="form-group">
						 <label class="control-label col-sm-3">Font size&nbsp;&nbsp;:</label>
						<div class="col-sm-7">
		                <select class="form-control" name="confirmm" required>
                     	<option value-=''>Select Font size</option>
                        <option value-='8'>8px</option>
                        <option value-='9'>9px</option>
                        <option value-='10'>10px</option>
                        <option value-='11'>11px</option>
                        <option value-='12'>12px</option>
                        <option value-='14'>14px</option>
                        <option value-='16'>16px</option>
                        <option value-='18'>18px</option>
                        <option value-='20'>20px</option>
                        <option value-='24'>24px</option>
                        <option value-='28'>28px</option>
                        <option value-='36'>36px</option>
                        <option value-='48'>48px</option>                       
                      </select>													     
						</div>
                     </div>	    
					
				 
			  <div class="form-group">
			  <label class="control-label col-sm-3" >Body Color:</label>
			 <div class="col-sm-7" >          
			 <input type="text" id="hue-demo"  name="bcolor" class="form-control demo" data-control="hue" value="#ff6161" required="">
			 </div>
			 </div>
				  
			 <div class="form-group">
			 <label class="control-label col-sm-3" >Font Color:</label>
			 <div class="col-sm-7">     
			 <input type="text" id="saturation-demo" name="fcolor" class="form-control demo" data-control="saturation" value="#0088cc" required="">
			</div>
	       </div>
		
						
		<div class="modal-footer">									          
		<div class="col-sm-offset-2 col-sm-5">
		<button type="submit" name="save" class="btn btn-primary" >Submit</button>
		</div>
		</div>		
	  </form>
	  <link rel="stylesheet" type="text/css" media="all" href="dist/css/jquery.minicolors.css">
     <!--<script type="text/javascript" src="js1/jquery-1.10.2.min.js"></script>-->
      <script type="text/javascript" src="dist/js/jquery.minicolors.min.js"></script>
 
    </div><!-- @end .row -->
    </div><!-- @end .well -->
   </div>
   </div> 		
   </div>
  <script type="text/javascript">
$(function(){
  var colpick = $('.demo').each( function() {
    $(this).minicolors({
      control: $(this).attr('data-control') || 'hue',
      inline: $(this).attr('data-inline') === 'true',
      letterCase: 'lowercase',
      opacity: false,
      change: function(hex, opacity) {
        if(!hex) return;
        if(opacity) hex += ', ' + opacity;
        try {
          console.log(hex);
        } catch(e) {}
        $(this).select();
      },
      theme: 'bootstrap'
    });
  });
  
  var $inlinehex = $('#inlinecolorhex h3 small');
  $('#inlinecolors').minicolors({
    inline: true,
    theme: 'bootstrap',
    change: function(hex) {
      if(!hex) return;
      $inlinehex.html(hex);
    }
  });
});
</script> 

<?php
	
if(isset($_POST['sub'] ))
{
 $id=$_POST['id'];
$bodycolor=$_POST['bcolor'];
$fontcolor=$_POST['fcolor'];
$fontsize=$_POST['confirmm'];
//$priority=$_POST['priority'];
//$date=$_POST['date'];
 $sql1="UPDATE `setting` SET `body_color`='$bodycolor',`font_color`='$fontcolor',`font_size`='$fontsize',s_create_date=Now() WHERE sid='$id' ";
 //$query_3="UPDATE setting set body_color='$bodycolor', font_color='$fontcolor',font_size='$fontsize',create_date=Now() where sid='$id'";
 $res_2=$mysqli->query($sql1);

if($res_2)
 {
    	header("Location:display_setting.php?val=edit");  
		
		 /*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Edit display (".$bodycolor.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
  }
}

?>
 
              <div class="box"> 
              	 
            <div class="box-body">
            	 <form method="post">
                  <table id="example1" class="table table-bordered table-striped">
       
                    <thead>
                      <tr>
                        <th>S.No</th>
                          <th>Body Color</th>
                          <th>Font color</th>
                          <th>Font Size</th>
                           
                        <th>Status</th>
                         <th>Date</th>
                        <th>Action</th>
                      </tr> 
                       </thead>
                    <tbody>
                     

   <?php
            
 $s="select * from setting";
 $r= $mysqli->query($s);
 //$num=mysqli_num_rows($r);
 //echo "Total Record=".$num;
 $i=1;
 while($fetch=mysqli_fetch_array($r)){

  
     $id=$fetch['sid'];
	 $bodycolor =$fetch['body_color'];
	 $fontcolor=$fetch['font_color'];
	 $fontsize=$fetch['font_size'];	
	 $s_status=$fetch['s_status'];
	 $date=$fetch['s_create_date'];
	 if($s_status==1)
	 {
	 	$s_status1='Active';
	 }else{$s_status1='Deactive';}
	
	 	
				 	
	 
 ?> 
 <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $bodycolor; ?></td>
                         <td><?php echo $fontcolor; ?></td>
                          <td><?php echo $fontsize; ?></td>
                           <td><?php echo $s_status1; ?></td>
                           <td><?php echo $date; ?></td>
                                <td>
                                	
        <a href="#" id="<?php echo $id; ?>&bcolor=<?php echo $bodycolor; ?>" class="delete" data-status="<?php echo $s_status ; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;
        
        
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
                <h4 class="modal-title" id="myModalLabel"> <b>Edit Font Color </b></h4> 
                 </div>
               
           
          
         <div class="tab-content" id="tabs">

							          

    <?php //include"model.php"; ?>
 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        
        
  	 <a href="display_setting.php?fontID=<?php echo $id; ?>&fontStatus=<?php echo $s_status; ?>&bdcolor=<?php echo $bodycolor; ?>" class="change-status"  data-status="<?php $s_status; ?>" title="<?php echo ($s_status == 1) ? 'Active':'Deactive';?>">
     <i class="status-icon fa <?php echo ($s_status == 1) ? 'fa-check-square-o':'fa-ban';?>"></i>
                         </a>    
                          </td>
                             </tr>  
                                            
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
       include_once"footer.php";
      ?>
    </div><!-- ./wrapper -->
    </script> 

<script type="text/javascript">
$(function(){
  var colpick = $('.demo').each( function() {
    $(this).minicolors({
      control: $(this).attr('data-control') || 'hue',
      inline: $(this).attr('data-inline') === 'true',
      letterCase: 'lowercase',
      opacity: false,
      change: function(hex, opacity) {
        if(!hex) return;
        if(opacity) hex += ', ' + opacity;
        try {
          console.log(hex);
        } catch(e) {}
        $(this).select();
      },
      theme: 'bootstrap'
    });
  });
  
  var $inlinehex = $('#inlinecolorhex h3 small');
  $('#inlinecolors').minicolors({
    inline: true,
    theme: 'bootstrap',
    change: function(hex) {
      if(!hex) return;
      $inlinehex.html(hex);
    }
  });
});
</script> 

   



   <script type="text/javascript">
$(document).ready(function() {
$(".delete").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
//alert(info);
var st=$(this).data("status");
//alert(st);
if(st==1)
{
	alert('This User is active so you can not delete');
	return false;
}

if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "setting_del.php",
   data: info,
   success: function(result){
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
   url: "edit_setting.php",
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
 window.location.href='display_setting.php';
});
</script>


  </body>
</html>
