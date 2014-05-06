<?php

// Inialize session
session_start();

//db connect

$mysql_host= "mysql.hostinger.in";
$mysql_database = "u494114538_yah";
$mysql_user = "u494114538_yah";
$mysql_password = "harank123";


$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database,$conn) or die(mysql_error());


$sql="SELECT * FROM company_profile WHERE (user_name = '" . mysql_real_escape_string($_GET['comp_uname']) . "') and (user_pwd = '" . mysql_real_escape_string(md5($_GET['comp_pwd'])) . "')";


// Retrieve username and password from database according to user's input
$login = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_row($login);
// Check username and password match
if (mysql_num_rows($login) == 1) {
// Set username session variable
$_SESSION['username'] = $_GET['comp_uname'];
$_SESSION['companyId']= $row[0];
// Jump to secured page
header('Location: http://autohonatest.meximas.com/autohonaAds/Home.php');
}
else {
// Jump to login page
header('Location: http://autohonatest.meximas.com/autohonaAds/Login.php');
}

?>