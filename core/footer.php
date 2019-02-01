 <?php 
 include_once 'auth.php'; 
  include_once '../include/connect_db.php';?>
      <footer class="main-footer">

       
      	<?php $query1 = "SELECT * FROM dashbord_footer ORDER BY f_id DESC LIMIT 0,1";
               $result= $mysqli->query($query1);
               $fetch=mysqli_fetch_array($result);
               ?>
               
        <strong>Copyright &copy; <?php echo $fetch['f_year'];   ?>
        	
        	<a href="<?php echo $fetch['f_hyperlink']; ?>">
        		<?php echo $fetch['f_content']; ?></a>
			   
			   
			   </strong> All rights reserved.
        <strong">
        	version 15.10.16.01
        </strong>
       
      </footer>