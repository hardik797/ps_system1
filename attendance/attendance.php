<?php
	session_start();

	include('database.php');
	$co = mysqli_connect("localhost","root","root","test");

	$entry = $_POST['entry_time'];
	$exit = $_POST['exit_time'];
	$id = $_POST['user_id'];

/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/
/*													Generating All Hours code goes here                                                          */
/*																								                                                 */
/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/

	
	if($_POST['status']== "all")
	{
		$result = mysqli_query($con,"SELECT `id`, `entry_datetime`,`exit_datetime` FROM `attendance` WHERE entry_datetime >= '".$entry."' AND exit_datetime <='".$exit."' AND user_id = '".$id."'");
		echo "<table border=1><th>ID</th><th>Entry DateTime</th><th>Exit DateTime</th>";
		foreach ($result as $rows) 
		{
			echo "<tr><td>" . $rows['id']. "</td> <td>". $rows['entry_datetime'] . "</td><td>" . $rows['exit_datetime'] . "</td></tr>";
		}
		echo "</table>";
	}
/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/
/*													Generating letest hours code goes here                                                       */
/*																								                                                 */
/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/


	if($_POST['status'] == "latest")
	{
		$result2 = get_rows("select entry_datetime, exit_datetime from attendance where user_id = ? and entry_datetime >= ? and exit_datetime <= ? ORDER BY entry_datetime DESC LIMIT 1", array($id, $entry, $exit));
    	echo "<table border=1><th>Entry Datetime</th><th>Exit Datetime</th>";
		foreach ($result2 as $rows) 
		{
			echo "<tr><td>". $rows['entry_datetime'] . "</td><td>" . $rows['exit_datetime'] . "</td></tr>";
		}
		echo "</table>";
	
	}

/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/
/*													Generating Oldest Hours code goes here                                                       */
/*																								                                                 */
/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/

	if($_POST['status'] == "oldest")
	{
		$result2 = get_rows("select entry_datetime, exit_datetime from attendance where user_id = ? and entry_datetime >= ? and exit_datetime <= ? ORDER BY entry_datetime ASC LIMIT 1", array($id, $entry, $exit));
    	echo "<table border=1><th>Entry Datetime</th><th>Exit Datetime</th>";
		foreach ($result2 as $rows) 
		{
			echo "<tr> <td>". $rows['entry_datetime'] . "</td><td>" . $rows['exit_datetime'] . "</td></tr>";
		}
		echo "</table>";
	
	}

/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/
/*													Generating Maximum Hours code goes here                                                      */
/*																								                                                 */
/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/

	if(isset($_POST['maximum']))
	{	
		$max = get_rows("select entry_datetime, exit_datetime, MAX(TIMEDIFF(exit_datetime, entry_datetime)) as Datediff from attendance where user_id = ? and entry_datetime >= ? and exit_datetime <= ? ORDER BY entry_datetime  " , array($id, $entry, $exit));
		echo "<table border =1><th>Entry Time</th><th>ExitTime</th><th>Hours Diffrence</th>";
		foreach ($max as $rows) 
		{
		echo "<tr><td>" . $rows['entry_datetime'] . "</td><td>" . $rows['exit_datetime'] . "</td><td>" . $rows['Datediff'] . "</td></tr>"; 			
		}
	    echo "</table>";
	}

/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/
/*													Generating All hours code goes here                                                          */
/*																								                                                 */
/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/


	$max2 = get_rows("select entry_datetime, exit_datetime, TIMEDIFF(entry_datetime, exit_datetime) as Datediff from attendance where user_id = ? ORDER BY entry_datetime  " , array($id));
	if(isset($_POST['allhour']))
	{
	
			echo "<table border =1><th>Entry Time</th><th>ExitTime</th><th>Hours Diffrence</th>";
			foreach ($max2 as $rows) 
		{
		echo "<tr><td>" . $rows['entry_datetime'] . "</td><td>" . $rows['exit_datetime'] . "</td><td>" . $rows['Datediff'] . "</td></tr>"; 			
		}
		echo "</table>";
	}
/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/
/*													Generating monthly reports code goes here                                                    */
/*																								                                                 */
/*************************************************************************************************************************************************/
/*************************************************************************************************************************************************/

	if(isset($_POST['report']))
	{	
		$max5 = get_rows("select entry_datetime, exit_datetime, MONTHNAME(entry_datetime) as month, YEAR(entry_datetime) as year from attendance ORDER BY entry_datetime ");
		$user_result = array();

		foreach ($max5 as $rows) 
		{
			$user_result[$rows['year']][$rows['month']][] = $rows['entry_datetime'] . "&nbsp" . $rows['exit_datetime'];
		}


		foreach ($user_result as $year => $record) 
		{
			echo "<br><h3>".$year. "</h3>";
			foreach ($record as $month => $report)
			{
				echo "<h4>" .  $month . "</h4>";
				echo implode("<br>", $report);
			}
		}
	}

?>		
