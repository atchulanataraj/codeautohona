<?php

header("Access-Control-Allow-Origin: *");
require_once('json.php');
$mysql_host = "mysql.hostinger.in";
$mysql_database = "u494114538_harnk";
$mysql_user = "u494114538_harnk";
$mysql_password = "harank123";


$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database,$conn) or die(mysql_error());


if($_GET['type']=='checkId'){


$sql = "SELECT count(*) as cnt FROM `user_profile` WHERE user_id='".$_GET['userId']."';";



$result=mysql_query($sql) or die(mysql_error());

$rs=mysql_fetch_row($result)   or die(mysql_error()); 

$status;


if($rs[0]>0){


  $status=array('status' => 'success');


}
else{

$status=array('status' => 'fail');

}


   echo json_encode($status);

}

?>