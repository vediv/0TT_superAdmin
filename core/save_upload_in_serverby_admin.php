<?php
include_once 'auth.php';
$upload_url=$_REQUEST['upload_url'];
$inputTitle=$_REQUEST['inputTitle'];
$mytags=$_REQUEST['mytags'];
$descrip=$_REQUEST['descrip'];
$categoryid=$_REQUEST['categoryid'];
$userID=$_REQUEST['userid'];
//echo $upload_url."--".$inputTitle."--".$mytags."--".$descrip."--".$categoryid."--".$userID;
include_once("config.php");
include_once '../include/connect_db.php';

// for geting upload token
$uploadToken = null;
$result_token = $client->uploadToken->add($uploadToken);
//print '<pre>'.print_r($result_token, true).'</pre>';
$uploadTokenId=$result_token->id;

$fileData = $upload_url;
$resume = null;
$finalChunk = null;
$resumeAt = null;
$result_upload = $client->uploadToken->upload($uploadTokenId, $fileData, $resume, $finalChunk, $resumeAt);
$file_upload_token=$result_upload->id;

$entry = new KalturaBaseEntry();
$entry->name = $inputTitle;
$entry->description = $descrip;
$entry->userId = $userID;
$entry->categoriesIds = $categoryid;
$entry->tags = $mytags;
$uploadTokenId = $file_upload_token;
$type = KalturaEntryType::AUTOMATIC;
$result = $client->baseEntry->addfromuploadedfile($entry, $uploadTokenId, $type);
//print '<pre>'.print_r($result, true).'</pre>';
$entry_id=$result->id; $titlename=$result->name; $creatorId=$result->creatorId; $createdAt=$result->createdAt;
if($entry_id!='')
{
	  	
	   $upload_date=date("Y-m-d", $createdAt);
	   $uploadEntry= $mysqli->query("Insert into upload_detail_by_admin(upload_by,entry_id,upload_date_time) values('$creatorId','$entry_id','$upload_date')");
     //$user_data = $get_user->fetch_array(); 
     if (is_file($upload_url)){
        unlink($upload_url);
          }    
	echo 1;
	
}
else
	{
		
		echo 2;
	}




?>