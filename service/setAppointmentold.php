<?php

header("Access-Control-Allow-Origin: *");
require_once('json.php');
$mysql_host = "mysql.hostinger.in";
$mysql_database = "u494114538_harnk";
$mysql_user = "u494114538_harnk";
$mysql_password = "harank123";
 
$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database,$conn) or die(mysql_error());


if(isset($_GET['userId'])){

  $sql="SELECT COUNT(*) as count FROM `auto_availability` WHERE auto_status='A' LIMIT 1";
  $result=mysql_query($sql);
  $rs=mysql_result($result,0);
   if($rs > 0){
     $result =  mysql_query("SELECT auto_id FROM `auto_availability` WHERE auto_status='A' LIMIT 1");
     $rsId= mysql_result($result,0);
 
    mysql_query("INSERT INTO `autos_appointed`(`auto_id`, `appointed_start_datetime`, `appointed_end_datetime`) VALUES ('".$rsId."','".$_GET['dAt']."',ADDTIME('".$_GET['dAt']."','00:30:00'))");
       mysql_query("UPDATE `auto_availability` SET `auto_status`='E' WHERE auto_id='".$rsId."'");
      mysql_query("INSERT INTO user_appointment (user_id,auto_id,from_loc,to_loc,trip_status,trip_start_time,round_trip,trip_end_time) VALUES ('".$_GET['userId']."', '".$rsId."', '".$_GET['fromLoc']."', '".$_GET['toLoc']."', 'P', '".$_GET['dAt']."', '".$_GET['tripFlag']."',ADDTIME('".$_GET['dAt']."','00:15:00'))") or die(mysql_error());
     
    echo json_encode(array(status  => "success",message => "Appointment success at ".$_GET['dAt']." for autoId".$rsId."" ));

}

else{

$sql="SELECT TIMEDIFF(appointed_end_datetime,'".$_GET['dAt']."') as waitTime,auto_id FROM `autos_appointed` WHERE appointed_end_datetime>'".$_GET['dAt']."' ORDER BY appointed_end_datetime asc LIMIT 1";
$result=mysql_query($sql);
$rs=mysql_fetch_assoc($result);
   
echo json_encode(array(status  => "pending",message => "Please wait for ".$rs['waitTime']."  minutes to booking  autoId".$rs['auto_id']));

}


}
?>