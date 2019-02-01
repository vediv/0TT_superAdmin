<?php
include_once 'authm.php';  
$par_id = $_REQUEST['parid'];
$action = $_REQUEST['action'];
$query =  "SELECT dbName,dbHostName,dbUserName,dbpassword from publisher where acess_level='p' and par_id='$par_id'";
$fetch= db_select($query);
$dbName1=$fetch[0]['dbName'];  $dbHostName1=$fetch[0]['dbHostName']; 
$dbUserName1=$fetch[0]['dbUserName']; $dbpassword1=$fetch[0]['dbpassword']; 
$conoff =  mysqli_connect($dbHostName1, $dbUserName1, $dbpassword1, $dbName1);
    if (!$conoff)    
    die("Unable to connect to MySQL: " . mysqli_error()); 
    if (!mysqli_select_db($conoff,$dbName1))     
    die("Unable to select database: " . mysql_error());
switch($action)
{
    case "on_off";
    $cval = $_POST['cval'];
    $chkunck = $_POST['chkunck'];
    $sql = "update $dbName1.publisher_setting set sett_on_off='".$chkunck."' where setID='".$cval."'";
    $q = mysqli_query($conoff,$sql) ;
    echo $chkunck;
    break;
    case "pdelete":
    $pval = $_POST['pval'];
    $pq="select COUNT(*) as pcount,setID from $dbName1.publisher_setting where sett_parentid='".$pval."' and sett_on_off='1' ";
    $qq = mysqli_query($conoff,$pq);
    $ff=  mysqli_fetch_array($qq);
    $pcount=$ff['pcount']; $setID=$ff['setID'];
    if($pcount>0)
    {
        echo 1;
    }
    else{
   $dchild="delete from $dbName1.publisher_setting where sett_parentid='".$pval."' and sett_on_off='0' ";
    $dc = mysqli_query($conoff,$dchild);
    
    $pchild="delete from $dbName1.publisher_setting where setID='".$pval."' ";
    $dc1 = mysqli_query($conoff,$pchild); 
    echo 2;
        
        
    }
        
    break;
    
    
    
}    
 
 //var info = 'pval='+ pval+'&parid='+parid+'&action=pdelete';
 
 

?>
