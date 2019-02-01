<?php
include_once 'auth.php';
include_once("config.php");
//if(isset($_GET['id']))
$Entryid=$_REQUEST['Entryid'];
$getpageindex=$_REQUEST['pageindex'];
$entryId = $Entryid;
$version = null;
$result = $client->baseEntry->get($entryId, $version);
//print '<pre>'.print_r($result, true).'</pre>';
$name=$result->name; $description=$result->description;$tags=$result->tags;
$categoriesIds=$result->categoriesIds;
$Creator=$result->creatorId;  $createdAt=$result->createdAt;
$plays=$result->plays; $duration=$result->duration ;
$mediaType=$result->mediaType;   
$mdeitype= $mediaType==1 ? "video" : "";
$moderationStatus=$result->moderationStatus;
$moderationStatus_main= $moderationStatus==6 ? "Auto approved" : "";
?>

<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="js/bootstrap-multiselect.css" type="text/css"/>
<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Entry - <?php echo $name; ?></h4>
         </div>
        <div class="modal-body" >
        <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#a" data-toggle="tab">Metadata</a></li>
          <li ><a href="#b" data-toggle="tab">Thumbnail</a></li>
          <li><a href="#c" data-toggle="tab">Access Control</a></li>
          
        </ul>
       
       
        <div class="tab-content">
         <div class="tab-pane active" id="a">
          <div class="row" style="border: 0px solid red; margin-top: 5px;">
          <div class="pull-left" style="border: 0px solid green; width: 50%; margin-left: 10px;">
          <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">Title :</label>
            <div class="col-xs-10">
                 <input type="text" class="form-control" id="entryname" placeholder="Entry Name" value="<?php echo htmlentities($name); ?>">
            </div>
        </div>
       
         <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Description:</label>
            <div class="col-xs-10">
            <textarea class="form-control" rows="3" id="entrydescription" name="entrydescription" placeholder="Description" ><?php echo $description; ?></textarea>
            </div>
        </div>
         <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Tags:</label>
            <div class="col-xs-10">
               <input type="text" class="form-control" id="entrytags" name="entrytags" value="<?php echo $tags; ?>"  placeholder="Enter tags :eg red,green,blue" />
              <!-- <input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput"  />-->
            </div>
        </div>
         <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Categories:</label>
            <div class="col-xs-10">
             <?php 
            
              $filter = null;
              $pager = null;
              $res = $client->category->listAction($filter, $pager);
			 

              ?>
				<select id="example-getting-started" multiple="multiple" >
				  <?php 
					   foreach ($res->objects as $ennn) { 
						      $parentId=$ennn->parentId;
				              if(($parentId)==0)
			                   {
				                    $names=$ennn->name;
									$categoriesIdsdlist = explode(',',$categoriesIds);
	                                if (in_array($ennn->id, $categoriesIdsdlist)) {
									  $selected="selected"; 
									} else {
									  $selected="";
									}
					 	?>
					  <option <?php echo $selected;  ?> value="<?php echo $ennn->id; ?>"><?php echo ucwords(($names)); ?></option>
					 <!-- <option  <?php echo $selected; ?> value="<?php echo $ennn->id; ?>"><?php echo ucwords(($names))."---".$ennn->id."----".$selected; ?></option>-->
					
					<?php }
						 } ?>
					</select>
            </div>
        </div>
       
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
            	<button type="button" class="btn btn-primary" data-dismiss="modal" name="submit"  id="myFormSubmit" onclick="save_metedata_in_server('saveandclose_metadata','<?php echo $Entryid; ?>','<?php echo $getpageindex;  ?>');" >Save & Close</button>
               <!-- <button type="button" class="btn btn-primary" name="submit"  id="myFormSubmit" onclick="save_detail_in_server();" >Save</button> -->
            </div>
        </div>
    </form>
           
          </div>
          <div class="pull-right" style="border: 0px solid black; width: 45%; margin-right: 10px;">
           
          
           <iframe bordercolor="white" frameborder="0" src="play_preview.php?Entryid=<?php echo $Entryid; ?>" width="100%" height="240"> </iframe>
           <p> <strong>Creator </strong>  : <?php echo $Creator; ?></p>
              <p><strong>Created on :</strong> <?php echo gmdate("d/m/y", $createdAt); ?></p>
            <hr/>
            <p><strong>Type : </strong>  <?php echo $mdeitype; ?>     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Duration : </strong><?php echo gmdate("H:i:s", $duration); ?></p> 
            <p><strong>Moderation : </strong><?php echo $moderationStatus_main; ?>      </p> 
            <p><strong>Plays : </strong><?php echo $plays; ?>      </p>  
          </div>	
 
 </div>	
         </div>
       
<div class="tab-pane" id="b">
	<hr/>
 <form action="" method="post" enctype="multipart/form-data" id="uploadForm">
            <div class="form-inline">
              <div class="form-group">
                 <input type="file" class="inputFile" name="userImage" placeholder="select a File" id="image" onChange="validate_image(this.value)" required> 
                <input name="enteryID" value="<?php echo $Entryid; ?>" type="hidden" class="inputFile" />
              </div>
              <button type="submit" class="btn btn-sm btn-primary btnSubmit" id="js-upload-submit">Upload files</button>
            </div>
          </form>

<div id="flash_thumbnail"></div>                        	
<hr/>	
<div id="result_thumbnail" style="border: 0px solid red;">
</div>
<button type="button" class="btn btn-primary" data-dismiss="modal" name="submit"  id="myFormSubmit" onclick="save_thumbnail('saveandclose_thumnnail','<?php echo $Entryid; ?>','<?php echo $getpageindex;  ?>');" >Save & Close</button>
</div>
         <div class="tab-pane" id="c"> Access Control... Work in progress</div>
        </div>
      </div>  
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
 
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
   
function save_metedata_in_server(smatadata,entryid,pageindex){
    var entryname = $('#entryname').val();	
    var entrydesc = $('#entrydescription').val();	
    var entrytags = $('#entrytags').val();	
    var entrycategores = $('#example-getting-started').val();
    var dataString ='smetadata='+smatadata+'&entryid='+entryid+'&entryname='+entryname+'&entrydesc='+entrydesc+'&entrytags='+entrytags+'&entrycategores='+entrycategores+'&pageindex='+pageindex;
    $.ajax({
           type: "POST",
           url: "media_paging.php",
           data: dataString,
           cache: false,
           success: function(result){
             //alert(result);
             // $("#results").html('');
              //	 $("#flash").hide();
           	 $("#results").html(result);
           }
    });   
}

function save_thumbnail(thumb,entryid,pageindex){
    var dataString ='thumb='+thumb+'&entryid='+entryid+'&pageindex='+pageindex;
    //alert(dataString)
     //$("#result").html();
    $.ajax({
           type: "POST",
           url: "media_paging.php",
           data: dataString,
           cache: false,
           success: function(result){
             //alert(result);
             // $("#results").html('');
              //	 $("#flash").hide();
           	 $("#results").html(result);
           }
    });   
}

$(document).ready(function() {
	 var track_load = 1; //total loaded record group(s)
     var loading  = false; //to prevents multipal ajax loads
     $("#flash_thumbnail").show();
     $("#flash_thumbnail").fadeIn(500).html('Loading <img src="img/image_process.gif" />');
     var enteryidd = "<?php echo $Entryid; ?>";
	 $('#result_thumbnail').load("thumbnail.php",
	 {'first_load':track_load,'entryid':enteryidd},
	  function() {
	  	 	 $("#flash_thumbnail").hide();
	  	     track_load++;
	  	
	  	}); //load first group
   });    
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "upload_image.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			     if(data==1) 
			     {
			     	   //alert("yese");
			     	   //$('#result_thumbnail').load("thumbnail.php");
			     	   var enteryidd = "<?php echo $Entryid; ?>";
			     	   $('#result_thumbnail').load("thumbnail.php",{'entryid':enteryidd}); //load first group
			     }
			     else {  $("#result_thumbnail").html(data);}
			     //$("#targetLayer").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
</script>
<script type="text/javascript"> 
 function thumbnail(action,thumbID){
     var enteryidd = "<?php echo $Entryid; ?>";
     var dataString ='action_thumb='+ action+'&thumbID='+thumbID+'&entryid='+enteryidd;
     if(action=="setdefault")
     { var msg="Are Sure want to set this Thumbnail Default?";}
     if(action=="remove")
     { var msg="Are you sure you want to delete selected thumbnail?";}
    
     var a=confirm(msg)
     if(a==true)
     { 
     //$("#result").html();
      $.ajax({
           type: "POST",
           url: "thumbnail.php",
           data: dataString,
           cache: false,
           success: function(result){
             //alert(result);
           	 $("#result_thumbnail").html('');
           	// $("#flash").hide();
           	 $("#result_thumbnail").html(result);
           }
      });
      
     }
     else
     {  return false;  }
      
}

function changePagination_thumbnail(pageid){
     //$("#flash").show();
     //$("#flash").fadeIn(800).html('Loading <img src="img/image_process.gif" />');
      var enteryidd = "<?php echo $Entryid; ?>";
     var dataString ='first_load='+ pageid+'&entryid='+enteryidd;
     //$("#result").html();
     $.ajax({
           type: "POST",
           url: "thumbnail.php",
           data: dataString,
           cache: false,
           success: function(result){
          //  alert(result);
           	 $("#result_thumbnail").html('');
           	 //$("#flash").hide();
           	 $("#result_thumbnail").html(result);
           }
      });
}
function validate_image(file) {
    var ext = file.split(".");
    ext = ext[ext.length-1].toLowerCase();
    var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];
    if (arrayExtensions.lastIndexOf(ext) == -1) {
        alert("Only formats are allowed : "+arrayExtensions.join(', '));
        $("#image").val("");
    }
}

$(document).ready(function() {
	 $("#video_loading").fadeIn(500).html('Loading <img src="img/image_process.gif" />');
});	
</script>                       	
  