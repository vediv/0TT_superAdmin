<?php
include_once 'authm.php';
ob_start();
//include_once 'functionm.inc.php';
$page =(isset($_REQUEST['page']))? $_REQUEST['page']: 0;
$searchInput =(isset($_REQUEST['searchInput']))? $_REQUEST['searchInput']: '';
$gernelMSG=(isset($_REQUEST['RemovePublisher']))? $_REQUEST['RemovePublisher']: '';
$smsg=(isset($_REQUEST['msg']))? $_REQUEST['msg']: '';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php include_once 'pagenamem.php';?>
 <title><?php echo PROJECT_TITLE."- Publisher List";?></title>
<script src="js/commanJS.js" type="text/javascript"></script>
<link href="css/pagingCss.css" rel="stylesheet" type="text/css" />
<style>
.dropdown-submenu {
    position: relative;
}
.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}
.dropdown-submenu>.dropdown-menu {
    left: -110% !important;
    //margin-top: -10px;
    top: 0;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}
</style>
</head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
      <?php include_once 'leftmenu.php';?>
      <div class="content-wrapper">
        <section class="content-header">
       <h1>Publisher List
       <a href="add_publisher.php" class="addnew"  title="Add New Publisher" ><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>
       </h1>
          <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Publisher accounts</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
          <div class="col-xs-12">
          <div class="box">
         <div class="box-header">
          <div class="col-sm-12" style="border: 0px solid red;">
  	 <div class="pull-right">
      <form class="navbar-form" role="search" method="get">
        <div class="input-group add-on">
         <input class="form-control" title="Search" size="40" placeholder="Search Name or partnerid or email"
         autocomplete="off" name='searchInput' id='searchInput' class="searchInput" type="text" value="<?php echo htmlentities($searchInput); ?>">
         <div class="input-group-btn">
            <button type="submit" class="enableOnInput btn btn-default"  id='submitBtn'><i class="glyphicon glyphicon-search"></i></button>
            </div>

        </div>
       </form>
        </div>

  </div>
          </div>
              <div style="text-align: center;" id="smsg"></div>
<div class=" ">

<div class="box-body">
<table id="datatable" class="table table-bordered table-striped">
<thead>
    <tr>
      <th>ID</th>
      <th>Status</th>
      <th>Parter ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Service URL</th>
      <th>Host Name</th>
      <th title="DataBase Name">DB Name</th>
      <!--<th>Creation Date</th>-->
     <th>Actions</th>
    </tr>
</thead>
<tbody>
<?php
$searchQuery=''; $searchURL='';
if(!empty($searchInput))
{  $searchInput;
   $searchQuery=" AND name LIKE '%$searchInput%' OR email LIKE '%$searchInput%' OR partner_id LIKE '%$searchInput%' ";
   $searchURL="&searchInput=$searchInput";
}
$adjacents = 3;
$targetpage="puserlist.php";
$query = "SELECT COUNT(*) AS num FROM publisher where acess_level='p'  $searchQuery ";
	$totalpages =db_select($query);
        $total_pages = $totalpages[0]['num'];
	$limit = 8;
	if($page)
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;

$sql="SELECT * FROM publisher where acess_level='p' $searchQuery order by par_id DESC LIMIT $start, $limit";
$result = db_query($sql);
$countRow=  db_totalRow($sql);
/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;
	$pagination = "";
	if($lastpage > 1)
	{
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1)
			$pagination.= "<a href=\"$targetpage?page=$prev$searchURL\"><i class='fa fa-long-arrow-left' aria-hidden='true' style='padding-right:5px'></i>Previous</a>";

		else
			$pagination.= "<span class=\"disabled\"> <i class='fa fa-long-arrow-left' aria-hidden='true' style='padding-right:5px'></i>Previous</span>";
		//pages
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				?>
			<?php 	if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter$searchURL\">$counter</a>";
				    //$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$counter.'\')">'.$counter.'</a>';

			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$searchURL\">$counter</a>";
					    //$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$counter.'\')">'.$counter.'</a>';
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1$searchURL\">$lpm1</a>";
				//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$lpm1.'\')">'.$lpm1.'</a>';

				$pagination.= "<a href=\"$targetpage?page=$lastpage$searchURL\">$lastpage</a>";
				//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$lastpage.'\')">'.$lastpage.'</a>';
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1$searchURL\">1</a>";
				//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\'1\')">1</a>';
				$pagination.= "<a href=\"$targetpage?page=2$searchURL\">2</a>";
				//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\'2\')">2</a>';
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
					$pagination.= "<a href=\"$targetpage?page=$counter$searchURL\">$counter</a>";
					//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$counter.'\')">'.$counter.'</a>';
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1$searchURL\">$lpm1</a>";
				//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$lpm1.'\')">'.$lpm1.'</a>';
				$pagination.= "<a href=\"$targetpage?page=$lastpage$searchURL\">$lastpage</a>";
				//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$lastpage.'\')">'.$lastpage.'</a>';
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1$searchURL\">1</a>";
				//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\'1\')">1</a>';
				$pagination.= "<a href=\"$targetpage?page=2$searchURL\">2</a>";
				//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\'2\')">2</a>';
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter$searchURL\">$counter</a>";
						//$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$counter.'\')">'.$counter.'</a>';
				}
			}
		}
		//next button
		if ($page < $counter - 1)
			$pagination.= "<a href=\"$targetpage?page=$next$searchURL\">Next<i class='fa fa-long-arrow-right' aria-hidden='true' style='padding-left:5px'></i> </a>";
		else
			$pagination.= "<span class=\"disabled\">Next <i class='fa fa-long-arrow-right' aria-hidden='true'></i> </span>";
		$pagination.= "</div>\n";
	}
?>
<?php
//value come from notification
$rr= db_select($sql);
//$num=db_totalRow($q);
$i=1;
foreach($rr as $fetch )
 {
          $id=$fetch['par_id']; $parter_id=$fetch['partner_id']; $name=$fetch['name'];  $email=$fetch['email'];
	  $pstatus=$fetch['pstatus']; $admin_secret=$fetch['admin_secret'];
	  $service_url=$fetch['service_url'];  $created_at=$fetch['created_at'];
	  $dbName=$fetch['dbName'];$dbHostName=$fetch['dbHostName']; $publisherUniqueID=$fetch['publisherID'];
            $password=$fetch['publisher_pass'];
 ?>
    <tr>
       <td><a href="#" class="myBtn" ppid="<?php echo $id ;?>"><?php echo $publisherUniqueID ;?></a></td>
       <!-- <td><?php echo $publisherUniqueID ;?></td>-->
        <td><?php echo ($pstatus==1  ? "Active" : "Deactive" ) ;?></td>
        <td><?php echo $parter_id ;?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $service_url; ?></td>
        <td><?php echo $dbHostName; ?></td>
        <td><?php echo $dbName; ?></td>
       <!-- <td><?php echo $created_at; ?></td>-->
          <td>
<div class="btn-group ">
<a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" role="button">Action <span class="caret"></span></a>
<ul class="dropdown-menu" style="border:0px red solid; margin: 0 0 0 -8px !important">
   <li>
       <!--<a href="http://publisher.planetcast.in/index.php?PubID=<?php echo $parter_id; ?>&pid=<?php echo $id; ?>&email=<?php echo $email; ?>" target="_blank">
      <i class="glyphicon glyphicon-th-list"></i>Manage</a>-->


       <a href="../cms1.3/index.php?PubID=<?php echo $parter_id; ?>&pid=<?php echo $id; ?>&email=<?php echo $email; ?>" id="editOrderModalBtn" target="_blank">
        <i class="glyphicon glyphicon-th-list"></i>Manage</a>

   </li>
   <li>
       <a href="add_menu.php?next=<?php echo $id; ?>&email=<?php echo $email; ?>" type="button">
       <i class="glyphicon glyphicon-plus"></i>Add Menu</a>
   </li>
   <!--<li>
      <a href="edit_menu.php?next=<?php echo $id; ?>&email=<?php echo $email; ?>" type="button">
      <i class="glyphicon glyphicon-edit"></i>Edit Menu </a>
   </li>-->
    <li>
        <a href="menuPermission.php?next=<?php echo $id; ?>&email=<?php echo $email; ?>"   title="Nenu Permissions" type="button">
      <i class="glyphicon glyphicon-edit"></i>Menu Permissions </a>
   </li>
    <li>
        <a href="dashboardPermission.php?next=<?php echo $id; ?>&email=<?php echo $email; ?>" title="Dashboard Permissions" type="button">
      <i class="glyphicon glyphicon-edit"></i>Cms Permissions </a>
   </li>
    <li>
      <!--<a href="resetPass.php?next=<?php echo $id; ?>&email=<?php echo $email; ?>&page=<?php echo $page; ?>" type="button">-->
      <a href="javascript:void(0)" type="button" class="myBtnn" onclick="resetPass('<?php echo $id; ?>','<?php echo $email; ?>','<?php echo $page; ?>')"    title="Reset Password" class="result">
      <i class="glyphicon glyphicon-lock"></i>Reset Pass</a>
   </li>
    <li>
      <a href="javascript:void(0)" type="button" class="myBtnn" onclick="ViewUsers('<?php echo $id; ?>','<?php echo $parter_id; ?>','<?php echo $publisherUniqueID; ?>')"    title="User list" class="result">
      <i class="glyphicon glyphicon-user"></i>User List</a>&nbsp;&nbsp;&nbsp;
   </li>

</ul>
</div>

</td>

</tr>
<?php } ?>
 </tbody>
</table>
</div>
   <div style="border: 0px solid red;margin-top: 5px; min-height: 40px;">
    <div style="border: 0px solid red; float: left; margin-top: 10px; margin-left: 10px;">
<?php if($start==0) { $startShow=1;
       $lmt=$limit<$total_pages ? $limit  :$total_pages;
       }
      else { $startShow=$start+1;  $lmt=$start+$countRow;  }
 ?>
Showing <?php echo $startShow; ?>  to <?php echo $lmt; ?>   of <?php echo $total_pages; ?> entries</strong></div>
    <div style="border: 0px solid red; float: right;"><?php echo $pagination;?></div>
</div>
 </div>
<br/>
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

<div class="modal fade" id="myModal" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
    <div class="modal-content" id="show_detail_model_view"></div>
    </div>
</div>

<div class="modal fade" id="myModal_reset_password" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
    <div class="modal-content" id="show_reset_password_view"></div>
    </div>
</div>
<div class="modal fade" id="myModal_all" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
    <div class="modal-content" id="show_modal_data"></div>
    </div>
</div>

<script type="text/javascript">
function manage_publisher(par_id) {
        document.getElementById("my_form"+par_id).submit();
    }
function removePublisher(PubID,pageNumber,action)
{

if(confirm("Are you sure you want to delete this?"))
{
     $.ajax({
            url: "operation.php",
            data:'publisID='+PubID+'&pageNumber='+pageNumber+'&action='+action,
            type: "POST",
            success:function(res){
               if(res==1)
               {
                 window.location.href="puserlist.php?msg=RemovePublisher";
               }
             },
             error:function (){}
	             });
     }
     return false;
}

</script>
<script type="text/javascript">
  /* this is for model JS with edit and view detail */
     $(document).ready(function(){
	    $(".myBtn").click(function(){
        $("#myModal").modal();
		var element = $(this);
		var user_id = element.attr("ppid");
		var info = 'user_id=' + user_id;
        // alert(info);
        $.ajax({
	    type: "POST",
	    url: "viewPublisher.php",
	    data: info,
        success: function(result){
        $('#show_detail_model_view').html(result);
        return false;
        }

        });
     return false;
    });

});


function resetPass(pub_id,pemail,pageindex)
{
     $("#myModal_reset_password").modal();
     //$("#flash").fadeIn(500).html('Loading <img src="img/image_process.gif" />');
      var info = 'action=reasetPass&pub_id='+pub_id+'&pemail='+pemail+'&pageindex='+pageindex;
        $.ajax({
	    type: "POST",
	    url: "commonModal.php",
	    data: info,
             success: function(result){
            // $("#flash").hide();
             $('#show_reset_password_view').html(result);
            return false;
        }

        });
     return false;
}

function ViewUsers(pub_id,partnerid,publisherUniqueID)
{
     $("#myModal_all").modal();
     //$("#flash").fadeIn(500).html('Loading <img src="img/image_process.gif" />');
      var info = 'action=viewUsers&pub_id='+pub_id+'&partnerid='+partnerid+'&publisherUniqueID='+publisherUniqueID;
        $.ajax({
	    type: "POST",
	    url: "commonModal.php",
	    data: info,
             success: function(result){
            // $("#flash").hide();
             $('#show_modal_data').html(result);
            return false;
        }

        });
     return false;
}

        </script>
  </body>
</html>
