<?php
	include('controller/student_data.php');
	include('config/database.php');
	
	//for storing errors
	$er='';

	if (isset($_POST['insert']))
	{
		$college_id = trim($_POST['college_id']);
		$branch_id = trim($_POST['branch_id']);
		$semester = trim($_POST['semester']);
		$subject_id = trim($_POST['subject_id']);
		$student_name = trim($_POST['student_name']);
		$student_mark = trim($_POST['student_mark']);
		
		$sql = "insert into student_records (college_id, branch_id, semester, student_name, subject_id, student_mark) values(?, ?, ?, ?, ?, ?)";
		$param = array($college_id, $branch_id, $semester, $student_name, $subject_id, $student_mark);
		$result = execute_query($sql, $param);
		
		if ($result == 1)
		{
			$er = "Data inserted successfully";
		}
		else
		{
			$er = "Something wrong in your database configuration".mysql_error();
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
        <meta http-equiv="Content-Type" content="text/html,css,javascript,jquery; charset=utf-8" />
		
        <title>Student_Data</title>
        <link type="text/css" rel="stylesheet" href="css/std_record.css" />
		
</head>

<body>
	<span> <?php if (isset($_GET['er'])){ echo $_GET['er']; } echo $er; ?></span>
	<form method="post">
    	<div><br />
        	<label>Select college</label>
            <select name="college_id" id="college_id">
            	<option value="">-select-</option>
                <?php
					foreach ($college_id as $key => $clg)
					{
						echo $key;
						echo $clg;

						echo "<option values='".$clg."'>".$key."</option>";	
					}
				?>
            </select>
        </div>
        <div>
        	<label>Select branch</label>
            <select name="branch_id" id="branch_id">
            	<option value="">-select-</option>
                <?php
					foreach ($branche_id as$key => $branch)
					{
						echo $key;
						echo $branch;
						echo "<option values='".$key."'>".$branch."</option>";	
					}
				?>
            </select>
        </div>
        <div>
        	<label>Select semester</label>
            <select name="semester" id="semester">
            	<option value="">-select-</option>
                <?php
					foreach ($semesters as $key => $sem)
					{
						echo $key;
						echo $sem;
						echo "<option values='".$key."'>".$sem."</option>";	
					}
				?>
            </select>
        </div>
        <div>
        	<label>Select student</label>
            <select name="student_name" id="student_name">
            	<option value="">-select-</option>
                <?php
					foreach ($student_name as $key => $name)
					{
						echo $key;
						echo $name;
						echo "<option values='".$key."'>".$name."</option>";	
					}
				?>
            </select>
        </div>
        <div>
        	<label>Select subject</label>
            <select name="subject_id" id="subject_id">
            	<option value="">-select-</option>
                <?php
					foreach ($subject_id as $key => $sub)
					{
						echo $key;
						echo $sub;
						echo "<option values='".$key."'>".$sub."</option>";	
					}
				?>
            </select>
        </div>
        <div><br>
        	<label>Enter mark</label>
			<input type="text" name="student_mark" id="student_mark"  />
			
        </div>
        <div>
        	<input type="submit" name="insert" value="Submit" />
        </div>
        <div>
        	<input type="button" name="report" value="Reports" onclick="window.location.href='report.php';"/>
        </div>
        
    </form>
	
	<!-- Javascript, jQuery goes here  -->
    <script type="text/javascript" src="js/jquery.js"></script>
	<script>
		$(document).ready(function()
		{
			var num =/[0-9]/;

			$("form").submit(function(e)
			{				
				if ($("#std_college").val() == "")
				{
					alert("Please select college from the list");
					$("#std_college").focus(); 
					return false;     
				}        
				else if ($("#std_branch").val() == "")
				{
					alert("Please select branch from the list");
					$("#std_branch").focus(); 
					return false;     
				}        
				else if ($("#std_semester").val() == "")
				{
					alert("Please select semester from the list");
					$("#std_semester").focus(); 
					return false;     
				}        
				else if ($("#std_name").val() == "")
				{
					alert("Please select student from the list");
					$("#std_name").focus(); 
					return false;     
				}        
				else if ($("#std_subject").val() == "")
				{
					alert("Please select subject from the list");
					$("#std_subject").focus(); 
					return false;     
				}        
				else if ($("#std_mark").val() == "")
				{
					alert("Please enter mark");
					$("#std_mark").focus(); 
					return false;     
				}        
				else if (!$("#std_mark").val().match(num))
				{
					alert("Mark should be only positive integer numbers only");
					$("#std_mark").focus(); 
					return false;     
				}   
				else if ($("#std_mark").val().length >= 3)
				{
					alert("Mark should be less then 100");
					$("#std_mark").focus(); 
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