<?php
	include('../config/database.php');

	if (isset($_POST['check']) || isset($_POST['month_report']))
	{
		//checking whether variables are set or not?
		$user_id = trim($_POST['user_id']);
		$type = trim($_POST['type']);

        if ($type == "new")		
        {		
    		//fetching data from database
            $sql =  "select distinct name, entry_datetime, exit_datetime, TIMEDIFF(exit_datetime, entry_datetime) as tdif, DATEDIFF(exit_datetime, entry_datetime) as ddif
                        from attendance a,users u 
                            where a.user_id=u.id and u.id=? group by entry_datetime order by entry_datetime desc limit 1";
    		$param = array($user_id);
           
        }
        if ($type == "old")
        {
            //fetching data from database
            $sql =  "select distinct name, entry_datetime, exit_datetime, TIMEDIFF(exit_datetime, entry_datetime) as tdif, DATEDIFF(exit_datetime, entry_datetime) as ddif 
                        from attendance a,users u 
                            where attendance.user_id=users.id and users.id=? group by entry_datetime order by entry_datetime limit 1";
            $param = array($user_id);
           
        }
        if ($type == "all")
        {
            //fetching data from database
            $sql =  "select distinct name, entry_datetime, exit_datetime, TIMEDIFF(exit_datetime, entry_datetime) as tdif, DATEDIFF(exit_datetime, entry_datetime) as ddif
                        from attendance a,users u 
                            where a.user_id=u.id and u.id=? group by entry_datetime ";
            $param = array($user_id);
           
        }
        if (isset($_POST['month_report']))
        {
            //fetching data from database
            $sql =  "select name, entry_datetime, exit_datetime, TIMEDIFF(exit_datetime, entry_datetime) as tdif, DATEDIFF(exit_datetime, entry_datetime) as ddif 
                        from attendance a,users u 
                            where a.user_id=u.id and u.id=?  ";
            $param = array($user_id);           
        }

?>
      <table border="3" cellpadding="5" cellspacing="5" style="color:green;font-weight:bold;font-size:20px;" >
            <caption>Requested Entries Are</caption>
            <thead>
                <tr>
                    <td>Name of Employee</td>
                    <td>Entry Date/Time</td>
                    <td>Exit Date/Time</td>
                    <td>Total Working Hour</td>
                </tr>
            </thead>
            <tbody style="color:purple;font-weight:bold;font-size:20px;">
<?php
        //executing query
        $result = fetch_data($sql,$param);   
        
        
		//checking whether data inserted or not ?
		if ($result == 0)
		{
            header('location: ../reports.php?er=No data found');
        }
        else
        {
            
            foreach ($result as $row)
            {
                $entry=date('d-M-Y,h:i:s:A ',strtotime($row['entry_datetime']));
                $exit=date('d-M-Y,h:i:s:A',strtotime($row['exit_datetime']));
                $max=$row['tdif'];
                $day=$row['ddif'];
                $hour=date('H',strtotime($max));
                $min=date('i',strtotime($max));
                $sec=date('s',strtotime($max));
                
            
?>
  
            
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $entry; ?></td>
                    <td><?php echo $exit; ?></td>
                    <td><?php echo "Your work is ".$day."  day  ".$hour." hours  ".$min."  minutes  ".$sec."  seconds for this entry" ; ?></td>
<?php       }//end foreach here

        }//num rows else end here
?>
                </tr>
            </tbody>
        </table>
<?php		
       
        
    }//main if end here
?>	<br><br>
<a style="color:navy;font-weight:bolder;font-size:25px;" href="../reports.php">Go Back</a>