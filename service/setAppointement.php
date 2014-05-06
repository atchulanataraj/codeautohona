<?php
header("Access-Control-Allow-Origin: *");
require_once('json.php');
$mysql_host = "mysql.hostinger.in";
$mysql_database = "u494114538_harnk";
$mysql_user = "u494114538_harnk";
$mysql_password = "harank123";

$conn = mysql_connect ( $mysql_host, $mysql_user, $mysql_password ) or die ( mysql_error () );
mysql_select_db ( $mysql_database, $conn ) or die ( mysql_error () );

if($_GET ['type'] == 'bookingAuto'){
	
if (isset ( $_GET ['userId'] )) {
   

$sql = "SELECT auto_id FROM autodata WHERE auto_id NOT IN (SELECT auto_id FROM  `user_appointment` WHERE (`trip_start_time` >=  '".$_GET['timeS']."' AND  `trip_end_time` <=   ADDTIME('".$_GET['timeS']."','00:30')) OR (`trip_start_time` <  '".$_GET['timeS']."' AND  `trip_end_time` >    ADDTIME('".$_GET['timeS']."','00:30') ) OR  (`trip_start_time` <  '".$_GET['timeS']."' AND  `trip_end_time` <    ADDTIME('".$_GET['timeS']."','00:30') AND trip_end_time > '".$_GET['timeS']."' ) OR  (`trip_start_time` >  '".$_GET['timeS']."' AND  `trip_start_time` <    ADDTIME('".$_GET['timeS']."','00:30') AND trip_end_time > ADDTIME('".$_GET['timeS']."','00:30') )) ORDER BY RAND()";

	$retval = mysql_query ( $sql, $conn ) 	or die ( 'Error: ' . mysql_error () );
	
	$val = mysql_result( $retval,0 );
	
	if ($val== 0) {
		
		//$quer = "SELECT auto_id, TIMEDIFF(appointed_end_datetime,'2014-04-25 08:30:00')  as diffTime FROM autos_appointed ORDER BY diffTime limit 1;";
		
		//$autotime = mysql_query ( $quer, $conn ) 	or die ( 'Could not enter data: ' . mysql_error () );

		//$getAutoTime = mysql_fetch_row ( $autotime );
		//$are = $getAutoTime[0];
		$response = array (
				'status' => 'pending',
				'message' => array (
						'autoId' => '1001',
						'waitingTime' => '00:30' 
				) 
		);
		echo json_encode ( $response );
	} 
	else {
		//$resultId = mysql_query ( "SELECT auto_id FROM `auto_availability` WHERE auto_status='A' LIMIT 1", $conn ) or	die ( 'Data Error: ' . mysql_error () );
		
		
		
		$autoId = $val; //mysql_result ( $resultId, 0 );
		mysql_query ( "INSERT INTO user_appointment(user_id, auto_id, from_loc, to_loc, trip_status, trip_start_time, trip_start_date,round_trip, trip_end_time, trip_end_date) VALUES ('" . $_GET ['userId'] . "', $autoId, '" . $_GET ['fromLoc'] . "', '" . $_GET ['toLoc'] . "', 'P', '" . $_GET ['timeS'] . "','" . $_GET ['dateS'] . "', '" . $_GET ['tripFlag'] . "' , ADDTIME('".$_GET['timeS']."','00:30'), '" . $_GET ['dateE'] . "')" ) or	die ( 'Data Error: ' . mysql_error () );
		echo json_encode ( array (
				"status" => "success",
				"message" => "Auto Booked for ".$autoId 
		) );
		
		//$updateSql = "UPDATE `auto_availability` SET auto_status='E' WHERE  `auto_id` = $autoId";
		//$updateResult = mysql_query ( $updateSql, $conn ) or	die ( 'Data Error: ' . mysql_error () );
	}
}
else{

	$responsesData [] = array (
			'status' => 'UserId missing in request'
	);
	
	echo json_encode ( $responsesData );
	
}

} else if ($_GET ['type'] == 'delayBooking') {	             
	$bookauto = "INSERT INTO `autos_appointed`(`auto_id`, `appointed_start_date`, `appointed_start_time`, `appointed_end_date`, `appointed_end_time`) VALUES ('" . $_GET ['autoId'] . "','" . $_GET ['datF'] . "','" . $_GET ['timeF'] . "','" . $_GET ['datL']. "' , ADDTIME('" . $_GET ['timeL'] . "', '00:30:00'));";
	$autoed = mysql_query ( $bookauto, $conn );
	if (! $autoed) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	echo json_encode ( array (
			"status" => "autobooked" 
	) );
	
} else if ($_GET ['type'] == 'adminPanel') {
	$apav = "SELECT * FROM `autos_appointed` WHERE appointed_start_date>now()";
	$res = mysql_query ( $apav, $conn );
	if (! $res) {
		die ( 'Could not enter data: ' . mysql_error () );
	}
	if (mysql_num_rows ( $res )) {
		
		while ( $post = mysql_fetch_assoc ( $res ) ) {
			
			$responses [] = $post;
		}
		$responsesData [] = array (
				'data' => $responses
		);
	} else {
		$responsesData [] = array (
				'data' => NULL 
		);
	}
	echo json_encode ( $responsesData );
}
else{
	
	$responsesData [] = array (
			'status' => 'request error try to add parameters and send it again'
	);
	
	echo json_encode ( $responsesData );
	
}

?>