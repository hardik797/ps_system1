<?php

	//include required files
    include('con.php');
    
    //checking whether page if posted or not?
    if (isset ($_POST['login']))
    {

        //fetching posted data and storing it to variable
        if (isset($_POST['uname']) && isset($_POST['password']))
        {
            $uname=mysql_real_escape_string($_POST['uname']);  
            //generating md5 hash for original passwords            
            $pass=md5($_POST['password']);
        }
        else
        {
            $er='uername & password are required field';
        }
        

        //retriving admin data from database for validation
        $sql="select id,username,email,password from tbl_users where password ='".$pass."' and username ='".$uname."' or email ='".$uname."' ";



        //firing query
        $query=mysql_query($sql);

        //fetching data
        $result=mysql_num_rows($query);

        //check whether any row available with the given id and password									
        $row=mysql_fetch_array($query);

        //check for num or rows
        if ($result == 1 ) 
        {            

        	//starting session if user found
			session_start();
           
            $_SESSION['id'] = $row['id'];
            $_SESSION['user'] = $row['username'];
            $_SESSION['mail'] = $row['email'];

            if ($_SESSION['id'] == 1 && $_SESSION['user'] == 'admin')
            {
                //setting admin role in session
            	$_SESSION['role']='admin';
                
            }
            
        }
        else
        {            
            header('location:index.php?er=username or password is invalid');           

        }

    //main if end here
    }


?>