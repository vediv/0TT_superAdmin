<?php
include_once 'auth.php';
 include_once("config.php");
//print_r($_FILES);
if(is_array($_FILES) and !empty($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
	$enteryID=$_POST['enteryID'];
$userID_upload=$_SESSION['dasbord_user_name']; $userID=$_SESSION['dasbord_user_id'];

$dir_path=$_SERVER['DOCUMENT_ROOT']. "/admin-mycloud/core/tmp_thumbnail/"; // for local test
//$dir_path=$_SERVER['DOCUMENT_ROOT']. "/admin-mycloud/tmp_thumbnail/"; // for server

$new_path = $dir_path . $userID;
        
	    if(is_dir($new_path)) {
	    //echo "xcknvknxcv";
         // echo "The Directory $userID exists";
         } else {
             mkdir($new_path, 0777,true);
             // echo "The Directory $new_path was created";
            }

$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "$new_path/".$_FILES['userImage']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
     // echo $targetPath;
$path="$targetPath";
$entryId = $enteryID;
$fileData = $path;
$result = $client->thumbAsset->addfromimage($entryId, $fileData);
//$result="yes";
if($result!='')
{
	
	if (is_file($path)){
           unlink($path);
          }    
	  echo "1";
   

}
else {
	echo "Some Problem in server for upload image please try some time.";
}
?>
  
<?php
          }
     }
}
?>