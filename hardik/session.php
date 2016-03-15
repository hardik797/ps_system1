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
        $sql = "SELECT id,username,email FROM tbl_users where id=? and username=? and email=? ";
        $param = array($user_id,$user,$user_mail);
        
        //firing query
        $rows = fetch_rows($sql,$param,1);
        
        //check whether any row available with the given id and password									
        $res=count($rows);
               
        if ($res == 1) 
        {
            //validating session
            $log_id=$rows[0]['id'];            
            $log_user=$rows[0]['username'];
            $log_mail=$rows[0]['email'];
                
            if (!isset($log_id) && !isset($log_user) && !isset($log_mail))
            {
                $conn="";
                unset($_SESSION['id']);
                unset($_SESSION['user']);
                unset($_SESSION['mail']);
                header('location:index.php?er=your session expired please login again');
            }
        }
    }
?>