<?php
header("Access-Control-Allow-Origin: *");
require_once('json.php');

$mysql_host = "mysql.hostinger.in";
$mysql_database = "u494114538_harnk";
$mysql_user = "u494114538_harnk";
$mysql_password = "harank123";

$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database,$conn) or die(mysql_error());

$mysql_host2 = "mysql.hostinger.in";
$mysql_database2 = "u494114538_yah";
$mysql_user2 = "u494114538_yah";
$mysql_password2 = "harank123";


$conn2 = mysql_connect($mysql_host2, $mysql_user2, $mysql_password2) or die(mysql_error());
mysql_select_db($mysql_database2,$conn2) or die(mysql_error());




		
$posts=array();

$responsesData=array();
$responses=array();


if($_GET['type']=='checkCompany'){

   $sql="SELECT COUNT(*) FROM `company_profile` WHERE UPPER(company_name)=UPPER('".$_GET['compName']."')";
   $res=mysql_query($sql);
 $exist=mysql_result($res,0);
   if($exist>0){

  $responsesData[]=array('message'=>'company name already exists');
  $responsesData[]=array('status'=>'0');
      
     }
    else{
 $responsesData[]=array('message'=>'company name available');
  $responsesData[]=array('status'=>'1');
 
} 

}
else if($_GET['type']=='checkUser'){

   $sql="SELECT COUNT(*) FROM `company_profile` WHERE UPPER(user_name)=UPPER('".$_GET['compUname']."')";
   $res=mysql_query($sql);
 $exist=mysql_result($res,0);
   if($exist>0){

  $responsesData[]=array('message'=>'user name already exists');
  $responsesData[]=array('status'=>'0');
      
     }
    else{
 $responsesData[]=array('message'=>'user name available');
  $responsesData[]=array('status'=>'1');
 
} 

}
else if($_GET['type']=='register'){
  
  $comp_name=$_GET['compName'];
$comp_mail=$_GET['compMail'];
$comp_contact=$_GET['compContact'];
$comp_addr=$_GET['compAddr'];
$comp_uname=$_GET['compUname'];
$comp_pwd=md5($_GET['compPwd']);

$sql= "INSERT INTO `u494114538_yah`.`company_profile` (`companyId`, `company_name`, `company_mail`, `company_contact`, `company_addr`, `user_name`, `user_pwd`) VALUES (NULL, '".$comp_name."', '".$comp_mail."', '".$comp_contact."', '".$comp_addr."', '".$comp_uname."', '".$comp_pwd."');";

mysql_query($sql,$conn2) or die('Data Error: ' . mysql_error());


 $responsesData[]=array('message'=>'Registration Successful');
   

$responsesData[]=array('status'=>'1');

header('Location: http://autohonatest.meximas.com/autohonaAds/Login.php');

 }
else if($_GET['type']=='getUrls'){
$sql="SELECT ad_url FROM `autoads` WHERE auto_id=".$_GET['autoId']." and ad_status=1 ORDER BY ad_date desc";

$result=mysql_query($sql);

if(mysql_num_rows($result) <> $_GET['adCount']){
					
						while($post = mysql_fetch_assoc($result))
						{
					
							$responses[]=$post;
					
						}
					
					}

$responsesData[]=array('data'=>$responses);
$responsesData[]=array('status'=>'1');
}


else{
   $responsesData[]=array('data'=>'invalid url');
   

$responsesData[]=array('status'=>'0');

}


echo json_encode($responsesData);

?>

