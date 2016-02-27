<?php
	include('student_data.php');
	include('../config/database.php');
	
	if (isset($_POST['update']))
	{
		$id = trim($_POST['id']);
		$std_college = trim($_POST['std_college']);
		$std_branch = trim($_POST['std_branch']);
		$std_semester = trim($_POST['std_semester']);
		$std_subject = trim($_POST['std_subject']);
		$std_name = trim($_POST['std_name']);
		$std_mark = trim($_POST['std_mark']);
		
		$sql = "update student_records set std_college = ?, std_branch = ?, std_semester = ?, std_subject = ?, std_name = ?, std_mark = ? where id = ?";
		$param = array($std_college, $std_branch, $std_semester, $std_subject, $std_name, $std_mark, $id);
		$result = execute_query($sql, $param);
		
		if ($result == 1)
		{
			header('location:../report.php?er=Data updated successfully');
		}
		else
		{
			$er = "Something wrong in your database configuration".mysql_error();
		}
	}
	
	
	
	//fetching data from database
	if (!isset($_GET['id']))
	{
		header('location:report.php?er=no action found');
	}
	else
	{		
		$id=$_GET['id'];
		$param = array($id);		
		
		//fetching data from database
		$sql = "SELECT std_college, std_branch, std_semester, std_subject, std_name, std_mark FROM student_records where id=? ";
		$result = fetch_data($sql, $param);  
		$length = count($result);
		if ($length == 0)
		{	
			echo "<strong>No any record found</strong>";
		}
		else
		{
			foreach ($result as $row)
			{

	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
        <meta http-equiv="Content-Type" keywords="text/html,css,javascript,jquery;" charset="utf-8" />
		
        <title>Edit_Data</title>
        <link type="text/css" rel="stylesheet" href="../css/std_record.css" />
		
</head>

<body>
	<span> <?php if (isset($_GET['er'])){ echo $_GET['er']; } echo $er; ?></span>
	<form method="post">
    	<!-- hidden input for ID -->
        <input type="hidden" name="id" value="<?=$id?>">
    	<div>
        	<label>student college name</label>
			<p> 
				<input type="text" name="std_college" id="std_college" value="<?php echo $row['std_college']; ?>" />
			</p>
        </div>    
        <div>
        	<label>student branch name</label>
			<p> 
				<input type="text" name="std_branch" id="std_branch" value="<?php echo $row['std_branch']; ?>" />
			</p>
        </div>
        <div>
        	<label>student semester</label>
			<p> 
				<input type="text" name="std_semester" id="std_semester" value="<?php echo $row['std_semester']; ?>" />
			</p>
        </div>
        <div>
        	<label>student name</label>
			<p> 
				<input type="text" name="std_name" id="std_name" value="<?php echo $row['std_name']; ?>" />
			</p>
        </div>
        <div>
        	<label>subject name</label>
			<p> 
				<input type="text" name="std_subject" id="std_subject" value="<?php echo $row['std_subject']; ?>" />
			</p>
        </div>
        <div>
        	<label>Update mark</label>
			<p> 
				<input type="text" name="std_mark" id="std_mark" value="<?php echo $row['std_mark']; }}} ?>" />
			</p>
        </div>
        <div>
        	<input type="submit" name="update" value="Submit" />
        </div>
    </form>
	
	<!-- Javascript, jQuery goes here  -->
    <script type="text/javascript" src="../js/std_data.js"></script>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script>
		$(document).ready(function()
		{
			var num = /[0-9]+$/;
			var valid = /[3]/;

			$('form').submit(function()
			{
				if ($("#std_college").val() == "")
				{
					alert("College name is require field");
					$("#std_college").focus(); 
					return false;     
				}        
				else if ($("#std_branch").val() == "")
				{
					alert("Branch is require field");
					$("#std_branch").focus(); 
					return false;     
				}        
				else if ($("#std_semester").val() == "")
				{
					alert("Please select semester from the list").css("color", "red");
					$("#std_semester").focus(); 
					return false;     
				}        
				else if ($("#std_name").val() == "")
				{
					alert("Student name is require field");
					$("#std_name").focus(); 
					return false;     
				}        
				else if ($("#std_subject").val() == "")
				{
					alert("Subject is require field");
					$("#std_subject").focus(); 
					return false;     
				}        
				else if ($("#std_mark").val() == "")
				{
					alert("Mark is require field");
					$("#std_mark").focus(); 
					return false;     
				}        
				else if (!$("#std_mark").val().match(num))
				{
					alert("Mark should be only positive integer numbers only");
					$("#std_mark").focus(); 
					return false;     
				}   
				else if ($("#std_mark").val().length >=3)
				{
					alert("Mark should be less then 100 and valid");
					$("#std_mark").focusin(); 
					return false;  
				}
				else
				{
					return true;
				}
			});
		});
	</script>
</body>
</html>