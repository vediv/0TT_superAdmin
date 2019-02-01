<?php
include_once 'authm.php';  
$smenu=$_REQUEST['pub'];
$dataArr=explode(";",$smenu);


  $dbHostName=$dataArr[3]; $dbUserName=$dataArr[1]; $dbpassword=$dataArr[2]; $database=$dataArr[0];  $dbid=$dataArr[4];
                 
 $conn1 =  mysqli_connect($dbHostName, $dbUserName, $dbpassword, $database);
 if (!$conn1)    
	die("Unable to connect to MySQL: " . mysqli_error()); 
    //if connection failed output error message 
    
	if (!mysqli_select_db($conn1,$database))     
	die("Unable to select database: " . mysql_error()); 

   ?>
  
<div class="form-group" id="display_area" style="margin-left: -223px;"  >
<label for="inputPassword" class="control-label col-xs-4">Ad Network:</label>
<div class="col-xs-6">
<div class="container1"> 	                 
<div class="row"> 
<div class="col-md-12">
<div id="sidebar" class="well sidebar-nav" style="border: 0px solid red; padding: 11px;"> 
<div class="mainNav">
<ul style="border: 1px solid white; height:170px;overflow-y: scroll; display: block; " id="results">
   <?php
 $que="SELECT setID,sett_name,sett_parentid,sett_dept FROM publisher_setting where sett_parentid=0" ;
 $result = mysqli_query($conn1,$que) ;
while($net=  mysqli_fetch_assoc($result))
{
                                      
$setid=$net['setID']; $sett_name=$net['sett_name'];  $sett_parentid=$net['sett_parentid']; $sett_dept=$net['sett_dept'];
?>    
    <li> <input type="hidden" name="net_value"  id="net_value" required value="<?php  echo $setid; ?>">	
<a href="#"><?php echo strtoupper($sett_name);?></a>
<ul>
<?php
 $ques="SELECT setID,sett_name FROM publisher_setting where sett_parentid='$setid'";
  $results = mysqli_query($conn1,$ques) ;
  
while($row1=  mysqli_fetch_assoc($results))
{
//$row=db_select($result);
 $setIDs=$row1['setID'];  $sett_names=$row1['sett_name'];
   ?>	
<li>
<a href="#"> <?php  echo strtoupper($sett_names); ?></a>
</li>
<?php } ?>
</ul>
</li>			
<?php 
  }
 ?>
</ul>
</div>
  </div>
        </div>    
    </div>                                                                                                           
</div> 
  </div>
     </div>

  <div class="form-group" style="margin-left: -223px;"  >
     <label for="inputEmail" class="control-label col-xs-4">Network Name:</label>
     <div class="col-xs-6">
         <input type="text" class="form-control" required id="n_name" name="n_name" placeholder="Network Name" value="" maxlength="30">
     </div>
  </div>
    
  <div class="form-group">
    <div class="col-xs-offset-2 col-xs-10">
        <button type="submit" class="btn btn-primary" name="save_menu">Save & Close</button>
    </div>
  </div>
 