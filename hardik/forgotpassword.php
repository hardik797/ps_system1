<?php

    //including required files
    include('con.php');
        
    
    //for stroing error
    $er='';
    //check whether qerystring passed anything
    if(isset($_GET['er']))
    {
        //stroing error
        $er = $_GET['er'];
    }

    //checking whether page is submited or not?
    if (isset($_POST['forgot']))
    {

        //fetching posted data and store it to variables
        $email=mysql_real_escape_string($_POST['email']);	
        				
        //checking whether login is user
        $sql="select id,email,username from tbl_users where email='".$email."' ";

        //firing query
        $q=mysql_query($sql);

        //check whether any row present in database with given id
        $res=mysql_num_rows($q);

        //validation
        if ($res == 1)
        {
            //fetching data from database
            $row=mysql_fetch_array($q);

            //storing required data to variable
            $id=$row['id'];
            $user=$row['username'];

            
            //generating & storing session
            session_start();
            
            //session id
            $_SESSION['forgot_id']=$id;
            $_SESSION['forgot_user']=$row['email'];

            //generating random token
            $random=bin2hex(openssl_random_pseudo_bytes(4));
            
            //session token
            $_SESSION['toks']=$random;
            
            //passing this value for forgot verification
            $token=$_SESSION['toks'];
            

            //generating limited time session

            
            $time = strtotime("now"); //Create a time from a string 

            //If no session time is created, create one 
            if (!isset($_SESSION['time']))
            {  
        
                //create time limited session 
                $_SESSION['time'] = $time;  
            }
            
            //checking whether forgot request from user or admin
            if ( isset( $_SESSION['forgot_id'] ) )
            {                
                //redirecting to recover page for user
                header('location:recover.php?id='.$id.'&token='.$token.'&uid='.$uid);

            }
            
        //num rows check end here
        }
        else
        {   
            //storing error
            $er="no email found please try again";

        }
        
    //main if end here
    }

//terminating connection
mysql_close($con);

?>

<html>

	<head>

		<title>Recover_Password</title>

			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="keywords" content="HTML,CSS,XML,JavaScript,jQuery">


					<link rel="stylesheet" href="css/forgot.css" type="text/css" />
					<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
					<link rel="stylesheet" href="css/bootstrap.css" type="text/css">

</head>

	<body>

<div class="container">

    <div class="row">
	
        <div id="d">

            <span class="btn-danger">

            <?php
            
                //print error here
                echo $er;
            
                

            ?>

            </span><br><br>

                <form id="form" name="form" role="form" class="form" method="post"> 
                    
                    <label>Recover Password Here!! :</label> &nbsp;<br><br>	
                    
                        <label>Enter Username or Email :</label> &nbsp;
                    
                            <input type="text" name="userid" id="userid" placeholder="userid or email" />
                    
                                <span class="glyphicon glyphicon-user" id="spa"><i id="uname_error"></i></span><br><br>

                                    <input type="submit" class="btn btn-success" name="forgot" value="Recover" /> &nbsp;

                                    <input type="button" class="btn btn-danger" name="cancel" value="Cancel" onclick="location.href='index.php';" /><br><br>
                </form>
        
        </div><!--/.div-->

    </div><!--/.row-->

</div><!--/.container-->


<script src="js/jquery-1.9.1.js" ></script>
<script src="js/jquery-1.12.0.min.js" ></script> 
<script src="js/bootstrap.min.js" ></script>
<script src="js/bootstrap.js" ></script>

<script type="text/javascript" >

//validation formating variables
$(document).ready(function() 
{
    $("#form").submit(function(e) 
    {
        if($("#userid").val()=="")  
        {  
            alert('email required to recover password');  
            $("#userid").focus();
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