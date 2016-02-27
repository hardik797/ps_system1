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
					foreach ($college_id as $key => $value)
					{
						echo '<option value="'.$key.'">'.$value.'</option>';		
					}
				?>
            </select>
        </div>
        <div>
        	<label>Select branch</label>
            <select name="branch_id" id="branch_id">
            	<option value="">-select-</option>
                <?php
					foreach ($branch_id as$key => $value)
					{
						echo '<option value="'.$key.'">'.$value.'</option>';	
					}
				?>
            </select>
        </div>
        <div>
        	<label>Select semester</label>
            <select name="semester" id="semester">
            	<option value="">-select-</option>
                <?php
					foreach ($semesters as $key => $value)
					{
						echo '<option value="'.$key.'">'.$value.'</option>';	
					}
				?>
            </select>
        </div>
        <div>
        	<label>Select student</label>
            <select name="student_name" id="student_name">
            	<option value="">-select-</option>
                <?php
					foreach ($student_name as $key => $value)
					{
						echo '<option value="'.$key.'">'.$value.'</option>';	
					}
				?>
            </select>
        </div>
        <div>
        	<label>Select subject</label>
            <select name="subject_id" id="subject_id">
            	<option value="">-select-</option>
                <?php
					foreach ($subject_id as $key => $value)
					{
						echo '<option value="'.$key.'">'.$value.'</option>';		
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