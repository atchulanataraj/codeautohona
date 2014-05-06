<?php

header("Access-Control-Allow-Origin: *");
require_once('json.php');
$mysql_host = "mysql.hostinger.in";
$mysql_database = "u494114538_harnk";
$mysql_user = "u494114538_harnk";
$mysql_password = "harank123";
 
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database,$conn) or die(mysql_error());
if(isset($_GET['uname']) && isset($_GET['pwd'])){

   $sql="SELECT count(*) as count,user_id FROM `user_profile` WHERE user_email='".$_GET['uname']."' and user_pwd='".$_GET['pwd']."'";
  $result=mysql_query($sql);
   $rs= $result ? mysql_fetch_assoc($result) : mysql_error() ;


if($rs['count'] == 1){
$token=md5( uniqid('auth', true) );
mysql_query("UPDATE user_profile set access_token='".$token."' WHERE user_id='".$rs['user_id']."'");

mysql_query("INSERT INTO auto_reviews (auto_id,user_id,rating,comment) values('".$_GET['autoId']."','".$rs['user_id']."','".$_GET['rate']."','".$_GET['cmt']."')");

echo json_encode(array(status  => "success",token => $token ));
}
else{
echo json_encode(array(status  => "fail",token => "000"));
}

}

?>