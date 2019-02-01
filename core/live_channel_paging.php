<?php include_once 'auth.php';  ?>
 <div class="box-header">
           <div class="pull-left" id="flash" style="text-align: center;"></div>      
                </div><!-- /.box-header -->
              
                <form action="#" id="form" name="myform" style="border: 0px solid red; ">
                  <table id="example1" class="table table-fixedheader table-bordered table-striped">
                    <thead>
                      <tr>
                       <th>Thumbnail</th>
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
                         include_once("config.php");
						  $filter = null;
				 		 $filter = new KalturaLiveStreamEntryFilter();
                       
						
						$searchTextMatch = (isset($_POST['searchInputall']))? $_POST['searchInputall']: "";
						 $filter->searchTextMatchOr = $searchTextMatch;
						 
						
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
						 
						 $result_media =$client->liveStream->listAction($filter, $pager);;
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
							  $mediaType=$entry_media->mediaType;
							  $mdeitype_icon= $mediaType==1 ? "<i class='fa fa-film' aria-hidden='true'></i>" : "";
							  $mdeitype= $mediaType==1 ? "video" : "";
							  if($status==0) { $statusc="Uploading"; }
							  if($status==1) { $statusc="Converting"; }
							  if($status==2) { $statusc="Ready"; }
							  
							 
						?>
					    <tr id="<?php echo $count."_r"; ?>">
						<td><img class="img-responsive customer-img"  src="<?php echo $thumbnailUrl.$tumnail_height_width; ?>" alt="" /></td>
                        <td><?php echo $id;?></td>
                        <td><?php echo $name;?></td>
                        <td title="<?php echo $mdeitype; ?>"><?php echo $mdeitype_icon; ?></td>
                        <td><?php echo  $plays; ?></td>
                        <td><?php echo gmdate("d/m/y H:i", $createdAt); ?></td>
                        <td><?php echo gmdate("H:i", $duration);?></td>
                        <td><?php echo  $statusc; ?></td>
                        <td>
						  <div class="dropdown">
						    <a data-target="#"  data-toggle="dropdown" class="dropdown-toggle">Select Action<b class="caret"></b></a>
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
	   url: "view_details_channel_content.php",
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
           url: "live_channel_paging.php",
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
  
      var dataString ='entryID='+ entryID +"&delname="+delname+"&pageindex="+pageindex;
      var a=confirm("Are you sure you want to delete the selected entry ? " +entryID+  "\nPlease note: the entry will be permanently deleted from your account");
	     if(a==true)
	     {
	     	$("#flash").show();
            $("#flash").fadeIn(800).html('Loading <img src="img/image_process.gif" />');
	        $.ajax({
	           type: "POST",
	           url: "live_channel_paging.php",
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
