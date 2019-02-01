<?php 
include_once 'function.inc.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    	<?php include_once 'pagename.php';?>
<title><?php echo PROJECT_TITLE."-".$PageName;?></title>
<script type="text/javascript">
function refreshcontent(refresh){
     $("#flash").show();
     $("#flash").fadeIn(400).html('Loading <img src="img/image_process.gif" />');
      var dataString ='refresh='+ refresh;
     //$("#result").html();
       $.ajax({
           type: "POST",
           url: "media_paging.php",
           data: dataString,
           cache: false,
           success: function(result){
          	//alert(result);
           	 $("#results").html('');
          	 $("#flash").hide();
          	 $("#results").html(result);
          }
     });
}   
</script>
  </head>
<body class="skin-blue">
   <div class="wrapper">
<?php include_once 'header.php';?>
<?php include_once 'lsidebar.php';?>
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Upload Media  <!--<ul class="list-unstyled legal-tabs" style="text-align:center;">-->
           <a href="#LegalModal" data-target=".bs-example-modal-lg" data-toggle="modal" title="Add New">
           	<small><span class="glyphicon glyphicon-plus" style="color:#3290D4"></span></small></a></h1> 
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Upload Media</li>
          </ol>          
         </section>
        <section class="content">
           <div class="row">
          <div class="col-xs-12">
          <div class="box">
        <div class="box-header">
        
<!-- this foloowing code show the upload model -->   

<div id="LegalModal" class="modal fade bs-example-modal-lg" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  
  <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 14px; ">
        <div class="modal-body">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Upload Media</b>
                </h4>
            </div>
         <?php include_once 'upload_by_admin.php'; ?>
			
 </div> 
		
  </div>
    </div>
  </div>
  
  <!-- this foloowing code show the upload model -->  
  
<div class="row" style="border: 0px solid red;">
  <div class="col-sm-3" style="border: 0px solid red;">
  	 <div class="pull-left">
				  	<form class="navbar-form" role="search" method="post">
				    <div class="input-group add-on">
				     <input class="form-control" size="40" placeholder="Search Entries"  autocomplete="off" name='searchQuery' id='searchInput' class="searchInput" type="text">
				      <div class="input-group-btn">
				        <!--<button class="enableOnInput btn btn-default" disabled='disabled' type="button" id="searchall"> -->
				        <button class="enableOnInput btn btn-default" disabled='disabled' id='submitBtn' type="button" ><i class="glyphicon glyphicon-search"></i></button>	
				       
				       <button class="enableOnInput btn btn-default" disabled='disabled' id='clearcBtn' type="button" >
				        <span class="glyphicon glyphicon-remove"></span>
				        </button>	
				        	
				      
				      </div>
				    </div>
				  </form>
				  
				  </div>
  	
  </div>
  <div class="col-sm-5" style="border: 0px solid red; width: auto !important; ">
	
	  <button class=" btn btn-default" id="searchword" disabled='disabled' type="button" ></button>
	<!--	<div class="alert"  style="background-color: #ccf5ff; ">
   
 </div> --> 
        </div>
  	
			 <div class="col-sm-2" style="float: right;border: 0px solid red;">
					  	<div class="pull-right">
					  		<a href="#" onclick="return refreshcontent('refresh');"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</a>
					    </div> 
				  	
				  </div>
</div>
		  <div class="box-header">
           <div class="pull-left" id="flash" style="text-align: center;"></div>      
                
                
                
                </div>
		  <div class="box" id="results">
		 <!-- /.box-header -->
           </div>
 <!-- /.box -->  
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  <!-- Model for viw and update content.... start DIV -->
					   <div class="modal fade" id="myModal" role="dialog" data-keyboard="false" data-backdrop="static">
					    <div class="modal-dialog modal-lg">
					    
					      <!-- Modal content-->
					      <div class="modal-content" id="show_detail_model_view">
					       
					      </div>
					      
					    </div>
					  </div>
<?php include_once "footer.php"; ?>
</div>
    </div><!-- ./wrapper -->
<script type="text/javascript">
$(document).ready(function() {
	 var track_load = 1; //total loaded record group(s)
     var loading  = false; //to prevents multipal ajax loads
     $("#flash").show();
     $("#flash").fadeIn(500).html('Loading <img src="img/image_process.gif" />');
	 $('#results').load("media_paging.php",
	 {'first_load':track_load},
	  function() {
	  	 	 $("#flash").hide();
	  	     track_load++;
	  	
	  	}); //load first group
   });
</script>
<script type='text/javascript'>
$(function(){
        $('#searchInput').keyup(function(){
       //$("#searchInput").('keyup', function() {
          if ($(this).val() == '') { //Check to see if there is any text entered
                //If there is no text within the input ten disable the button
                $("#submitBtn").show();  
		        $("#clearcBtn").hide();  
		        $('.enableOnInput').prop('disabled', true);
                var searchInputall = $('#searchInput').val();
                var dataString ='searchInputall='+ searchInputall;
		            $.ajax({
		            type: "POST",
		            url: "media_paging.php",
		            data: dataString,
		            cache: false,
			        success: function(result){
			           //alert(result);
			            //$("#submitBtn").hide();  
					    $("#clearcBtn").hide();
					    $("#searchword").css("display", "none");      
					    $("#results").html('');
					    $("#flash").hide();
					    $("#results").html(result);
			              }
		              });
            } else {
          	
               //If there is text in the input, then enable the button
               
                var get_string = $('#searchInput').val().length;
               
                if(get_string>=1)
                 {  
                 	$("#submitBtn").show();  
		            $("#clearcBtn").hide();   
		           
                 }
                $('.enableOnInput').prop('disabled', false);
              }
     });
     
     /* $('#searchInput').bind('keyup paste', function()
			{
			        var get_string1 = $('#searchInput').val().length;
			        if(get_string1>=1)
			        {
			          $('.enableOnInput').prop('disabled', true);
			        }
			        else 
			        {
			        	$('.enableOnInput').prop('disabled', false);
			        }
			});
	
     */
       $("#clearcBtn").hide(); 
       $("#searchword").css("display", "none");  
       $('#submitBtn').click(function(){
               var searchInputall = $('#searchInput').val();
                var dataString ='searchInputall='+ searchInputall;
                //alert(searchInputall);
		           $.ajax({
		           type: "POST",
		           url: "media_paging.php",
		            data: dataString,
		           cache: false,
		           success: function(result){
		           // alert(result);
		           	$("#submitBtn").hide();  
		           	$("#clearcBtn").show();      
		           	$("#results").html('');
		           	$("#flash").hide();
		           	$("#results").html(result);
		           	$("#searchword").css("display", "");
		           	$('#searchword').html(searchInputall);
		           }
		               });
        });
        
		  // this is for cancel button code when click in cancel button then give the blank string....
		       $('#clearcBtn').click(function(){
		               var searchInputall ='';
		                //alert(searchInputall);
		                var dataString ='searchInputall='+ searchInputall;
		                   $.ajax({
				           type: "POST",
				           url: "media_paging.php",
				           data: dataString,
				           cache: false,
				           success: function(result){
				           	$("#submitBtn").show();  
				           	$('.enableOnInput').prop('disabled', true);
				           	$("#clearcBtn").hide();      
				           	$("#results").html('');
				           	$("#flash").hide();
				           	$("#results").html(result);
				            $("#searchInput").val(''); 
				            $("#searchword").css("display", "none");  
				            $('#searchword').html(''); 
				           }
				               });
		        });
});




</script>
  </body>
</html>
