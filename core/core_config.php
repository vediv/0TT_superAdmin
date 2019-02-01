<?php
//define("SERVICEURL","http://ott01.esselshyam.net");  //for local  test
//session_start();
 $publisherID=$_SESSION['dasbord_user_id'];
$q="Select partner_id,name,admin_secret,service_url,uiconf_id,kaltura_player_id from publisher where par_id='$publisherID'";
$results = $mysqli->query($q);
$get_info = $results->fetch_array();
     //print_r($row['dname']);
 $PARTNER_ID=$get_info['partner_id'];  $SERVICEURL=$get_info['service_url'];  $ADMINSECRET=$get_info['admin_secret'];
 $USER_ID=$get_info['name']; $uiconf_id=$get_info['uiconf_id']; $kaltura_player_id=$get_info['kaltura_player_id'];
 
define("SERVICEURL",$SERVICEURL);  //for local  test
Define("PARTNER_ID",$PARTNER_ID);
Define("ADMINSECRET",$ADMINSECRET);
Define("USER_ID", $USER_ID);
define("UNICONF_ID",$uiconf_id); //// unicofID for video play in view detail
define("KALTURA_PLAYER_ID",$kaltura_player_id);

//define("SERVICEURL","http://ott01.planetcast.co.in");  //for local  test
//Define("PARTNER_ID", 101);
//Define("ADMINSECRET", "dcd3f100c96053b2cc1f4d07cc4ea19d");
//Define("USER_ID", "SomeoneWeKnow");
?>