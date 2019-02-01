<?php include_once 'auth.php';
include_once 'function.inc.php'; 
echo $commanmsg = isset($_GET['val']) ? $_GET['val'] : '';

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

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
             <h1>Playlist </h1>
             <ol class="breadcrumb">
                      <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
                      <li class="active">Playlist</li>
             </ol>
        </section><!-- section content-header-->
        
     <section class="content">
           <div class="row">
          <div class="col-xs-12">
          <div class="box">
      
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
    	header("Location:playlist.php?val=edit");  
		
		/*----------------------------update log file begin-------------------------------------------*/
   $cdate=date('d/m/Y H:i:s');  $action="Edit Title(".$ttag.")"; $username=$_SESSION['username'];
   write_log($cdate,$action,$username);
    /*----------------------------update log file End---------------------------------------------*/ 
  }
}

?>
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
      <div class="modal-content" style="border-radius: 14px; ">
        <div class="modal-body">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Playlist Created</b>
                </h4>
            </div><!-- modal-header-->
        <div class="tab-content" id="tabs">

       <?php //include"model.php"; ?>
 
          </div><!-- tab-content-->
		 </div><!-- modal-body-->
      </div><!-- Modal content-->
    </div><!-- Modal dialog-->
  </div> <!--modal fade-->
  
   <div class="box">
   	
      <div class="box-body">
 	        <form method="post">
 	 	         <table id="example1" class="table table-bordered table-striped">
                     <thead>
	                       <tr>
	                     	  <th>S.No</th>
	                          <th>User Name</th>
	                          <th>Created Playlist</th>
	                          <th>Added Songs</th>
	                          <th>Action</th>
	                         
	                      </tr> 
	                    
                    </thead>
                    <tbody>
 
                    	
                    <?php // value come from notification
                         $s="SELECT pl.pid,pl.uid,ur.uname AS pl_uname,COUNT(DISTINCT pl.pid) AS totcnt FROM playlists pl LEFT JOIN user_registration ur ON (pl.uid=ur.uid) GROUP BY pl.uid order by pl.playlist_name";
	                     //$s="SELECT ur.*,pl.uid as plf_uid,COUNT(DISTINCT pl.uid) as totcnt from user_registration ur left join playlists pl ON (pl.uid=ur.uid) group by ur.uid  order by ur.uname " ;
                         //echo $query;
						 $r= $mysqli->query($s);
						 $num=mysqli_num_rows($r);
						 //echo "Total Record=".$num;
						 $i=1;
							 while($fetch=mysqli_fetch_array($r))
							  {
							     $id=$fetch['uid'];
								 $pl_uname =$fetch['pl_uname'];
							     $pid=$fetch['totcnt'];
								 $ppid=$fetch['pid'];
							
							
				   ?>
              <tr>
                           
                   <td class="first"><?php echo $i++; ?></td>
                   <td><?php echo $pl_uname; ?></td>
                   <td><?php echo $pid;?>
      	               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      	               <a href="#myModal" id="<?php echo $pl_uname.",".$id; ?>" class="addnew"  title="Add New" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal">Show Details </a></td>
                   <td>
                           <?php
	                           // echo $id;
							   $get_playlist="select * from playlists where uid='$id'";
							   $get_playlist_result= $mysqli->query($get_playlist);
                           ?>

                           <select style="width:120px" name="pr[]">
                           <option  value="Playlists">Select Playlists</option>
               
                              <?php
				               while($fetchp=mysqli_fetch_array($get_playlist_result))
									  {
									     $PlayList_ID=$fetchp['pid']; $PlayList_Name=$fetchp['playlist_name']; $userID=$fetchp['uid'];
				                ?>           
				              <option data-target="#LegalModal" id="<?php echo $PlayList_ID; ?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" title="Songs" class="result" value="<?php echo $PlayList_ID;?>"><?php echo $PlayList_Name; ?></option>
				                 	
				               <?php }?>
                            </select>
                  </td>
                  <td><a href="#" id="<?php //echo $id; ?>&uname=<?php //echo $uname;?>" data-status="<?php //echo status; ?>" class="delete" title="Delete"><span class="glyphicon glyphicon-trash"></span></a> &nbsp;&nbsp;&nbsp;
                      <!--  <a href="#LegalModal" id="<?php//echo $uid; ?>"  data-target=".bs-example-modal-lg" data-toggle="modal" title="Edit" class="result">--><span class="glyphicon glyphicon-edit"></span><!--</a>&nbsp;&nbsp;&nbsp;-->
 

 	                     <div id="mModal" tabindex="-1" aria-labelledby="myModalLabel" role="dialog"  aria-hidden="true" class="modal fade bs-example-modal-lg"  data-backdrop="static" data-keyboard="false">
                              <div class="modal-dialog">
                                  <div class="modal-content" style="border-radius: 14px;">
                                      <div class="modal-body">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">
                                                   <span aria-hidden="true">&times;</span>
                                                   <span class="sr-only">Close</span>
                                              </button>
                                                    <h4 class="modal-title" id="mModal"><b>Songs List</b></h4> 
                                          </div><!--modal-header-->
                                        <div class="tab-content" id="tabbs">

                                              <?php //include"model.php"; ?>
 
								        </div><!-- tab-content-->
									 </div><!-- modal-body-->
								   </div><!-- Modal content-->
							 </div><!-- Modal dialog-->
					     </div> <!--LegalModal-->
								

                 </td> 
            </tr>       
                  <?php } ?>  
                          
                    </tbody>                  
              </table> 
     	</form>  		   
                      
     
 </div><!-- /.box-body -->     
    
 </div> <!-- /.box -->          
                
              
          </div><!-- /.box -->  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.section content -->
      </div><!-- /.content-wrapper -->
      


      <?php
       include_once"footer.php";
      ?>
    </div><!-- ./wrapper -->

 
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
							   		
							        if(result)
							        {
							        	alert("Delete Successfully");
							        	
							        }
							         window.location.reload();
							 }
							      });
							var row = $(this).closest('tr');
							var	 siblings = row.siblings();                 
				            row.remove();                                      
						            siblings.each(function(index) {                     
						                $(this).children('td').first().text(index + 1); 
						                                          });
							 
							 }
							return false;
							});
							});


      </script> 
 
				  <script type="text/javascript">
				  
							$(document).ready(function() { //return false;
							$(".addnew").click(function(){//alert ("param");
							$('#myModal').modal({
							                       backdrop: 'static'
							           
							                   });
							var element = $(this);
							var del_id = element.attr("id");
							var info = 'id=' + del_id;
							  // alert("hi" + info);
							 $.ajax({
							   type: "POST",
							   url: "playlist_created.php",
							   data: info,
							   success: function(result){
							      //alert(result);
							      
							      $('#tabs').html(result);
							      
							     //$("#myModal").modal('show');
							        //return false;
							          
							 }
							 
							});
							return false;
							    
							});
							
							});
				 </script>   
    
						<script type="text/javascript">
						
						$(document).ready(function() { //return false;
						$(".result").click(function(){//alert ("param");
						$('#mModal').modal({
						    backdrop: 'static'
						   
						        });
						var element = $(this);
						var del_id = element.attr("id");
						var info = 'id=' + del_id;
						  // alert("hi" + info);
						
						 $.ajax({
						   type: "POST",
						   url: "playlist_songs.php",
						   data: info,
						   success: function(result){
						       //alert(result);
						      
						       $('#tabbs').html(result);
						      
						     //$("#LegalModal").modal('show');
						      // return false;
						          
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
				//bootbox.alert("<?php //echo $msgcall;?>", function() {
				// window.location.href='playlist.php';
				//});
				//window.location.reload='home_setting.php';
		    </script>  
       
  </body>
</html>
