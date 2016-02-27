<?php

	//include required files
    include('config.php');
    
    //checking whether page if posted or not?
    if (isset ($_POST['login']))
    {

        //fetching posted data and storing it to variable
        if (isset($_POST['uname']) && isset($_POST['password']))
        {
            $uname=$_POST['uname'];  
            //generating md5 hash for original passwords            
            $pass=md5($_POST['password']);
        }
        else
        {
            $er='uername & password are required field';
        }
        
        //SELECT title FROM pages where id<:id;',

        //execute_query("insert into tbl_users (username,email,password) values(?,?,?)", array('hardy123','hardy123@gmail.com',$pass));
        /*retriving admin data from database for validation */
         /* $sql = "insert into tbl_users(username,email,password) values(?,?,?)";
        $param = array($uname,$uname,$pass); */


        $sql = "SELECT id,username,password,email FROM tbl_users where username=? or email=? and password=?";
        $param = array($uname,$uname,$pass);
        $rows=fetch_data($sql,$param);
        
        $num=fetch_data($rows);
        // //firing query
        // $query=mysql_query($sql);

        //fetching data
        

        echo $result;
        exit;

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