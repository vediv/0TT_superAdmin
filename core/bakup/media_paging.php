<?php session_start();   ?>
 <div class="box-header">
           <div class="pull-left" id="flash" style="text-align: center;"></div>      
                </div><!-- /.box-header -->
              
                <form action="#" id="form" name="myform" style="border: 0px solid red; ">
                  <table id="example1" class="table table-fixedheader table-bordered table-striped">
                    <thead>
                      <tr>
                       <th >Thumbnail</th>
                       <th>ID</th>
                         <th>Name</th>
                          <th>Type</th>
                          <th>Plays</th>
                           <th>Created On</th>
                            <th>Duration</th>
                             <th>Status</th>
                             <th>Action</th>
                       
                      </tr>                    </thead>
                    <tbody >
                    	
                 <?php
                         include_once("../config.php");
				 		 $filter = null;
						 $filter = new KalturaMediaEntryFilter();
						 $searchTextMatch = (isset($_POST['searchInputall']))? $_POST['searchInputall']: "";
						
						 $filter->searchTextMatchOr = $searchTextMatch;
						 $filter->orderBy = "-createdAt";
					     $filter->statusIn = '0,1,2';
						 $filter->typeEqual = KalturaEntryType::MEDIA_CLIP;
						 $pager = new KalturaFilterPager();
						 $pager->pageSize = 7;
						 $get_refresh = (isset($_POST['refresh']))? $_POST['refresh']: "";
						  if($get_refresh=='refresh'){
							   $pager->pageIndex =$_SESSION['sess_for_ref'];
						    }
						   else {
						          unset($_SESSION['sess_for_ref']);
						    }
						   if(!empty($_SESSION['sess_for_ref']))
						   {
						   	    $pager->pageIndex =(isset($_POST['first_load']))? $_POST['first_load']: 1;
								$pager->pageIndex=$_SESSION['sess_for_ref'];
						   }
                           else
						   	{
						   		$pager->pageIndex = (isset($_POST['first_load']))? $_POST['first_load']: 1;
								$_SESSION['sess_for_ref']=$pager->pageIndex;
						   	}
							
						/***** following code doing delete start ***/
					    $deletecontent = (isset($_POST['delname']))? $_POST['delname']: "";
						$deleteentryID	 = (isset($_POST['entryID']))? $_POST['entryID']: "";
						if($deletecontent=="deletecontent" and $deleteentryID!='')
						 {
						      $result = $client->baseEntry->delete($deleteentryID);
						      include_once '../include/connect_db.php';
						      $delete_from_table = $mysqli->query("DELETE FROM upload_detail_by_admin where entry_id='$deleteentryID'");
						      $pageindex_when_delete	 = (isset($_POST['pageindex']))? $_POST['pageindex']: "";
							  $pager->pageIndex=$pageindex_when_delete;
						 }
						 /***** following code doing delete end ***/
						 
						 /***** following code doing update metadata start ***/
						  $updatecontent = (isset($_POST['smetadata']))? $_POST['smetadata']: "";
						  if($updatecontent=="saveandclose_metadata")
						  {
						     
						      $updateentryID	 = (isset($_POST['entryid']))? $_POST['entryid']: "";
							  $updateentryName	 = (isset($_POST['entryname']))? $_POST['entryname']: "";
							  $updateDesc	 = (isset($_POST['entrydesc']))? $_POST['entrydesc']: "";
							  $updateTags	 = (isset($_POST['entrytags']))? $_POST['entrytags']: "";
							  $updateCategoreies	 = (isset($_POST['entrycategores']))? $_POST['entrycategores']: "";
							  $pageindex_when_update	 = (isset($_POST['pageindex']))? $_POST['pageindex']: "";
							        $entryId = $updateentryID;
							        $baseEntry = new KalturaBaseEntry();
									$baseEntry->name = $updateentryName;
									$baseEntry->description = $updateDesc;
									$baseEntry->tags = $updateTags;
									$baseEntry->categoriesIds = $updateCategoreies;
								$result = $client->baseEntry->update($entryId, $baseEntry);
								$pager->pageIndex=$pageindex_when_update; 
						  }	
						 /***** following code doing update metadata End ***/							 
						 
						 $result_media = $client->baseEntry->listAction($filter, $pager);
						 $total_pages=$result_media->totalCount;
						 $count=1;
						  foreach($result_media->objects as $entry_media) {
                              $id=$entry_media->id ;	
				              $name=$entry_media->name ;
							  $tumnail_height_width="/width/80/height/60";
							  $thumbnailUrl=$entry_media->thumbnailUrl ;
							  $plays=$entry_media->plays ;	
                              $duration=$entry_media->duration ;
							  $createdAt=$entry_media->createdAt ;
							  $status=$entry_media->status;
							  if($status==0) { $statusc="Uploading"; }
							  if($status==1) { $statusc="Converting"; }
							  if($status==2) { $statusc="Ready"; }
							 
						?>
					    <tr id="<?php echo $count."_r"; ?>">
						<td><img class="img-responsive customer-img"  src="<?php echo $thumbnailUrl.$tumnail_height_width; ?>" alt="" /></td>
                        <td><?php echo $id;?></td>
                        <td><?php echo $name;?></td>
                        <td><?php //echo $img_status1; ?></td>
                        <td><?php echo  $plays; ?></td>
                        <td><?php echo gmdate("d/m/y H:i", $createdAt); ?></td>
                        <td><?php echo gmdate("H:i", $duration);?></td>
                        <td><?php echo  $statusc; ?></td>
                        <td>
						  <div class="dropdown">
						    <a data-target="#" href="page.html" data-toggle="dropdown" class="dropdown-toggle">Select Action<b class="caret"></b></a>
						    <ul class="dropdown-menu">
						        <li><a href="#" onclick="return deleteContent('<?php echo $id; ?>','deletecontent','<?php echo $pager->pageIndex; ?>')">Delete</a></li>
						        
                                        						        
						        <li><a href="#" class="myBtn" pageindex="<?php echo $pager->pageIndex; ?>" id="<?php echo $id; ?>">View Detail</a></li>
						    </ul>   
						</div>
                        	
                        </td>
                          
                    </tr>   
            <?php $count++;
             }?>         
                    </tbody>
                   </table>
           </form>         
 
 <div class="page" style="border: 0px solid red; text-align: center;">
    <?php
    $page =1; //if no page var is given, default to 1.
	$limit=$pager->pageSize;						//next page is page + 1
	$total = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
    if($pager->pageIndex > 1)
	 { ?>
	<a  href="javascript:void(0)" onclick="changePagination('<?php echo $pager->pageIndex-1 ?>')">&nbsp;&nbsp;PREVIOUS &nbsp;&nbsp; </a>
	<?php }	
    while($page)
    {
        if($page == $pager->pageIndex)
		{ echo $page.' '; }
        else {  ?> <a  href="javascript:void(0)" onclick="changePagination('<?php echo $page ?>')"><?php echo $page ?></a>
	   <?php } 
        if($page*$pager->pageSize > $result_media->totalCount)
            break;
        $page++;
    }
	 
	 
	 if($pager->pageIndex!=$total){ ?> <a  href="javascript:void(0)" onclick="changePagination('<?php echo $pager->pageIndex+1 ?>')">&nbsp;&nbsp;NEXT&nbsp;&nbsp;</a>
     <?php 
       }
	 if($pager->pageIndex*$pager->pageSize <= $result_media->totalCount)
	    { echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='black'>". $pager->pageIndex*$pager->pageSize." of ".$total_pages."</font>";}
	 else 
	 	{ echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='black'>". $total_pages." of ".$total_pages."</font>";}
    ?>
			      <!--  <div class="pull-right" style="border: 0px solid green; ">
			        Show Rows:<select id="">
			        <option>1</option>
			        <option>2</option>
			        <option>3</option>
			        <option>4</option>
			        </select>
			      </div>-->
			   
 </div>
   </div>
 
 
<script type="text/javascript">
/* thsi is for model JS with edit and view detail */
$(document).ready(function(){
    $(".myBtn").click(function(){
        $("#myModal").modal();
		var element = $(this);
		var Entryid = element.attr("id");
		var EntryPageindex = element.attr("pageindex");
	    var info = 'Entryid=' + Entryid+"&pageindex="+EntryPageindex; 
        //alert(info);
       $.ajax({
	   type: "POST",
	   url: "view_edit_model.php",
	   data: info,
       success: function(result){
       //alert(result);
       $('#show_detail_model_view').html(result);
       //$("#LegalModal").modal('show');
        //return false;
          }
 
        });
     return false;    
    });
});

function changePagination(pageid){
     $("#flash").show();
     $("#flash").fadeIn(800).html('Loading <img src="img/image_process.gif" />');
     var dataString ='first_load='+ pageid;
     //$("#result").html();
     $.ajax({
           type: "POST",
           url: "media_paging.php",
           data: dataString,
           cache: false,
           success: function(result){
          //  alert(result);
           	 $("#results").html('');
           	 $("#flash").hide();
           	 $("#results").html(result);
           }
      });
}
function deleteContent(entryID,delname,pageindex){
   // alert(pageid);
     var dataString ='entryID='+ entryID +"&delname="+delname+"&pageindex="+pageindex;
     //$("#result").html();
     var a=confirm("Are you sure you want to delete the selected entry ? " +entryID+  "\nPlease note: the entry will be permanently deleted from your account");
	     if(a==true)
	     {
	     	$("#flash").show();
            $("#flash").fadeIn(800).html('Loading <img src="img/image_process.gif" />');
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
	     else
	     {
	     	 $("#flash").hide();
	     	 return false;
	     }
}
</script>
