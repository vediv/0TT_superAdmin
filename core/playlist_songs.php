<?php include_once 'auth.php'; ?>
    
      <!-- Modal content-->
   <html>
   
  <body>
  	 
   <div class="tab-pane active" id="tab1" >
  	 
<form class="form-horizontal" role="form" action="#" method="post" >
	                  <table id="example1" class="table table-bordered table-striped">

					<thead>
                     <tr>
                     	  <th>S.No</th>
                       <!--   <th>User Name</th>-->
                          <th>Songs Name</th>
                          <th>Created Date</th>
                          
                         
                      </tr> 
                  
                    </thead>
                    <?php
include_once '../include/connect_db.php';
$pid=isset($_REQUEST['id'])?$_REQUEST['id']:"";
//$getname_uid=explode("," ,$uid); $uname=$getname_uid[0]; $u_ID=$getname_uid[1];

 $so="SELECT * from playlist_config where pid='$pid' ORDER BY `song_added_date`";


 $ro= $mysqli->query($so);
 $i=1;
 while($fetch=mysqli_fetch_array($ro))
  {
  	
     $id=$fetch['pid'];
     $song_title=$fetch['song_title'];
	 $song_added_date=$fetch['song_added_date'];	
	 
	
 ?>
                    <tbody>
                <tr>
                <td class="first"><?php echo $i++; ?></td>
                          <!--<td><?php echo $uname; ?></td>-->
                          <td><?php echo $song_title; ?></td>
                          <td><?php echo $song_added_date; ?></td>
                         </tr> <?php }?>                 

</tbody>
					</table>	 
					</form>
   </div>
   
  
</body>
</html>
  


