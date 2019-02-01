<?php 
include_once 'authm.php';
ob_start(); 
//include_once 'functionm.inc.php';

$page =(isset($_REQUEST['page']))? $_REQUEST['page']: 0;
$searchInput =(isset($_REQUEST['searchInput']))? $_REQUEST['searchInput']: '';

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php include_once 'pagenamem.php';?>
 <title><?php echo PROJECT_TITLE."- Credential-DB";?></title>
<script src="js/commanJS.js" type="text/javascript"></script>
<link href="css/pagingCss.css" rel="stylesheet" type="text/css" />


</head>
  <body class="skin-blue">
    <div class="wrapper">
   <?php include_once 'headerm.php';?>
      <?php include_once 'leftmenu.php';?>
      <div class="content-wrapper">
        <section class="content-header">
       <h1>Credential info 
       <a href="#myModal" class="addnew" id="add" title="Add New Credential" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>    	
       </h1>
          <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Add Credential</li>
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
         <input class="form-control" title="Search" size="40" placeholder="Search"  
         autocomplete="off" name='searchInput' id='searchInput' class="searchInput" type="text" value="<?php echo htmlentities($searchInput); ?>">
         <div class="input-group-btn">
            <button type="submit" class="enableOnInput btn btn-default"  id='submitBtn'  ><i class="glyphicon glyphicon-search"></i></button>	
            </div>

        </div>
       </form>
        </div>
  	
  </div>
          </div>
              <div style="text-align: center;" id="smsg"></div>
<div class="box-body">
<table id="example1" class="table table-bordered table-striped">
<thead>
    <tr>
      <th>Status</th>
      <th>Parter ID</th>
      <th>Client Name</th>
      <th>DB HostName</th>
      <th>DB UserName</th>
      <th>DB Name</th>
     <!-- <th>Actions</th>-->
    </tr>
</thead>
<tbody>
<?php
$searchQuery=''; $searchURL=''; 
if(!empty($searchInput))   
{  $searchInput;   
   $searchQuery=" AND name LIKE '%$searchInput%' OR dbHostName LIKE '%$searchInput%' OR partner_id LIKE '%$searchInput%' OR dbName LIKE '%$searchInput%' ";
   $searchURL="&searchInput=$searchInput";
}
$adjacents = 3;
$targetpage="add_credential.php";
$query = "SELECT COUNT(*) AS num FROM publisher where acess_level='p'  $searchQuery ";
	$totalpages =db_select($query);
        $total_pages = $totalpages[0]['num'];
	$limit = 5; 
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
			$pagination.= "<a href=\"$targetpage?page=$prev$searchURL\">Previous</a>";
			
		else
			$pagination.= "<span class=\"disabled\"> Previous</span>";	
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
			$pagination.= "<a href=\"$targetpage?page=$next$searchURL\">Next </a>";
		    //$pagination.= '<a href="javascript:void(0)" onclick="changePagination(\''.$next.'\')">Next</a>';	
		else
			$pagination.= "<span class=\"disabled\">Next </span>";
		$pagination.= "</div>\n";		
	}
?>                    	
<?php 
// value come from notification
$rr= db_select($sql);
//$num=db_totalRow($q);
 $i=1;
 foreach($rr as $fetch ) 
   {
          $id=$fetch['par_id']; $parter_id=$fetch['partner_id']; $name=$fetch['name'];   
	  $pstatus=$fetch['pstatus']; $dbHostName=$fetch['dbHostName']; $dbName=$fetch['dbName'];  
	  $dbUserName=$fetch['dbUserName'];  $dbpassword=$fetch['dbpassword'];
 ?>   
    <tr>
        <td><?php echo ($pstatus==1  ? "Active" : "DeActive" ) ;?></td>
        <td><?php echo $parter_id ;?></td>
        <td><?php echo $name;?></td>
        <td><?php echo $dbName;?></td>
        <td><?php echo $dbHostName; ?></td>
        <td><?php echo $dbUserName; ?></td>
       
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
              
              
              
     </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php
       include_once"footer.php";
      ?>
    </div><!-- ./wrapper -->

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
                  <b>Add DB Credential</b>
                </h4>
            </div>
<div class="box-header" id="msg" style="border:0px solid red; text-align: center; padding-top:3px;">  </div>     
           
<br/>
<form class="form-horizontal" method="post">
     <div class="form-group" style="margin-bottom: 8px !important;"> 
     <label for="city" class="control-label col-md-4" style="padding-left: 0px; ">Select Partner ID:  <span style="color:red;">*</span></label>     
     <div class="col-xs-4">
     <?php
     $sqp="select partner_id,name from  publisher where acess_level='p' and pstatus='1'  order by partner_id";
     $fpq=db_select($sqp);
     //print_r($fpq);

     ?>
         <select id="partnerid" name="partnerid" class="input-xlarge" required style="padding: 8px 111px 8px 12px; margin-left: 1px;">
         <option value="">Select Partner ID</option>
      <?php
       foreach($fpq as $fvp)
       {
          $partnerID=$fvp['partner_id']; $pName=$fvp['name'];
       ?> 
        <option value="<?php echo $partnerID;  ?>"><?php echo $pName."(".$partnerID.")";  ?></option>
      <?php } ?>     
    </select>
    <span class="help-block has-error" id="partnerid-error"></span>     
       
     </div>
      
  </div>
     
        
        
        <div class="form-group" style="margin-bottom: 0px !important;">
        <label for="text" class="control-label col-xs-4">DB HostName:  <span style="color:red;">*</span></label>
         <div class="col-xs-5">
           <input type="text" class="form-control" name="dbhostname" id="dbhostname" required  placeholder="DB Host Name">
            <span class="help-block has-error" id="dbhostname-error"></span>
            </div>
        </div>
           
          <div class="form-group" style="margin-bottom: 0px !important;">
              <label for="text" class="control-label col-xs-4">DB UserName: <span style="color:red;">*</span></label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="dbuname" id="dbuname" required placeholder="DB User Name">
                <span class="help-block has-error" id="dbuname-error"></span>
            </div>
        </div>
        
        <div class="form-group" style="margin-bottom: 0px !important;">
          <label for="dbpassword" class="control-label col-xs-4">DB Password:</label>
         <div class="col-xs-5">
         <input type="password"  class="form-control" id="dbpassword" name="dbpassword"   placeholder="DB Password">
             <span class="help-block has-error" id="dbpassword-error"></span>
         </div>
        </div>
       <div class="form-group" style="margin-bottom: 0px !important;">
            <label for="dbname" class="control-label col-xs-4">Database Name:  <span style="color:red;">*</span></label>
            <div class="col-xs-5">
                <input type="text" class="form-control" id="dbname" name="dbname"  placeholder="database name">
                 <span class="help-block has-error" id="dbname-error"></span>
            </div>
        </div>
        <div class="form-group" style="margin-bottom: 0px !important;">
            <div class="col-xs-offset-4 col-xs-6">
               <button type="button" class="btn btn-primary"   onclick="saveCredentialDB('createDB');">Save</button>
               <button type="button" class="btn btn-primary"   onclick="saveCredentialDB('createDB');">Test Connection</button>
            </div>
        </div>
    </form>       
	    
     		
		 </div> 
		
  </div>
    </div>
  </div>
<script type="text/javascript">
function saveCredentialDB(act)
{     
var valid;	
valid = validCredentialDB();
if(valid) {
    var partnerid=$("#partnerid").val();
    var dbhostname=$("#dbhostname").val();
    var dbuname=$("#dbuname").val();
    var dbpassword=$("#dbpassword").val();
    var dbname=$("#dbname").val();
    document.getElementById("msg").innerHTML = "<center> <img src='img/image_process.gif'> Wait For Connect and Creat DB Credential </center>";
     $.ajax({
     url: "createdb.php",
     data:'partnerid='+partnerid+'&dbhostname='+dbhostname+'&dbuname='+dbuname+'&dbpassword='+dbpassword+'&dbname='+dbname+'&act='+act,
     type: "POST",
     success:function(res){
        if(res=="1")
        {
            window.location.href="add_credential.php";  
            $("#msg").val("");
        }   
        else
        {
            document.getElementById("msg").innerHTML=res;
            $("#msg").val("");
        }
    
      },
              error:function (){}
            });   
       }         
	    
}

function validCredentialDB() {
	var valid = true;	
	$(".demoInputBox").css('background-color','');
	$(".has-error").html('');
	
	if(!$("#partnerid").val()) {
		$("#partnerid-error").css('color','#DD4B39').html("(Select partner ID)");
		//$("#partnerid").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#dbhostname").val()) {
		$("#dbhostname-error").css('color','#ff3300').html("(Host Name required)");
		$("#dbhostname").css('background-color','#FFFFDF');
		valid = false;
	}
        if(!$("#dbuname").val()) {
		$("#dbuname-error").css('color','#ff3300').html("(DB User Name required)");
		$("#dbuname").css('background-color','#FFFFDF');
		valid = false;
	}
        if(!$("#dbname").val()) {
		$("#dbname-error").css('color','#ff3300').html("(DataBase Name required)");
		$("#dbname").css('background-color','#FFFFDF');
		valid = false;
	}
        
        
        
        if(!$("#dbname").val().match(/[a-zA-Z]+/)) {
		$("#dbname-error").css('color','#DD4B39').html("(Space Not allow)");
		$("#dbname").css('background-color','#FFFFDF');
		valid = false;
	}
       
	return valid;
}


</script> 
</body>
</html>
