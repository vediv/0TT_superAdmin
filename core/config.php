<?php
require_once('php5/KalturaClient.php');
include_once 'core_config.php'; 
//$adminSecret = 'a5661959120ff8f0953a994fcc879cf3';
//$partnerId = 102; //your partner id
//$userId = 'SomeoneWeKnow'; //this can be the logged-in admin user for tracking/auditing purposes

//ADMINSECRET, USER_ID, SESSION_TYPE, PARTNER_ID

$config = new KalturaConfiguration(PARTNER_ID);
$config->serviceUrl = SERVICEURL."/";
$client = new KalturaClient($config);
$ks = $client->generateSession(ADMINSECRET, USER_ID, KalturaSessionType::ADMIN, PARTNER_ID);
$client->setKs($ks);
?>