<?php
	include('../includes/session.php');
	include('../config/database.php');
	

	if (isset($_POST['save']))
	{
		//checking whether variables are set or not?
		
		$user_id =$_POST['user_id'];
		$entry_datetime =date("y/m/d H:i:s",strtotime(($_POST['entry_datetime'])));
		$exit_datetime =date("y/m/d H:i:s",strtotime(($_POST['exit_datetime'])));
		
		
		//2016-02-18 03:00:00 Y/M?D H:I:S
		//server side validation for importants fields	
		if ($user_id == "")
		{
			$_SESSION['0']="please select <b>USER</b> from the list";	
		}
		else
		{
			$_SESSION['user_id']=$user_id;
		}
		if ($entry_datetime == "")
		{
			$_SESSION['1']="Please enter <b>Entry Time</b> of the User";		
		}
		else
		{
			$_SESSION['entry_datetime']= $entry_datetime;	
		}
		if ($exit_datetime == "")
		{
			$_SESSION['2']="Please enter <b>Exit Time</b> of the User";		
		}
		else
		{
			$_SESSION['exit_datetime']= $exit_datetime;	
		}


		//inserting data to database
		$sql="insert into attendance(user_id, entry_datetime, exit_datetime) values(?, ?, ?)";
		$param=array($user_id,$entry_datetime,$exit_datetime);
		$result = execute_query($sql,$param);

		//checking whether data inserted or not ?
		if ($result == 1)
		{
			session_destroy();
			header('location: ../index.php?er=Data Inserted Successfully');
		}
				
	}
?>	