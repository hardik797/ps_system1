<?php
include("../includes/session.php");
include("../config/database.php");


	foreach ($_POST as $key => $value)	
	{
		$$key = trim($value);	
	}

	$_SESSION['errors'] = array();

	if (!preg_match("/^[A-Za-z]{3,50}$/", $user_name))
	{
		$_SESSION['errors'][] = "Please enter username";	
	}
	if (!preg_match("/^[A-Za-z0-9!@#$%^&*()_]{3,20}$/", $password))
	{
		$_SESSION['errors'][] = "Please enter password";	
	}
	if(count($_SESSION['errors']) == 0)
	{	
		$result = get_rows("select user_name, email, password from  user_registration");
		foreach ($result as $row) 
		{
			if(($user_name == $row['user_name'] || $user_name == $row['email']) && 
				(md5($password) == $row['password']))
				{
					$_SESSION['user'] = $row['user_name'];
					echo $_SESSION['user'];
					break;
				}	
		}
		if(isset($_SESSION['user']))
		{
			header("location: ../user/myprofile.php");	
		}
		else
		{
			$_SESSION['errors'][] = "Username & password not match";
			header("Location: ../user/login.php");

		}


	}
	else
	{
		$_SESSION['data'] = $_POST;
		header("Location: ../user/login.php");
	}
	
?>
