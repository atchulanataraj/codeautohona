<?php
 header("Access-Control-Allow-Origin: *");
require_once('json.php');

$posts=array();
$responses=array();
if($GET['ctoken']=='token123')
   
{
$responses['status']=array('status'=>'1','msg'=>'success')
$responses['data']=array('autoid'=>'1001','drivername'=>'Varun','latitude'=>'17.434044','longitude'=>'78.445608','rating'=>'5','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'100','phonenum'=>'9177007501');
$responses[]=array('autoid'=>'1002','drivername'=>'Nitin','latitude'=>'17.4276868','longitude'=>'78.45356','rating'=>'4','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'200','phonenum'=>'9177007500');
$responses[]=array('autoid'=>'1003','drivername'=>'Sunil','latitude'=>'17.440254','longitude'=>'78.442734','rating'=>'3','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'120','phonenum'=>'9177007502');
$responses[]=array('autoid'=>'1004','drivername'=>'Sampoornesh','latitude'=>'17.361564','longitude'=>'78.474665','rating'=>'2','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'400','phonenum'=>'9177007503');
$responses[]=array('autoid'=>'1005','drivername'=>'Nagarjuna','latitude'=>'17.392181','longitude'=>'78.440996','rating'=>'3','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'500','phonenum'=>'9177007504');
$responses[]=array('autoid'=>'1006','drivername'=>'Venkatesh','latitude'=>'17.236609','longitude'=>'78.429531','rating'=>'4','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'350','phonenum'=>'9177007505');
$responses[]=array('autoid'=>'1007','drivername'=>'Chiranjeevi','latitude'=>'17.45061','longitude'=>'78.470514','rating'=>'2','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'700','phonenum'=>'9177007506');
$responses[]=array('autoid'=>'1008','drivername'=>'Balayya','latitude'=>'17.429238','longitude'=>'78.412278','rating'=>'1','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'1000','phonenum'=>'9177007507');
$responses[]=array('autoid'=>'1009','drivername'=>'Naresh','latitude'=>'17.39924','longitude'=>'78.470322','rating'=>'4','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'650','phonenum'=>'9177007508');
$responses[]=array('autoid'=>'1010','drivername'=>'Ramarao','latitude'=>'17.383366','longitude'=>'78.400677','rating'=>'5','url'=>'http://www.haranktechnologies.com/images/logo/1.png','dist'=>'720','phonenum'=>'9177007509');

}
else
 $responses[]=array('status'=>'1','msg'=>'token error');

echo json_encode($responses);

?>

