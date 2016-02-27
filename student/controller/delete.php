<?php
    
    include('../config/database.php');

    //fetching data from database
	if (!isset($_GET['id']))
	{
		header('location:report.php?er = no action found');
	}
	else
	{		
		$id=trim($_GET['id']);

		$param = array($id);		
		
		//fetching data from database
		$sql = "delete FROM student_records where id = ? ";
		$result = execute_query($sql, $param);  
		
		if ($result == 1)
		{	
			header('location:../report.php?er = Record deleted successfully');
		}
		else
		{
            header('location:../report.php?er = You have following mysql error'.mysql_error());
		}
    }
?>