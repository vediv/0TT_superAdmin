<?php include_once 'auth.php'; ?>
    
      <!-- Modal content-->
   <html>
   
  <body>
  	 
   <div class="tab-pane active" id="tab1" >
  	 
<form class="form-horizontal" role="form" action="#" method="post" >
	                  <table id="example2" class="table table-bordered table-striped">

					<thead>
                     <tr>
                     	  <th>S.No</th>
                       <!--   <th>User Name</th>-->
                          <th>Playlist Name</th>
                          <th>Created Date</th>
                          
                         
                      </tr> 
                  
                    </thead>
                    <?php
include_once '../include/connect_db.php';
$uid=isset($_REQUEST['id'])?$_REQUEST['id']:"";
$getname_uid=explode("," ,$uid); $uname=$getname_uid[0]; $u_ID=$getname_uid[1];

 $so="SELECT * from playlists where uid='$u_ID' ORDER BY `playlist_create_date`";


 $ro= $mysqli->query($so);
 //$numn=mysqli_num_rows($ro);
 //echo "Total Record=".$num;
 $i=1;
 while($fetch=mysqli_fetch_array($ro))
  {
  	
     $id=$fetch['uid'];
	// $uname =$fetch['uname'];
     $playlist_name=$fetch['playlist_name'];
	 $playlist_create_date=$fetch['playlist_create_date'];	
	 //$pcid=$fetch['pcid'];
	 //$song_title=$fetch['song_title'];
	// $date=$fetch['create_date'];
	
 ?>
                    <tbody>
                    
  
 
  
          <tr>
                           
                          <td class="first"><?php echo $i++; ?></td>
                          <!--<td><?php echo $uname; ?></td>-->
                          <td><?php echo $playlist_name; ?></td>
                          <td><?php echo $playlist_create_date; ?></td>
                         </tr> <?php }?>                 

</tbody>
					</table>	 
					</form>
   </div>
   
  
</body>
</html>
  


