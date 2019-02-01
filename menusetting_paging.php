<?php 
sleep(1);
include_once 'corefunction.php';
include_once("function.php");
$searchKeword = (isset($_POST['searchInputall']))? $_POST['searchInputall']: "";
$page =(isset($_POST['pageNum']))? $_POST['pageNum']: 0;
$pagelimit = (isset($_POST['limitval']))? $_POST['limitval']: 10;
$action = (isset($_POST['action'])) ? $_POST['action']: "";
switch($action)
{
  
    case "refresh":
      //echo "refresh";
    break;
}
?>
<div class="box-header" >
    <div class="row" style="border: 0px solid red; margin: 0px 5px 10px 5px;">
<table border='0' style="width:100%; margin-left: 1px;">
    <tr>
    <td width="15%">
    <select id="pagelmt"  style="width:60px;" onchange="selpagelimit_new('pagelmt','subscription_paging.php','load');" >
        <option value="10"  <?php echo $pagelimit==10? "selected":""; ?> >10</option>
        <option value="20"  <?php echo $pagelimit==20? "selected":""; ?> >20</option>
         <option value="50"  <?php echo $pagelimit==50? "selected":""; ?> >50</option>
        <option value="100" <?php echo $pagelimit==100? "selected":""; ?> >100</option>
        <option value="200" <?php echo $pagelimit==200? "selected":""; ?> >200</option>
        <option value="500" <?php echo $pagelimit==500? "selected":""; ?> >500</option>
        </select> Records Per Page
    </td>
  
<td width="80%">
<form class="navbar-form" role="search" method="post" style="  padding: 0 !important;">
       <div class="input-group add-on" style="float: right;">
       <input id='pagelimit' type="hidden" height="30px"  value="<?php echo $pagelimit; ?>">   
       <input class="form-control" size="30" onkeyup="SeachDataTable('subscription_paging.php','<?php echo $pagelimit;?>','<?php //echo $page; ?>','flash')"  placeholder="Search Entries"  autocomplete="off" name='searchQuery' id='searchInput' class="searchInput" type="text" value="<?php echo $searchKeword; ?>">
       <div class="input-group-btn">
       <button class="enableOnInput btn btn-default" disabled='disabled' id='submitBtn' type="button" style="height: 26px;   padding: 4px 6px !important;" onclick="SearchDataTableValue('subscription_paging.php','<?php echo $pagelimit;?>','<?php //echo $page; ?>','flash')"><i class="glyphicon glyphicon-search"></i></button>	
       </div>
       </div>
  </form>
</td>
<td width="3%">
     <div class="col-xs-1 hidden-xs hidden-sm pull-right" style="border:none;  margin-top:10px !important;">   
      <a href="javascript:" onclick="return refreshcontent('refresh','<?php echo $page;  ?>','<?php echo $pagelimit; ?>','<?php echo $searchKeword;?>');" title="refresh" style="float: right"><i class="fa fa-refresh" aria-hidden="true"></i></a>   
    </div>
</td>
</tr>
</table>
<div class="">
  <div class="pull-left" id="flash" style="text-align: center;"></div>
   <div id="load" style="display:none;"></div>
  <div class="pull-left" id="msg" style="text-align: center;"></div> 
</div>        
</div>
<?php 
$query_search='';
if($searchKeword!='')
{
    $query_search = " and  (userid LIKE '%".$searchKeword. "%' OR orderid LIKE '%". $searchKeword . "%'"
         ."OR orderid LIKE '%". $searchKeword . "%'"   
         . ")";
}    
//***** following code doing delete end ***/				
$adjacents = 3;
$query = "SELECT userid,MAX(added_date) added_date FROM user_payment_details where order_status!='Aborted' $query_search
GROUP BY userid ";
$total_pages = db_totalRow($conn,$query);
$limit = $pagelimit; 
if($page) 
        $start = ($page - 1) * $limit; 			
else
        $start = 0;

$sql = "SELECT upd.*,MAX(upd.added_date) added_date_new,ur.uid,ur.uname
FROM user_payment_details upd left join user_registration ur ON upd.userid=ur.uid where upd.order_status!='Aborted'  GROUP BY upd.userid LIMIT $start, $limit";
$que = db_select($conn,$sql);
$countRow=  db_totalRow($conn,$sql);
if($countRow==0)
{echo "<div align='center'><strong>No Record Found</strong> </div><br/>";}   
/* Setup page vars for display. */
?>
    
<form id="form" name="myform" style="border: 0px solid red;" method="post" action="priority.php">
  <table id="example1" class="table table-fixedheader table-bordered table-striped" style="width: 100%;">
<thead>
    <tr>
           <th>User ID</th>
           <th>User Name</th>
           <th>Order ID</th>
           <th>Transaction ID</th>
           <th>Plan Days</th>
           <th>Amount (INR)</th>
           <th>Payment Mode</th>
           <th>Order Date</th>
           <th>Expire Date</th>
           <th>Order Status</th>
           <th title="Subscription Status">Sub Status</th>
           <th title="Subscription History">Detail</th>
    </tr> 
</thead>
<tbody>
<?php
$count=1;
foreach($que as $fetch)
{
    $userid=$fetch['userid'];  $orderid=$fetch['orderid']; $trans_id=$fetch['trans_id']; $order_status=$fetch['order_status']; 
    $payment_mode=$fetch['payment_mode']; $status_code=$fetch['status_code']; $currency=$fetch['currency']; 
    $amount=$fetch['amount']; $plan_days=$fetch['plan_days']; $added_date=$fetch['added_date'];$expire_date=$fetch['expire_date'];
    $trans_date=$fetch['trans_date']; $added_date_new=$fetch['added_date_new'];
    $uname=$fetch['uname'];
    $query = "SELECT userid FROM user_payment_details where userid='$userid'"; 
    $total_subscription = db_totalRow($conn,$query);
 ?> 
<tr>
<td><?php echo $userid; ?></td>    
<td><?php echo $uname; ?></td>
<td><?php echo $orderid ?></td>
<td><?php echo $trans_id ;?></td>
<td><?php echo $plan_days;?></td>
<td><?php echo $amount;?></td>
<td><?php echo $payment_mode;?></td>
<td><?php echo $trans_date; ?></td>
<td><?php echo $expire_date; ?></td>
<td><?php echo $order_status; ?></td>
<td><?php echo $status_code==1?"active": "inactive"; ?></td>
<td>
 <a href="javascript:" data-target=".bs-example-modal-lg"  title="click to view detail" onclick="showUserSubscription();">
 view (<?php echo $total_subscription ?>)</a>
</td> 
</tr>       
<?php $count++; } ?>         
</tbody>
</table>

<div class="page" style="border: 0px solid red;   text-align: center; background-color:#fff !important; height:40px;">
<?php if($start==0) { 
       if($total_pages==0){  $startShow=0;  } else {  $startShow=1;}
       $lmt=$limit<$total_pages ? $limit :$total_pages;
       }
      else { $startShow=$start+1;  $lmt=$start+$countRow;  }
?>    
    <div class="pull-left" style="border: 0px solid red;">
      Showing <?php echo $startShow; ?>  to <?php echo $lmt; ?>   of <?php echo $total_pages; ?> entries   
      <span style="margin-left: 50px;" id="paging_loader"></span>
    </div> 
    <div class="pull-right" style="border: 0px solid red;">
    <?php
    if ($page == 0) $page = 1;
    $adjacent=1; $targetpage=''; $fromdate=''; $todate='';
    echo pagination($page,$limit,$total_pages,$adjacent,$targetpage,$searchKeword,$fromdate,$todate);
    ?>
    </div> 
</div>

</form> 
<script src="js/commonFunctionJS.js" type="text/javascript"></script>
<script type="text/javascript">
function changePagination(pageid,limitval,searchtext,fromdate,todate){    
      $('#load').show();
      $('#results').css("opacity",0.1);
      var dataString ='pageNum='+pageid+'&limitval='+limitval+'&searchInputall='+searchtext+'&fromdate='+fromdate+'&todate='+todate;
      $.ajax({
           type: "POST",
           url: "subscription_paging.php",
           data: dataString,
           cache: false,
           success: function(result){
           	 $("#results").html('');
                 $("#results").html(result);
                 $('#load').hide();
                 $('#results').css("opacity",1);
           }
     }); 
}
function showUserSubscription()    
{
      $("#myModal_show_subscription").modal(); 
      var info = 'action=add_new_plan'; 
      //var info = 'action=show_user_subscription'; 
        $.ajax({
	    type: "POST",
	    url: "planDetailModal.php",
	    data: info,
             success: function(result){
             $('#view_modal_user_subscription').html(result);
            return false;
        }
 
        });
     return false;    
}
function refreshcontent(ref,pageindex,limitval,searchtext){
     $('#load').show();
     $('#results').css("opacity",0.1);
     var apiBody = new FormData();
     apiBody.append("pageNum",pageindex);
     apiBody.append("limitval",limitval);
     apiBody.append("searchInputall",searchtext);
     //apiBody.append("filtervalue",filterview);
     apiBody.append("action",ref);
      $.ajax({
           type: "POST",
           url: "subscription_paging.php",
           data: apiBody,
           processData: false,
           contentType: false,
           cache: false,
           success: function(result){
           	 $("#flash").hide();
          	 $("#results").html(result);
                 $('#results').css("opacity",1);
          }
     });
}   
</script>