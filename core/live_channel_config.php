<?php
header('application/json');
include_once '../include/connect_db.php';

function getRandomCode(){
    $an = "0123456789abcdefghijklmnopqrstuvwxyz_";
    $su = strlen($an) - 1;
    return substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1);
}

if (isset($_FILES["userfile"]["name"])){
$status=0;
$err = $_FILES["userfile"]["error"];
	if($err > 0){
		echo "Error in Upload : ".$err;
	}else{
		
	 echo    $video_url=$_POST['video_url'];
		echo $channel_status=$_POST['channel_status'];
		$nameOfFile = $_FILES["userfile"]["name"];			
		$typeOfFile = $_FILES["userfile"]["type"];
		$sizeOfFile = $_FILES["userfile"]["size"];
		$locationOfFile=$_FILES["userfile"]["tmp_name"];
	    list($width, $height, $type, $attr) = getimagesize($locationOfFile);
		
	$imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
	
	// get random funtion call

	    echo "<br/>";
		echo getRandomCode();
		
		//if($width >2180){
	if (($_FILES['userfile']['type']=="image/gif") 
		|| ($_FILES['userfile']['type']=="image/tif") 
	    ||($_FILES['userfile']['type']=="image/jpg") 
		||($_FILES['userfile']['type']=="image/jpeg") 
		|| ($_FILES['userfile']['type']=="image/png")) 
		{
			
    if($width >300 AND $height < 300) {
    	
		
      $query = "INSERT INTO live_channel(liveID,live_logo,video_url,channel_status,channel_create_date) values('','','','')";
	  $r=$mysqli->query($query);
	
	}else{$message="Image dimesion invalid";}
	
}
else{
 $message="Image Type Invalid";
 
}



    }
					if($r)
					{
						header("Location:live_channel_detail.php?val=sucess");
						 /*----------------------------update log file begin-------------------------------------------*/
					  // $cdate=date('d/m/Y H:i:s');  $action="Upload image(".$nameOfFile.")"; $username=$_SESSION['username'];
					 //  write_log($cdate,$action,$username);
					    /*----------------------------update log file End---------------------------------------------*/ 
					}

else 
{
	 header("live_channel_detail.php?val=error"); 
}    
	


}


		

?>
       
       
       
       