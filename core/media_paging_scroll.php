

<style type="text/css">



table.scroll tbody,
table.scroll thead { display: block;
overflow-x:hidden !important;
}

thead tr th {

    /*text-align: left;*/
}

table.scroll tbody {
    height: 300px;
    overflow-y: scroll;
    overflow-x:hidden !important;
}



tbody td, thead th {

    border-right: 1px solid black;
}

tbody td:last-child, thead th:last-child {
    border-right: none;
}
</style>

<?php session_start();   ?>

 <div class="box-header">
           <div class="pull-left" id="flash" style="text-align: center;"></div>
                </div><!-- /.box-header -->

                <form action="#" id="form" name="myform" style="border: 1px solid red; ">
                 <div class="table-responsive">
                  <table id="example1"  class="table scroll table-bordered table-striped">

                    <thead>
                      <tr>
                          <th><input type="checkbox" id="ckbCheckAll"></th>
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
                        $deleteentryID     = (isset($_POST['entryID']))? $_POST['entryID']: "";
                        if($deletecontent=="deletecontent" and $deleteentryID!='')
                         {
                              $result = $client->baseEntry->delete($deleteentryID);
                              include_once '../include/connect_db.php';
                              $delete_from_table = $mysqli->query("DELETE FROM upload_detail_by_admin where entry_id='$deleteentryID'");
                              $pageindex_when_delete     = (isset($_POST['pageindex']))? $_POST['pageindex']: "";
$pager->pageIndex=$pageindex_when_delete;
                         }
                         /***** following code doing delete end ***/
                         /***** following code doing multi delete start ***/
                        $muldeletecontent = (isset($_POST['multidelete']))? $_POST['multidelete']: "";

                        if($muldeletecontent=="multidelete")
                         {

                              $deleteentryID = (isset($_POST['entryIDs']))? $_POST['entryIDs']: "";
$deleteentryID=rtrim($deleteentryID,',');
$muldelEntryID=explode(",",$deleteentryID);
                              foreach ($muldelEntryID as $deleid) {
                                //$result = $client->baseEntry->delete($deleid);
                                //include_once '../include/connect_db.php';
                                echo $tt="DELETE FROM upload_detail_by_admin where entry_id='$deleid'";
                                //$delete_from_table = $mysqli->query("DELETE FROM upload_detail_by_admin where entry_id='$deleid'");
                              }
                              $pageindex_when_delete     = (isset($_POST['pageindex']))? $_POST['pageindex']: "";
                              $pager->pageIndex=$pageindex_when_delete;
                         }
                         /***** following code doing multi delete end ***/


                         /***** following code doing update metadata start ***/
                          $updatecontent = (isset($_POST['smetadata']))? $_POST['smetadata']: "";
if($updatecontent=="saveandclose_metadata")
                          {

                              $updateentryID     = (isset($_POST['entryid']))? $_POST['entryid']: "";
                              $updateentryName     = (isset($_POST['entryname']))? $_POST['entryname']: "";
                              $updateDesc     = (isset($_POST['entrydesc']))? $_POST['entrydesc']: "";
                              $updateTags     = (isset($_POST['entrytags']))? $_POST['entrytags']: "";
                              $updateCategoreies     = (isset($_POST['entrycategores']))? $_POST['entrycategores']: "";
                              $pageindex_when_update     = (isset($_POST['pageindex']))? $_POST['pageindex']: "";
                                    $entryId = $updateentryID;
                                    $baseEntry = new KalturaBaseEntry();
                                    $baseEntry->name = $updateentryName;
                                    $baseEntry->description = $updateDesc;
                                    $baseEntry->tags = $updateTags;
                                    $baseEntry->categoriesIds = $updateCategoreies;
                                $result = $client->baseEntry->update($entryId, $baseEntry);
$pager->pageIndex=$pageindex_when_update;
                          }
                         /***** following code doing  save and close thubnail start***/

                         $updatethumb = (isset($_POST['thumb']))? $_POST['thumb']: "";
                          if($updatethumb=="saveandclose_thumnnail")
                          {

                              $thubmentryID     = (isset($_POST['entryid']))? $_POST['entryid']: "";
                              $pageindex_when_thubm     = (isset($_POST['pageindex']))? $_POST['pageindex']: "";
$pager->pageIndex=$pageindex_when_thubm;
                          }
                         /***** ollowing code doing  save and close thubnail end ***/
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
                              $mediaType=$entry_media->mediaType;
                              $mdeitype_icon= $mediaType==1 ? "<i class='fa fa-film' aria-hidden='true'></i>" : "";
                              $mdeitype= $mediaType==1 ? "video" : "";
                              if($status==0) { $statusc="Uploading"; }
                              if($status==1) { $statusc="Converting"; }
                              if($status==2) { $statusc="Ready"; }


                        ?>
                        <tr id="<?php echo $count."_r"; ?>">
                        <td><input type="checkbox" class="checkBoxClass" name="Entrycheck[]" value="<?php echo $id; ?>"></td>
                        <td><img class="img customer-img" src="<?php echo $thumbnailUrl.$tumnail_height_width; ?>" alt="" /></td>
                        <td><?php echo $id;?></td>
                        <td><?php echo $name;?></td>
                        <td title="<?php echo $mdeitype; ?>"><?php echo $mdeitype_icon; ?></td>
                        <td><?php echo  $plays; ?></div></td>
                        <td><?php echo gmdate("d/m/y H:i", $createdAt); ?></div></td>
                        <td><?php echo gmdate("H:i", $duration);?></div></td>
                        <td><?php echo  $statusc; ?></div></td>
                        <td>
                          <div class="dropdown">
                            <a data-target="#" data-toggle="dropdown" class="dropdown-toggle">Select Action<b class="caret"></b></a>
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
                  </div>
           </form>
 <div class="dropup" >
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Bulk Actions
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
               <li>
		   	<input type="hidden" value="<?php echo $pager->pageIndex; ?>" id="pageindex">
		   	<a href="#"  id="save_value" >Delete</a>
		   </li>
		   
             <li class="dropdown-submenu">
		   	<a  href="#">Add/Remove Categories<span class="caret"></span></a>
		     <ul class="dropdown-menu"">
				<li><a href="#">Add Categories</a></li>
				<li><a href="#">Remove Categories</a></li>
		     </ul>
		   </li>
             
            </ul>
         
        </div>

 <div class="page" style="border: 0px solid red; text-align: center;">
    <?php
    $page =1; //if no page var is given, default to 1.
    $limit=$pager->pageSize;                        //next page is page + 1
    $total = ceil($total_pages/$limit);        //lastpage is = total pages / items per page, rounded up.
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


     if($pager->pageIndex!=$total){ ?> <a href="javascript:void(0)" onclick="changePagination('<?php echo $pager->pageIndex+1 ?>')">&nbsp;&nbsp;NEXT&nbsp;&nbsp;</a>
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

 // Change the selector if needed
var $table = $('table.scroll'),
    $bodyCells = $table.find('tbody tr:first').children(),
    colWidth;

// Adjust the width of thead cells when window resizes
$(window).resize(function() {
    // Get the tbody columns width array
    colWidth = $bodyCells.map(function() {
        return $(this).width();
    }).get();

    // Set the width of thead columns
    $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
    });
}).resize(); // Trigger resize handler
 </script>

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

      var dataString ='entryID='+ entryID +"&delname="+delname+"&pageindex="+pageindex;
      var a=confirm("Are you sure you want to delete the selected entry ? " + entryID +  "\nPlease note: the entry will be permanently deleted from your account");
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

$(document).ready(function(){
   $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });

   $('#save_value').click(function(){
    var finald = '';
    $('.checkBoxClass:checked').each(function(){
        var values = $(this).val();
        finald += values+',';
    });

      if(finald=='')
      { alert("You must select at least one entry"); return false;}
      else {


      var multidelete="multidelete";
      var pageindex = $('#pageindex').val();
      var dataString ='entryIDs='+ finald +"&multidelete="+multidelete+"&pageindex="+pageindex;
      //alert(dataString);
      var a=confirm("Are You sure want to delete This Entries" +finald+"\nPlease note: the entry will be permanently deleted from your account");
       if(a==true)
        {
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
       {   $("#flash").hide(); return false;  }

   }
});
});

</script>

