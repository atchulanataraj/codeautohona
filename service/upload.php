<?php
 header("Access-Control-Allow-Origin: *");
require_once('json.php');
$mysql_host = "mysql.hostinger.in";
$mysql_database = "u494114538_harnk";
$mysql_user = "u494114538_harnk";
$mysql_password = "harank123";

$conn = mysql_connect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database,$conn) or die(mysql_error());


if(isset($_REQUEST['AddFiles'])){

              $targetFolder = 'uploads'; 
              $newName=1;//Path to the Uploads Folder 
   if (!empty($_FILES)) {
		for($i=0;$i<count($_FILES['upload_file']['name']);$i++){
			if (file_exists("uploads/" . $_FILES["upload_file"]["name"][$i]))
			{
				$filePart = explode('.', $_FILES["upload_file"]["name"][$i]);
				$_FILES["upload_file"]["name"][$i]=($filePart[0].'_'.$newName.'.'.$filePart[count($filePart)-1]);
				
				for(;file_exists("uploads/" . $_FILES["upload_file"]["name"][$i]);)
					$_FILES["upload_file"]["name"][$i]=($filePart[0].'_'.($newName++).'.'.$filePart[count($filePart)-1]);
				
                 $newName=1;$i--;
			}
			else{
			
			$tempFile = $_FILES['upload_file']['tmp_name'][$i];
			$targetFile = rtrim($targetFolder,'/') . '/' . $_FILES['upload_file']['name'][$i];
			$fileTypes = array('jpeg','jpg','png','gif'); // Allowed File extensions
			$fileParts = pathinfo($_FILES['upload_file']['name'][$i]);
			if(isset($fileParts['extension'])){
				if (in_array($fileParts['extension'],$fileTypes)) {
					
				
					move_uploaded_file($tempFile,$targetFile);
					$sql="INSERT INTO `autoads`(`auto_id`, `ad_url`, `ad_date`, `ad_status`) VALUES (".$_POST['autoId'].",'http://autohonatest.meximas.com/service/uploads/".$_FILES['upload_file']['name'][$i]."',CURRENT_TIMESTAMP,1)";
					$retval = mysql_query( $sql, $conn );
					if(! $retval )
					{
						die('Could not enter data: ' . mysql_error());
					}
					
					//echo '<div class="success">'.$_FILES['upload_file']['name'][$i].' was saved successfully inside '.$targetFolder.' Directory</div>';
					
				}else{
					//echo '<div class="fail">'.$_FILES['upload_file']['name'][$i].' couldn\'t be saved because of invalid file type.</div>';
				}
			}else{
				//echo '<div class="fail">'.$_FILES['upload_file']['name'][$i].' couldn\'t be saved because of invalid file type.</div>';
			}
		}
		}
		$json['statusText'] ="success";
		$json['error']="all is well";
		echo json_encode($json);
	}
}

?>