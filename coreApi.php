<?php
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Credentials: true ");
//header("Access-Control-Allow-Methods: POST,OPTIONS, GET");
//header('Access-Control-Max-Age: 1000');
//header("Access-Control-Allow-Headers:Origin,Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
//header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
//header("Content-Type: application/json; charset=utf-8");
include_once 'include/function.inc.php';
$tag=trim(isset($_POST['tag']))?$_POST['tag']:'';
$subtag=trim(isset($_POST['subtag']))?$_POST['subtag']:'';
if($tag==='menu')
{
            switch($subtag)
            {
               case "list":
               $LoginSuccessful = false;
               if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){

                    $Username = $_SERVER['PHP_AUTH_USER'];
                    $Password = $_SERVER['PHP_AUTH_PW'];

                    if($Username == 'santosh' && $Password == '123'){
                        $LoginSuccessful = true;
                    }
                }

            if (!$LoginSuccessful){

                header('WWW-Authenticate: Basic realm="Secret page"');
                header('HTTP/1.0 401 Unauthorized');
                die ("Not authorized");
            }
            else {


                $result = array();$rows=array();
                $query = "SELECT mid FROM menus";
                $totalRecord=  db_totalRow($query);
                $limit = $pagelimit;
                if($page)
                        $start = ($page - 1) * $limit;
                else
                        $start = 0;
                $sql="Select * from menus";
                $fetchData=db_select($sql);
                //$fetch= db_select($query);
                $result = array();$rows=array();
                foreach ($fetchData as $row) {
                 $rows['mid']=$row['mid'];
                 $rows['mname']=$row['mid'];

                 $result[]=$rows;
                }
                echo json_encode(array('status' =>1,'data' =>$result,'totalRecord'=>$totalRecord));
                db_close($con); // db close..
                break;

            }
       }
}
else
{
   echo json_encode(array('status' =>0,'msg' =>"Error:something wrong."));
}


?>
