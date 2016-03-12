<?php
include("../includes/session.php");
include("../config/database.php");
	foreach ($_POST as $key => $value)
	{
		$$key = trim($value);	
	}
	/* below query fire for check email and user_name duemail_duplicate */
	$result = get_rows("select user_name, email, password from  user_registration");

	$_SESSION['errors'] = array();
	if (!preg_match("/^[A-Za-z]{3,50}$/", $first_name))
	{
		$_SESSION['errors']['first_name'] = "Please enter valid firstname";	
	}
	if (!preg_match("/^[A-Za-z]{3,50}$/", $last_name))
	{
		$_SESSION['errors']['last_name'] = "Please enter valid lastname" ;	
	}
	if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$/", $email))
	{
		$_SESSION['errors']['email'] = "Please enter email";	
	}
	if (!preg_match("/^[A-Za-z0-9]{3,50}$/", $user_name))
	{
		$_SESSION['errors']['user_name'] = "Please enter username";	
	}
	/* it is code for to ckeck duplicate username and email*/

	if(isset($email))
	{
		foreach ($result as $row) 
		{
			if($email == $row['email'])
			{
				$_SESSION['errors']['email_duplicate'] = "<b>".$row['email']."</b>&nbsp;it is already exists, please enter other. ";
				break;
			}	
		}
	}
	if(isset($user_name))
	{
		foreach ($result as $row) 
		{
			if($user_name == $row['user_name'])
			{
				$_SESSION['errors']['user_name_duplicate'] = "<b>".$row['user_name']."</b>&nbsp;it is already exists, please enter other. ";
				break;
			}	
		}
	}
	if (!preg_match("/^[A-Za-z0-9!@#$%^&*()_]{3,20}$/", $password))
	{
		$_SESSION['errors']['password'] = "Please enter password";	
	}
	if (empty($confirm_password) || $password != $confirm_password)
	{
		$_SESSION['errors']['confirm_password'] = "Password & confirm_password not match " ;	
	}
	if (empty($country))
	{
		$_SESSION['errors']['country'] = "Please enter countey";	
	}
	if (!preg_match("/^[A-Za-z]{3,50}$/", $state))
	{
		$_SESSION['errors']['state'] = "Please enter state";	
	}
	if (!preg_match("/^[A-Za-z]{3,50}$/", $city))
	{
		$_SESSION['errors']['city'] = "Please enter city";	
	}
	if (empty($address_line1))
	{
		$_SESSION['errors']['address_line1'] = "Please enter address_line1";	
	}
	if (empty($address_line2))
	{
		$_SESSION['errors']['address_line2'] = "Please enter address_line2";	
	}
	if (!preg_match("/^[0-9]{6}$/", $zipcode))
	{
		$_SESSION['errors']['zipcode'] = "Please enter zipcode";	
	}
	if (count($_SESSION['errors']) == 0)
	{
		$result = execute_query("insert into user_registration(first_name, last_name, email, user_name, password, country, state, city, address_line1, address_line2, zipcode) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($first_name, $last_name, $email, $user_name, md5($password), $country, $state, $city, $address_line1, $address_line2, $zipcode));
			$_SESSION['user'] = $user_name;
		header('location: ../user/myprofile.php');

		$_SESSION['message'] = 'Your entry has been inserted.';
	}
	else
	{
		$_SESSION['data'] = $_POST;	
		header('location: ../user/user_registration.php');
	}
	
	












?>
