<?php
	include('student_data.php');
	include('../config/database.php');
	
	if (isset($_POST['update']))
	{
		$id = trim($_POST['id']);
		
		$college_id = trim($_POST['college_id']);
		$branch_id = trim($_POST['branch_id']);
		$semester = trim($_POST['semester']);
		$subject_id = trim($_POST['subject_id']);
		$student_name = trim($_POST['student_name']);
		$student_mark = trim($_POST['student_mark']);
		
		
		$sql = "update student_records set college_id = ?, branch_id = ?, semester = ?, subject_id = ?, student_name = ?, student_mark = ? where id = ?";
		$param = array($college_id, $branch_id, $semester, $subject_id, $student_name, $student_mark, $id);
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
		$sql = "select id, college_id, branch_id, semester, subject_id, student_name, student_mark from student_records where id=? ";
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
				<input type="text" name="college_id" id="college_id" value="<?php echo $college_id[$row['college_id']]; ?>" />
			</p>
        </div>    
        <div>
        	<label>student branch name</label>
			<p> 
				<input type="text" name="branch_id" id="branch_id" value="<?php echo $branch_id[$row['branch_id']]; ?>" />
			</p>
        </div>
        <div>
        	<label>student semester</label>
			<p> 
				<input type="text" name="semester" id="semester" value="<?php echo $semesters[$row['semester']]; ?>" />
			</p>
        </div>
        <div>
        	<label>student name</label>
			<p> 
				<input type="text" name="student_name" id="student_name" value="<?php echo $student_name[$row['student_name']]; ?>" />
			</p>
        </div>
        <div>
        	<label>subject name</label>
			<p> 
				<input type="text" name="subject_id" id="subject_id" value="<?php echo $subject_id[$row['subject_id']]; ?>" />
			</p>
        </div>
        <div>
        	<label>Update mark</label>
			<p> 
				<input type="text" name="student_mark" id="student_mark" value="<?php echo $row['student_mark']; }}} ?>" />
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
			var num =/[0-9]/;

			$("form").submit(function(e)
			{				
				if ($("#college_id").val() == "")
				{
					alert("Please select college from the list");
					$("#college_id").focus(); 
					return false;     
				}        
				else if ($("#branch_id").val() == "")
				{
					alert("Please select branch from the list");
					$("#branch_id").focus(); 
					return false;     
				}        
				else if ($("#semester").val() == "")
				{
					alert("Please select semester from the list");
					$("#semester").focus(); 
					return false;     
				}        
				else if ($("#student_name").val() == "")
				{
					alert("Please select student from the list");
					$("#student_name").focus(); 
					return false;     
				}        
				else if ($("#subject_id").val() == "")
				{
					alert("Please select subject from the list");
					$("#subject_id").focus(); 
					return false;     
				}        
				else if ($("#student_mark").val() == "")
				{
					alert("Please enter mark");
					$("#student_mark").focus(); 
					return false;     
				}        
				else if (!$("#student_mark").val().match(num))
				{
					alert("Mark should be only positive integer numbers only");
					$("#student_mark").focus(); 
					return false;     
				}   
				else if ($("#student_mark").val().length >= 3)
				{
					alert("Mark should be less then 100");
					$("#student_mark").focus(); 
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