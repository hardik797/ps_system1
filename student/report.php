<?php
	include('config/database.php');
	include('controller/student_data.php');
	
    //fetching data from database
	$sql = "select id, college_id, branch_id, semester, subject_id, student_name, student_mark from student_records ";

	$result = fetch_data($sql);  
	$length = count($result);
	if ($length == 0)
	{	
		echo "<strong>No any record found</strong>";
	}
	else
	{		

?>
	<!-- Displaying Data from database -->
   	
	<table border="3" cellpadding="5" cellspacing="5" style="color:green;font-weight:bold;font-size:20px;" >
		<caption>Student records</caption>
		<thead>
			<tr>
                <td>Action</td>
                <td>Student name</td>
                <td>College name</td>
                <td>Branch name</td>
                <td>Semester name</td>
                <td>Subject name</td>
                <td>Subject-wise marks</td>
			</tr>
		</thead>
<?php
		// for displaying student details
        foreach ($result as $row)
        {

?>        
		<tbody style="color:purple;font-weight:bold;font-size:20px;">
			<tr>

            	<td>
					<a href="controller/delete.php?id=<?=$row['id']?>" onclick="return confirm('are you sure want to delete?');">Delete</a>
                </td>
                <td><?php echo $student_name[$row['student_name']]; ?></td>
				<td><?php echo $college_id[$row['college_id']]; ?></td>
				<td><?php echo $branch_id[$row['branch_id']]; ?></td>
				<td><?php echo $semesters[$row['semester']]; ?></td>
				<td><?php echo $subject_id[$row['subject_id']]; ?></td>
				<td><?php echo $row['student_mark']; ?></td>

			</tr>
		</tbody>
<?php
        }// foreach end here

    }//main else end here
?>        
	</table><br><br>
    <a style="color:navy;font-weight:bolder;font-size:25px;" href="index.php">Go back</a>
   