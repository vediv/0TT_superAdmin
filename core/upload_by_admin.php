<?php
include_once 'auth.php';
?>
<link rel="stylesheet" href="upload_css/jquery.fileupload.css">
<link rel="stylesheet" href="upload_css/jquery.fileupload-ui.css">
<!--<script src="js/jquery.blockUI.js"></script>-->    
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value=""></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Select files...</span>
                    <input type="file" name="files">
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
            
           
        </div>
        <div id="result_div"></div> 
        <div class="flash"></div>  
        <!-- The
        	 table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped" id="ajax_div"><tbody class="files"></tbody></table>
        </form>
    <br>
  <!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<div>
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td style="border: 0px solid red;">
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
                <br/>  <br/> 
                
        
        <form class="form-horizontal" method="post">
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-2">Title :</label>
            <div class="col-xs-10">
            	
            <?php 
           // http://localhost/MyCloud_TV/MycloudTV-server/server/php/files/Demo_upload.mp4
               $userID_upload=$_SESSION['dasbord_user_name']; $userID=$_SESSION['dasbord_user_id'];
               $target_path = $_SERVER['DOCUMENT_ROOT'] . "/admin-mycloud/core/server/php/files/$userID/"; ?>
            	
            	<input type="text" size="50" class="form-control" id="userid" value="<?php echo $userID_upload; ?>">
            	<input type="text" size="50" class="form-control" id="file_send_url" value="<?php echo $target_path; ?>{%=file.name%}">
                <input type="text" class="form-control" id="inputTitle" placeholder="Title" value="{%=file.name%}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Tags:</label>
            <div class="col-xs-10">
               <input type="text" class="form-control" id="tokenfield" name="mytags"  placeholder="Enter tags :eg red,green,blue" />
              <!-- <input type="text" value="Amsterdam,Washington,Sydney,Beijing,Cairo" data-role="tagsinput"  />-->
            </div>
        </div>
         <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Description:</label>
            <div class="col-xs-10">
            <textarea class="form-control" rows="3" id="description" name="mydescription" placeholder="Description" ></textarea>
            </div>
        </div>
         <div class="form-group">
            <label for="inputPassword" class="control-label col-xs-2">Categories:</label>
            <div class="col-xs-10">
             <?php 
             include_once("config.php");
             $filter = null;
             $pager = null;
             $res = $client->category->listAction($filter, $pager);
              ?>
					 <select class="selectpicker form-control" id="categoryid">
					 	<?php 
					 	 foreach ($res->objects as $ennn) { 
						           $parentId=$ennn->parentId;
				                   if(($parentId)==0)
			                       	{
					                    $names=$ennn->name;
					 	?>
					  <option value="<?php echo $ennn->id; ?>"><?php echo ucwords(($names)); ?></option>
					<?php }
						 } ?>
					</select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="button" class="btn btn-primary" name="submit" value="Submit" id="myFormSubmit" onclick="save_detail_in_server();" >Save</button>
             <!--<button  type="button" name="submit" value="Submit" id="myFormSubmit" class="btn btn-primary" >Submit</button> -->
            </div>
        </div>
    </form>
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
</div>
<?php //include_once 'footer.php'; ?>   
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="upload_js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="upload_js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="upload_js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="upload_js/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="upload_js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="upload_js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="upload_js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="upload_js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="upload_js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="upload_js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="upload_js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="upload_js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="upload_js/main.js"></script>
<script type="text/javascript">
function save_detail_in_server(){
        var upload_url = $('#file_send_url').val();
		var inputTitle = $('#inputTitle').val();
		var mytags = $('#tokenfield').val();
		var descrip = $('#description').val();
		var categoryid = $('#categoryid').val();
		var userid = $('#userid').val();
		var displaystr='Saving.......';
        //$('.template-download').html('');
       // $.blockUI({ message: '<h3><img src="images/image_process.gif"/>'+displaystr+'</h3>' });
       $(".flash").show();
       $(".flash").fadeIn(400).html(' Saving <img src="img/image_process.gif" />');
		$.post('save_upload_in_serverby_admin.php', {upload_url: upload_url, inputTitle: inputTitle,mytags:mytags,descrip:descrip,categoryid:categoryid,userid:userid},
		function(result){ 
		           	//alert(result);
	           if(result==1){
		         $(".flash").hide(); 
		         window.location.href='media_content.php';
					}
					if(result==2)
					{
					  $(".flash").hide(); 
					  $('.template-download').html('');
					  $('#result_div').html('Something wrong in server please try some time.');
					  $('#ajax_div').html();
                      //$.unblockUI();
					}
    });
    return false;      // required to not open the page when form is submited
}
</script>
    <!-- /.container -->
    <!-- jQuery -->
</body>
</html>
