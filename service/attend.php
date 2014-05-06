<?php

header("Access-Control-Allow-Origin: *");
require_once('json.php');
$mysql_host = "mysql.hostinger.in";
$mysql_database = "u494114538_yah";
$mysql_user = "u494114538_yah";
$mysql_password = "harank123";


$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database,$conn) or die(mysql_error());

$sql= "SELECT * FROM `attendance` ORDER BY attend_date,employeeId asc";
$result= mysql_query($sql);
echo "<html><head><style>";
echo "body{ font-size: 12pt;font-family: Calibri;padding : 10px;text-align:center;}";
echo "table{width:80%;margin: 0px auto;text-align:center;}th{padding: 5px;background-color:#258ecd;color:white;}";
echo "td{background-color:#EEE;color: #258ecd;padding: 5px;}";
echo "input{font-size: 12pt;font-family: Calibri;}#dvData{text-align:center;}";


echo "</style></head><body>";
echo "<input type=\"button\"  value=\"Get Report\" onClick=\"window.open('data:application/vnd.ms-excel,' + document.getElementById('dvData').innerHTML);\"></body></html>";
echo "<div id='dvData'>";
echo "<table>";
echo "<tr>";
echo "     <th>Date </th>";
echo "        <th>Surya<br>AH0012</th>";
echo "        <th>Tagore<br>AH0013</th>";
echo "        <th>Nataraj<br>AH0014</th>";
echo "        <th>Srinivas<br>AH0015</th>";
echo "    </tr>";

while($post = mysql_fetch_assoc($result))
						{
                                                      $temp="<tr><td>".$post['attend_date']."</td><td>".$post['status']."</td>";
                                                      $post = mysql_fetch_assoc($result);
					               $temp=$temp."<td>".$post['status']."</td>";
                                                            $post = mysql_fetch_assoc($result);
					               $temp=$temp."<td>".$post['status']."</td>";
                                                      $post = mysql_fetch_assoc($result);
					               $temp=$temp."<td>".$post['status']."</td></tr>";

                                                        echo $temp;

						}
echo "</table>";

echo  "</body></html>";




?>	