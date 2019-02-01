<?php 
include_once 'authm.php'; 
include_once 'include/function.inc.php'; 
?>
<footer class="main-footer">
<?php 
$query1 = "SELECT * FROM dashbord_footer ORDER BY f_id DESC LIMIT 0,1";
$fetch = db_select($query1);
?>
<strong>Copyright &copy; <?php echo $fetch[0]['f_year'];   ?>
<a href="<?php echo $fetch[0]['f_hyperlink']; ?>">
<?php echo $fetch[0]['f_content']; ?></a>
</strong> All rights reserved.
        <strong">
        	version 15.10.16.01
        </strong>
       
      </footer>