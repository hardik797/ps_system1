<?php

	//include required files
	//include('con.php');
    include('login_check.php');
	
    //starting session
	session_start();
    if (!isset($_SESSION['id']))
    {
        header('location:index.php?er=session exires please login again');
    }
    else
    {
        //storing session
        $user_id=$_SESSION['id'];
        $user=$_SESSION['user'];
        $user_mail=$_SESSION['mail'];
        


    	//retriving session data from database for validation
        $sql="  select id,username,email 
                from tbl_users 
                where id = '".$user_id."' and username = '".$user."' and email = '".$user_mail."' ";

        //firing query
        $query=mysql_query($sql);

        //check whether any row available with the given id and password									
        $res=mysql_num_rows($query);

       
        if ($res == 1) 
        {

            //fetching data from database to array
            $row=mysql_fetch_array($query);
                    
            //validating session
            $log_id=$row['id'];            
            $log_user=$row['username'];
            $log_mail=$row['email'];
                  
            if (!isset($log_id) && !isset($log_user) && !isset($log_mail))
            {
                mysql_close($con);
                session_destroy();
                header('location:index.php?er=your session expired please login again');
            }
        }
    }


?>