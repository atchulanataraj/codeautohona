<?php

header("Access-Control-Allow-Origin: *");
require_once('json.php');
$mysql_host = "mysql.hostinger.in";
$mysql_database = "u494114538_harnk";
$mysql_user = "u494114538_harnk";
$mysql_password = "harank123";
$currentLat="";
$currentLng="";
$from="";
$to="";

$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database,$conn) or die(mysql_error());

		
$posts=array();

$responsesData=array();
$responses=array();
 if($_GET['type']=='savelocation'){  

$sql ="INSERT INTO auto_location_data(auto_id,latitude,longitude,updated_time) VALUES ('".$_GET['autoid']."', '".$_GET['latitude']."', '".$_GET['longitude']."', CURRENT_TIMESTAMP);";

$retval = mysql_query( $sql, $conn );
 if(! $retval )
  {
       die('Could not enter data: ' . mysql_error());
  }
}
else if($_GET[type]=="register"){
$sql="INSERT INTO user_profile(user_id,first_name,last_name, user_pwd,user_phone,user_email) VALUES (NULL, '".$_GET['firstName']."', '".$_GET['lastName']."', '".$_GET['pwd']."', '".$_GET['phone']."', '".$_GET['email']."');";
$retval = mysql_query( $sql, $conn );
 if(! $retval )
  {
       die('Could not enter data: ' . mysql_error());
  }




}

else if($_GET['type']=='savereview'){

   $sql="INSERT INTO auto_reviews(auto_id, user_id, rating, comment) VALUES ('".$_GET['autoid']."', '".$_GET['userid']."', '".$_GET['rating']."', '".$_GET['comment']."');";
   
    $retval = mysql_query( $sql, $conn );
 if(! $retval )
  {
       die('Could not enter data: ' . mysql_error());
  }
  
    
 
}
else if(isset($_GET['type']) || isset($_GET['autoid']) ){

 if($_GET['type']=='autolist'){

$sql="SELECT ad.auto_id as autoid,ad.driver_name as drivername,ald.latitude,ald.longitude,ad.rating,ad.url,ad.dist,ad.phone_no as phonenum  FROM autodata ad,auto_location_data ald,auto_availability aa WHERE ad.auto_id=ald.auto_id and ad.auto_id=aa.auto_id and aa.auto_status='A' ORDER BY dist asc";
$currentLat=$_GET["currentLat"];
$currentLng=$_GET["currentLng"];
$result=mysql_query($sql);
if(mysql_num_rows($result)){
  $from = $_GET["currentLat"].",".$_GET["currentLng"];


					
						while($post = mysql_fetch_assoc($result))
						{
                                                       $to = $post["latitude"].",".$post["longitude"];
					                $post["dist"]=getDist($from,$to);
							$responses[]= $post;
					                //print_r($responses);
//echo "<br/>";
						}
					
					}
$source=str_replace(",",'%',$_GET['source']);
$destination=str_replace(",","%",$_GET['destination']);


$sql="select zone_rate as fare,zone_rpk as rpk from zone_rates where zone_id=( SELECT
        
        CASE WHEN count1 > count2  THEN (SELECT zr.zone_id FROM zone_locations zl,zone_rates zr WHERE zl.zone_id=zr.zone_id and zl.location_name LIKE '%".$source."%' LIMIT 1)
        ELSE
           (SELECT zrr.zone_id FROM zone_locations zll,zone_rates zrr WHERE zll.zone_id=zrr.zone_id and zll.location_name LIKE '%".$destination."%' LIMIT 1)
         
         END as zoneId
         FROM
        (
            SELECT
                  (SELECT zr2.zone_rate FROM zone_locations zl2,zone_rates zr2 WHERE zl2.zone_id=zr2.zone_id and zl2.location_name LIKE '%".$source."%' LIMIT 1) AS count1,
                       (SELECT zrr2.zone_rate FROM zone_locations zll2,zone_rates zrr2 WHERE zll2.zone_id=zrr2.zone_id and zll2.location_name LIKE '%".$destination."%' LIMIT 1) AS count2                     
                       
         ) as rates)";
$result=mysql_query($sql);

$from = $_GET["currentLat"].",".$_GET["currentLng"];
$to=$_GET["destLat"].",".$_GET["destLng"];

$fare= $result ?  mysql_fetch_assoc($result) : mysql_error() ;
$mainDist=getDist($from,$to);
$responsesData[]=array('data'=>$responses);
$fare["distance"]=$mainDist;
$responsesData[]=$fare;

}
else if($_GET['type']=='reviews' && isset($_GET['autoid'])){
$sql="SELECT r.user_id as userid,up.first_name as username,r.rating,r.comment FROM auto_reviews r,user_profile up WHERE r.user_id=up.user_id and r.auto_id='".$_GET['autoid']."'";

$result=mysql_query($sql);

if(mysql_num_rows($result)){
					
						while($post = mysql_fetch_assoc($result))
						{
					                
							$responses[]=$post;
					
						}
					
					}


$responsesData[]=array('data'=>$responses);
}
}

else
   $responsesData[]=array('data'=>'invalid url');
   
$responsesData[]=array('status'=>'1');


echo json_encode($responsesData);


function getDist($from,$to){




$from = urlencode($from);
$to = urlencode($to);

//$jsndata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
//$data = json_decode($jsndata);



$time = 0;
$distance = 0;

//foreach($data->rows[0]->elements as $road) {
//    $time += $road->duration->value;
//    $distance += $road->distance->value;
//}

$distance = 12000;
// echo "To: ".$data->destination_addresses[0];
//echo "<br/>";
//echo "From: ".$data->origin_addresses[0];
//echo "<br/>";
//echo "Time: ".$time." seconds";->
//$post["dist"]=$distance;
//echo "<br/>";
//echo "Distance: ".$distance." meters";

return $distance;
}
?>

		