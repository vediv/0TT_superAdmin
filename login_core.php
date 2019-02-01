<?php
session_start();
include_once 'config.php';
include_once 'include/function.inc.php';

$login_type=$_POST['loginType'];
switch ($login_type) {
case "login":
$Email = db_quote($_POST['userEmail']);  $Password = db_quote($_POST['UserPass']);
$query="Select * from publisher where email=$Email and publisher_pass=$Password and pstatus=1";
$rows = db_select($query);
$acess_level=$rows[0]['acess_level'];
$totalRow=db_totalRow($query);
if($totalRow==1){
      switch($acess_level) {
      case "s":
      $_SESSION['super_dasbord_par_id'] = $rows[0]['par_id'];
      echo 1;
      break;
      }
   }
else
{
    echo 2;
}
break;
case "add_publisher":
$pname=$_POST['pname'];
$admin_secret=$_POST['admin_secret'];
$company_name=$_POST['company_name'];
$inputEmail=$_POST['inputEmail'];
$partnerid=$_POST['partnerid'];
$service_url=$_POST['service_url'];
$inputPassword=$_POST['inputPassword'];
$s="select partner_id,email from publisher where partner_id='$partnerid' or email='$inputEmail' ";
$ff=  db_select($s);
$count=  db_totalRow($s);
$dbPartnerID=$ff[0]['partner_id']; $dbEmail=$ff[0]['email'];
if($count>0)
{
    if($dbPartnerID==$partnerid)
    {
        echo 1;   // partnerID alredy exit;
    }
    if($dbEmail==$inputEmail)
    {
        echo 4; // email alredy exit;
    }


}
   else
   {

     $publisherID=$_SESSION['super_dasbord_par_id'];
     $inser_p="insert into publisher(name,partner_id,email,company,admin_secret,service_url,publisher_pass,pstatus,created_at,updated_at,parentid,addedby)
     values('$pname','$partnerid','$inputEmail','$company_name','$admin_secret','$service_url','$inputPassword',1,NOW(),NOW(),'0','$publisherID')";
     $execute=db_query($inser_p);
     if($execute)
     {
         header("Location:puserlist.php");

     }
     else {

         echo 3;

     }
   }
     break;

}
