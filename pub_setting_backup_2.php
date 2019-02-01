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
          <div class="modal-header">
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
            
            
            $name=array("banner","interstitial","reward_video");
            
            for($i=1; $i<=3; $i++)
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
       
<form id="myform" method="post" class="form-horizontal" >
  <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Publishers:</label>
            <div class="col-xs-8">
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
<hr style="border-top:2px solid red; margin-top: 0px; padding: 0px 0px 0px 0px">  </hr>
<div class="form-group" id='display_area'> 
 </div>
     </form>
       
        </div> 
  </div>
    </div>
  </div>


  <!--modal Box Finish-->            

        
    <form class="form-horizontal" name="subs" >
       <div class="form-group">
            <label for="inputEmail" class="control-label col-sm-5">Select Publishers:</label>
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
            
    <hr>
        
    <form method="post" action="select_pub_on_off.php" id=myForm>  
    <div class="row" style="border: 0px red solid;">
  <span class="help-block has-error" id="msgg" style="color:green; text-align: center;"></span>
<div  class="col-md-8 "style="border: 0px green solid;">
<div class="form-group">
    <div class="mainNav" style="margin-left:197px;">
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
if ($sett_on_off==1)
{  $chk="checked";    }
else
{  $chk="unchecked";   }
   ?> 
<ul>
    <li> <input type="checkbox" <?php echo $chk; ?>  name="sett_value[]"  id="<?php echo $setid; ?>par" class="parent_main" value="<?php echo $setid; ?>">	
    <a href="#"><?php echo strtoupper($sett_name);?></a>
<ul class="mainNav-scroll">
 <?php
 $ques="SELECT setID,sett_name,sett_on_off FROM $dbName1.publisher_setting where sett_parentid='$setid'";
  $results = mysqli_query($c,$ques) ;
  $count1=1;
while($row1=  mysqli_fetch_assoc($results))
        
{ 
     $setIDsub=$row1['setID'];  $sett_namesub=$row1['sett_name']; $sett_on_off1=$row1['sett_on_off'];
if ($sett_on_off1==1)
{  $chk1="checked";    }
else
{  $chk1="unchecked";   }
?>
     
    <li><input type="checkbox" <?php echo $chk1; ?> name="sett_value[]" id="<?php echo $setIDsub;  ?>"   class="child-<?php echo $setid; ?>" value="<?php echo $setIDsub; ?>"> 
<a href="#"> <?php echo strtoupper($sett_namesub); ?></a>

</li>
<?php $count1++; }?>   
</ul>
</li>			
</ul>
<?php $count++; }?>
        <br>
        
 <input id="submit" class="center-block" type="submit" name="subcheck" value="Submit" onclick="submitcheck()" /> 
 <?php  } 

    else{
      //  echo "No DATA Found";
    }                                                                                                                                         
    ?>                                                                         
</div>
 
  </div>
 </div><!-- /.row -->
 </div><!-- /.row -->
 </form>
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
	</script>
<script type="text/javascript">
$(document).ready(function() {  
$(".parent_main").change(function(){
var tt= $(this).is(':checked');
    if(tt){
            var cls = '.child-' + $(this).prop('id');
            clss=cls.substr(0,cls.length-3);
            $(clss).prop('checked', 'checked');  
          }
            else
            {  
                $(clss).prop('checked',false);  
            }   
     });
$('input[class*="child"]').change(function(){
    var cls = '.' + $(this).prop('class') + ':checked';
    var len = $(cls).length;
     //alert(len);
    var parent_id = '#' + $(this).prop('class').split('-')[1];
    // 3. Check parent if at least one child is checked
    if(len) {
        $(parent_id+"par").prop('checked', 'checked');
    } else {
        // 2. Uncheck parent if all childs are unchecked.
        $(parent_id+"par").prop('checked', false);
    }
});
});
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
 function submitcheck() {
$(document).ready(function() {
$("form#myForm").submit(function() {

        var sett_value = new Array();
        $("input:checked").each(function() {
           sett_value.push($(this).val());
        });

 var unsett_value = new Array();
        $("input:checkbox:not(:checked)").each(function() {
           unsett_value.push($(this).val());
        });

  //  alert(sett_value);
    //alert(unsett_value);
        $.ajax({
            type: "POST",
            url: "select_pub_on_off.php",
            dataType: 'html',
            data: 'sett_value='+sett_value+'&unsett_value='+unsett_value+'&pid='+"<?php echo $_REQUEST["pid"]?>",
            success: function(data){
             // alert(data);
                
                if(data=1)
                {
           // alert("Ifcase"+data);
            var mess="Data Updated Successfully";
            $("#msgg").html(mess);
            return false;
         }
           
            else
            {
                  var mess="Data Not Updated";
                 $("#msgg").html(mess);
                  return false;
           }
               
               
            }
        });
        return false;
});
});
}

</script>
</body>
</html>
