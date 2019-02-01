<?php 
include_once 'authm.php';
include_once 'pagenamem.php';
$parIDid =(isset($_REQUEST['next']))? $_REQUEST['next']:'';
$email =(isset($_REQUEST['email']))? $_REQUEST['email']:'';
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title><?php echo PROJECT_TITLE." | Menu Permissions";?></title>
    <style type="text/css">
    fieldset.scheduler-border { border: 1px groove #ddd !important;    padding: 0 1.4em 1.4em 1.4em !important;    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;    box-shadow:  0px 0px 0px 0px #000;}
    legend.scheduler-border{ text-align: left !important; width:auto; height:20px; padding:12px 3px 0px 3px; font-size:12px; font-weight: bold;
    border-bottom:none; color:#3290D4; }
    .btn.disabled, .btn[disabled], fieldset[disabled] .btn {     opacity: 1 !important;}
    #load {
        opacity:1;
        width: 60%;
        height: 50%;
        position: fixed;
        z-index: 9999;
        color: red;
        background: transparent url("img/image_process.gif") no-repeat center;
    }
    </style>
    </head>
<body class="skin-blue">
<div class="wrapper">
   <?php include_once 'headerm.php';?>
   <?php include_once 'leftmenu.php';?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1>Dashboard Permissions
               <a href="menuPermission.php?next=<?php echo $parIDid; ?>&email=<?php echo $email; ?>"  title="Edit Menu Permissions"><small><span style="color:#3290D4" class="glyphicon glyphicon-edit"></span></small></a>    	
          </h1>
       <ol class="breadcrumb">
            <li><a href="dashbordm.php"><i class="fa fa-home" title="Home"></i> Home</a></li>
            <li class="active">Dashboard Permissions</li>
       </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12" >
                <div class="box" id="results" style="border:0px solid red;"> </div>
              </div>
            </div>
        </section><!-- /.content -->
</div><!-- /.col -->
<?php  include_once"footer.php"; //mysqli_close($clientConnect);  ?>
</div><!-- /.content-wrapper --> 
<script type="text/javascript">
var par_id="<?php echo $parIDid;  ?>";  var pemail="<?php echo $email; ?>";
$(document).ready(function() {
var loading  = false; //to prevents multipal ajax loads
$('#results').load("dashboard_permission_page.php",{'par_id':par_id,pemail:pemail},
function(){
             $("#flash1").hide();
             //pageNum++;
           });
   });
function on_off_menu1(mstatus,munuids,munulevel)
{
       console.log(mstatus+"---"+munuids+"--"+munulevel+"--"+par_id+"---"+pemail);
       $('#load').show();
       $('#results').css("opacity",0.1); 
       var apiBody = new FormData();
       apiBody.append("par_id",par_id);
       apiBody.append("pemail",pemail);
       apiBody.append("munuids",munuids);
       apiBody.append("mstatus",mstatus);
       apiBody.append("munulevel",munulevel);
       $.ajax({
                url:'dashboard_permission_page.php',
                method: 'POST',
                data:apiBody,
                processData: false,
                contentType: false,
                    success: function(result){
                        //alert(result)
                         $("#results").html('');
                         $("#results").html(result);
                         $('#load').hide();
                         $('#results').css("opacity",1);
                     }
            });
}
function on_off_menu2(mstatus,munuids,munulevel)
{
      
       console.log(mstatus+"---"+munuids+"--"+munulevel+"--"+par_id+"---"+pemail+"--"+mstatus);
       $('#load').show();
       $('#results').css("opacity",0.1); 
       var apiBody = new FormData();
       apiBody.append("par_id",par_id);
       apiBody.append("pemail",pemail);
       apiBody.append("munuids",munuids);
       apiBody.append("mstatus",mstatus);
       apiBody.append("munulevel",munulevel);
       $.ajax({
                url:'dashboard_permission_page.php',
                method: 'POST',
                data:apiBody,
                processData: false,
                contentType: false,
                success: function(result){
                     //alert(result)
                       $("#results").html('');
                       $("#results").html(result);
                       $('#load').hide();
                       $('#results').css("opacity",1);
                 }
            });
}

function cmsSetting(act)
{
     
       $('#load').show();
       $('#results').css("opacity",0.1); 
       var apiBody = new FormData();
       apiBody.append("par_id",par_id);
       apiBody.append("pemail",pemail);
       if(act=='categoryLevel'){ 
        var catleval=$("#categoryLevel").val();  
        apiBody.append("categoryLevel",catleval);
       }
       apiBody.append("munulevel",act);
       //console.log(catleval+"---"+par_id+"---"+pemail+"--"+act);
       //return false;
       $.ajax({
                url:'dashboard_permission_page.php',
                method: 'POST',
                data:apiBody,
                processData: false,
                contentType: false,
                success: function(result){
                     //alert(result)
                       $("#results").html('');
                       $("#results").html(result);
                       $('#load').hide();
                       $('#results').css("opacity",1);
                 }
            });
}


</script>   
</body>
</html>
