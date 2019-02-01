<?php 
ob_start();  
$smenu =(isset($_REQUEST['smenu']))? $_REQUEST['smenu']: '';
$pid =(isset($_GET['pid']))? $_GET['pid']: '';
include_once 'authm.php';

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<?php include_once 'pagenamem.php';?>
 <title><?php echo PROJECT_TITLE."- Publisher List";?></title>
<script src="js/commanJS.js" type="text/javascript"></script>
<link href="css/pagingCss.css" rel="stylesheet" type="text/css" />
<link href="css/navAccordion.css" rel="stylesheet">
<style>
    .mainNav ul ul li a {    display: inline-block !important;    padding: 0.5em 15em 0.5em 2.5em;    width: 136px;}
.form-control {border-color: #91b5c9 !important;} 
</style>
</head>
 
  <body class="skin-blue">
    <div class="wrapper">
         <?php include_once 'headerm.php';?>
          <!-- Left side column. contains the logo and sidebar -->
      <?php include_once 'leftmenu.php';?>
       <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         
        <section class="content-header">
      <h1>Publisher Setting
       <a href="#myModal" class="addnew" id="add" title="Add New" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#myModal"><small><span style="color:#3290D4" class="glyphicon glyphicon-plus " ></span></small></a>    	
      </h1>
          <ol class="breadcrumb">
            <li><a href="dashbord.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
              <li class="active">Publisher Setting</li>
          </ol>
        </section>
        
     <section class="content">
           <div class="row">
          <div class="col-xs-12">
          <div class="box">
        <div class="box-header">
 
	<!-- create plan Model -->
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="border-radius: 14px; ">
        <div class="modal-body">
          <div class="modal-header" style="border-bottom: 1px solid #91B5C9 !important">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                  <b>Config Details</b>
                </h4>
            </div>
       <br/>
     <?php
     
        
if(isset($_POST['save_menu']))
{   
       $dataArr=explode(";",$smenu);
        $dbHostName=$dataArr[3]; $dbUserName=$dataArr[1]; $dbpassword=$dataArr[2]; $database=$dataArr[0];
      //  $dbid=$dataArr[4];
       $conn =  mysqli_connect($dbHostName, $dbUserName, $dbpassword, $database);
       if (!$conn)    
	die("Unable to connect to MySQL: " . mysqli_error()); 
    	if (!mysqli_select_db($conn,$database))     
	die("Unable to select database: " . mysql_error()); 
        
        $net_value=$_POST['net_value'];  $n_name=$_POST['n_name']; 
            $Query_plan="insert into $database.publisher_setting(sett_name,sett_parentid,sett_status,sett_on_off,created_at)
   	    values('$n_name','0','1','1',NOW())";
            $save_plan = mysqli_query($conn,$Query_plan) ;
            
            $id=mysqli_insert_id($conn);
         $name=array("banner","interstitial","reward_video","preroll");
            
            for($i=1; $i<=4; $i++)
            {
              $n_name=$name[$i-1]; 
                
            $Query_plan="insert into $database.publisher_setting(sett_name,sett_parentid,sett_status,sett_on_off,created_at)
   	    values('$n_name','$id','1','0',NOW())";
            $save_plan = mysqli_query($conn,$Query_plan) ;
                
            }
              if($save_plan)
                {
                   header("Location:pub_setting.php");       
                }
} 
 
?>
       <div style="border: 1px solid #91B5C9;  padding-top: 26px;">
<form id="myform" method="post" class="form-horizontal" >
  <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Publisher:</label>
            <div class="col-xs-6">
                <select name="smenu" id="smenu"  class="form-control" >
          <option>Select Publisher</option> 
<?php 

$query =  "SELECT * from publisher where acess_level='p'";
$rr= db_select($query);
$i=1;
 foreach($rr as $fetch ) 
   {
          $id=$fetch['par_id']; $parter_id=$fetch['partner_id']; $name=$fetch['name'];  $email=$fetch['email']; 
	  $pstatus=$fetch['pstatus']; $admin_secret=$fetch['admin_secret']; 
	  $service_url=$fetch['service_url'];  $created_at=$fetch['created_at'];
	  $dbName=$fetch['dbName'];  $dbHostName=$fetch['dbHostName']; $publisherUniqueID=$fetch['publisherID'];
          $dbUserName=$fetch['dbUserName']; $dbpassword=$fetch['dbpassword'];
          $postdata=$dbName.";".$dbUserName.";".$dbpassword.";".$dbHostName.";".$id;
       ?> 
  <option value="<?php echo $postdata; ?>" ><?php echo $name."(".$publisherUniqueID.")"; ?></option>
    <?php 
	}
        
?>
</select>
            </div>
        </div>
    
<div class="col-lg-12">
  <div class="form-inline">
  <div class="col-sm-6 col-md-6 col-lg-6 pull-right">
 <!-- <input type="text" class="form-control" name="category_search" style="  width: 271px !important; margin-left: 9em;"   value="" placeholder="Search Categories">-->
  </div>
  </div>
</div>       

    <div class="form-group" id='display_area' style="margin-left: 201px;"> 
 </div>
     </form>
       </div>
        </div> 
  </div>
    </div>
  </div>


  <!--modal Box Finish-->            

        
    <form class="form-horizontal" name="subs" >
       <div class="form-group">
            <label for="inputEmail" class="control-label col-sm-5">Select Publisher:</label>
             <div class="col-sm-4">  
                 <select name="smenuu" id="smenuu" class="form-control" onchange="getval(this);" >
                <option>Select Publisher</option> 
                    <?php 
                     $query1 =  "SELECT * from publisher where acess_level='p'";
                     $rr1= db_select($query1);
                     $i=1;

                     foreach($rr1 as $fetch ) 
                       {
                              $id=$fetch['par_id']; $parter_id=$fetch['partner_id']; $name=$fetch['name'];  $email=$fetch['email']; 
                              $pstatus=$fetch['pstatus']; $admin_secret=$fetch['admin_secret']; 
                              $service_url=$fetch['service_url'];  $created_at=$fetch['created_at'];
                              $dbName=$fetch['dbName']; $dbHostName=$fetch['dbHostName']; $publisherUniqueID=$fetch['publisherID'];
                              $postdata=$dbName.";".$dbUserName.";".$dbpassword.";".$dbHostName;
                              $sel=$pid==$id?'selected':'';
                     ?>  
  <option value="<?php echo $id; ?>"  <?php echo $sel; ?> ><?php echo $name."(".$publisherUniqueID.")"; ?></option>
    <?php 
	}
     ?>
</select>
            </div>
        </div>
          
                     </form> 
            
    
        
     
    <div class="row" style="border: 0px red solid; margin-left:-190px; margin-right:450px;" >
  <span class="help-block has-error" id="msgg" style="color:green; text-align: center;"></span>
<div  class="col-md-8 "style="border: 0px green solid;">
<div class="form-group">
    <div class="mainNav" style="margin-left:494px;">
  <?php 
  $flag=0;
if(!empty($pid)){
$query =  "SELECT dbName,dbHostName,dbUserName,dbpassword from publisher where acess_level='p' and par_id='$pid'";
$fetch= db_select($query);
//print_r($fetch);
$dbName1=$fetch[0]['dbName'];  $dbHostName1=$fetch[0]['dbHostName']; 
$dbUserName1=$fetch[0]['dbUserName']; $dbpassword1=$fetch[0]['dbpassword'];

   $flag=1;
}
   if ($flag==1){
     
     $c =  mysqli_connect($dbHostName1, $dbUserName1, $dbpassword1, $dbName1);
     if (!$c)    
	die("Unable to connect to MySQL: " . mysqli_error()); 
   	if (!mysqli_select_db($c,$dbName1))     
	die("Unable to select database: " . mysql_error());
        
      $que="SELECT setID,sett_name,sett_parentid,sett_on_off FROM $dbName1.publisher_setting where sett_parentid='0'" ;
      $result = mysqli_query($c,$que) ;
      $count=1;
   while($netf=  mysqli_fetch_assoc($result))
   {
        $setid=$netf['setID']; $sett_name=$netf['sett_name'];  $sett_parentid=$netf['sett_parentid']; 
        $sett_on_off=$netf['sett_on_off'];
       // $chk=$sett_on_off== 1?"checked":"unchecked";

   ?> 
<ul id="liremove<?php echo $setid;  ?>">
<li >
        
<a href="#" title="Delete" ><i onclick="childdelete('<?php echo $setid;  ?>','<?php echo $pid ?>')" class="fa fa-trash-o" style="font-size:15px!important; border: 0px solid red;" aria-hidden="true"></i>
</a>
<a  href="#" style="margin-left: -24%;"><?php echo strtoupper($sett_name);?></a>
 

<ul class="mainNav-scroll">
 <?php
 $ques="SELECT setID,sett_name,sett_on_off FROM $dbName1.publisher_setting where sett_parentid='$setid'";
  $results = mysqli_query($c,$ques) ;
  $count1=1;
while($row1=  mysqli_fetch_assoc($results))
        
{ 
$setIDsub=$row1['setID'];  $sett_namesub=$row1['sett_name']; $sett_on_off1=$row1['sett_on_off'];
$class=$sett_on_off1==1?"btn-primary active":"btn-default";
if($sett_on_off1==1)
{
    $class1="btn-primary active";  $class2="btn-default"; $disable1="disabled"; $disable2="";
} 
else
{
$class2="btn-primary active";  $class1="btn-default";    $disable2="disabled"; $disable1="";
}


?>
     
<li>
<!--<input type="checkbox" <?php echo $chk1; ?> name="sett_value[]" id="checkunchek<?php echo $setIDsub;  ?>"   class="child-<?php echo $setid; ?>" value="<?php echo $setIDsub; ?>" onclick="checkuncheck('<?php echo $setIDsub; ?>','<?php echo $pid ?>')">--> 
 
    <div class="btn-group btn-toggle pull-left" style="border:0px solid red; margin-top: 4px;"> 
        <button class="btn btn-xs <?php echo $class1;  ?>" <?php echo $disable1; ?> id="on<?php echo $setIDsub; ?>" onclick="checkuncheck('<?php echo $setIDsub; ?>','<?php echo $pid ?>','1')">ON</button>
    <button class="btn btn-xs <?php echo $class2;  ?>" <?php echo $disable2; ?> id="off<?php echo $setIDsub; ?>" onclick="checkuncheck('<?php echo $setIDsub; ?>','<?php echo $pid ?>','0')">OFF</button>
</div>
<a href="#"> <?php echo strtoupper($sett_namesub); ?></a>
</li>
<?php $count1++; }?>   
</ul>
</li>			
</ul>
<?php $count++; }?>
        <br>
        
  
 <?php  } 

    else{
      //  echo "No DATA Found";
    }                                                                                                                                         
    ?>                                                                         
</div>
 
  </div>
 </div><!-- /.row -->
 </div><!-- /.row -->
   </div><!-- /.row -->
    </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
 <?php include_once"footer.php";  ?>
 </div><!-- ./wrapper -->
 <script src="js/navAccordion.min.js" type="text/javascript"></script>
<script type="text/javascript">
		jQuery(document).ready(function(){
			//Accordion Nav
			jQuery('.mainNav').navAccordion({
				expandButtonText: '<i class="fa fa-chevron-right"></i>',  //Text inside of buttons can be HTML
				collapseButtonText: '<i class="fa fa-chevron-down"></i>'
			}, 
			function(){
				//console.log('Callback')
			});
			
		});
                
                
                
$('.btn-toggle').click(function() {
    $(this).find('.btn').toggleClass('active');  
    $(this).find('.btn').toggleClass('btn-default');
       
});
	</script>
        
<script type="text/javascript">
function childdelete(pval,parid){
//if(st==1) { alert('This Menu is active so you can not delete'); return false;} 
//var d=confirm("Are you sure you want to Delete This?");
       var info = 'pval='+ pval+'&parid='+parid+'&action=pdelete';
       $.ajax({
       type: "POST",
       url: "select_pub_on_off.php",
       data: info,
       success: function(r){
         if(r==1)
         {
           alert('Child is active so you can not delete..'); return false;    
         }   
         
         if(r==2)
         {
           alert("Delete successfully");
           $("#liremove" + pval).remove();
           return true;
         }   

        
         }
    });  

}

</script> 

<script type="text/javascript">
 $('#smenu').change(function(){
  var option = $(this).find('option:selected').val();
      $('#myModal').modal({
            backdrop: 'static'
           
        });
     $.ajax({
     type: "POST",  
   url: "select_pub.php",
   data:{ 'pub':option},
   success: function(result){
   //  alert(result);
       document.getElementById("display_area").innerHTML=result;
 }

});

	return false;	//$('#showoption').val(option);
	});
   
</script>   
     
<script type="text/javascript">
  function getval(sel)
{
    
      var pid=sel.value;
      window.location.href="pub_setting.php?pid="+pid;
      //  alert(sel.value)        
}
</script>   


<script type="text/javascript">
 function checkuncheck(cval,parid,chkunck) {
   $.ajax({
   type: "POST",
   url: "select_pub_on_off.php",
   data:'cval='+cval+'&parid='+parid+'&chkunck='+chkunck+'&action=on_off',
   success: function(r){
       
     	   if(r==0)
   	   { 
            $("#off"+cval).addClass("btn-primary active").removeClass("btn-defaulte");
            $("#on"+cval).removeClass("btn-primary active");
            $("#off"+cval).prop("disabled", true);
            $("#on"+cval).prop("disabled", false);

   	   }
   	   if(r==1)
   	   {
   	   	 $("#on"+cval).addClass("btn-primary active").removeClass("btn-default");
                 $("#off"+cval).removeClass("btn-primary active");
                 $("#on"+cval).prop("disabled", true);
                 $("#off"+cval).prop("disabled", false);  
   	   }
               }
 
    }); 
  
}

</script>
</body>
</html>
