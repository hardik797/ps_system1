<?php
include("../includes/session.php");
include("../config/database.php");
if(isset($_SESSION['user']))
{
	
		
		/*$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);*/
		echo $file_loc = $_FILES['file']['tmp_name']."<br/>";
		echo $file_size = $_FILES['file']['size']."<br/>";
		echo $file_type = $_FILES['file']['type']."<br/>";
		echo $final_file = $_FILES['file']['name']."<br/>";
		//echo $target_dir = "../upload/".$final_file;
		echo $target_dir = "/var/www/ps_system/mehul/upload/";
		echo $target_file = $target_dir . basename($_FILES["file"]["name"]);

		 $success = move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
		 if($success)
		 {
		 	echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
		 }
        	
   		 
	echo "hi";
}
else
{
	header("location: ../user/login.php");
}
?>