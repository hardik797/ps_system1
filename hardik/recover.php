<?php

    //including connection files
    include('con.php');

    //take error variable for storing errors
    $er='';

    //maintaining session
    session_start();
    
    $length = 300; // time in seconds :: 60 = 1 minutes 
    $time = strtotime("NOW"); // Create a time from a string 

    if (isset($_SESSION['forgot_id']))
    {

        //Check if user session expired or not
        if ( ( (strtotime("now") - $_SESSION['time'] ) > $length) )
        { 
            // if expired redirect to forgot menu while destroying all previous session
            session_destroy();
            mysql_close($con);
            header("location:forgotpassword.php?er=your session expired please try again"); 
            exit; 
        }
        else
        {
            $_SESSION['time'] = $time; 
        }
        
    }
    else
    {        
        header("location:forgotpassword.php?er=no forgot password request found please try again"); 
        exit; 
    }

    

    //store session if foidd
    $stok=$_SESSION['toks'];
    $sid=$_SESSION['forgot_id'];
    $suid=$_SESSION['forgot_user'];
   
    //checking whether id passed or not?
    if (isset($_GET['id']) && isset($_GET['token']))
    {

        //storing passed id to variable
        $id=mysql_real_escape_string($_GET['id']);	

        $userid=mysql_real_escape_string($_GET['uid']);  

        //storing passed id to variable
        $token=mysql_real_escape_string($_GET['token']);  


        $er="Set Password for user's email   :  ".$userid." where Token is :".$token;
        

        // checking whether id is not blank and token not mismatched
        if ($id == $sid && $token == $stok && $suid == $userid)	
        {

        
            //getting user details
            $query=mysql_query("select * from tbl_users where email='".$userid."' " ) or die(mysql_error());
            
            //fetching data into array
            $re=mysql_fetch_array($query);
            
            //assigning id for accurate updatation
            $id=$re['id'];
            
            //checking for page submit
            if (isset($_POST['set']))
            {

                //stroing password into variable
                $pass=md5($_POST['pass']);

                $cpass=md5($_POST['cpass']);
                
                //updating password details now for  $userid
                $sql=" update tbl_users set password='".$pass."' where id='".$id."' " or die("you got following database error:   ".mysql_error());
                
                //checking whether password is not mismatched
                if ($pass==$cpass)
                {
                    //firing query
                    $qry=mysql_query($sql)or die("you got following database error:   ".mysql_error());
              
                    //checking whether query fired?
                    if ($qry == 1)
                    {
                        //redirecting user to login page while destroying all the session
                        session_destroy();
                        header('location:index.php?er=new password set for '.$userid.' login now');
                        exit;
                        
                    }
                    else
                    {
                        $er="password mismatched please retry";
                    }

                //password verifier if end here    
                }

            //form submit checker if end here
            }

        //token verifying if end here																
        }
        else
        {
            //redirecting to users.php with error message if any
            session_destroy();
            header('location:forgotpassword.php?er=no forgot request found please try again');
            exit;
        }

        
    }//main if end here
    

    //terminating connection
    mysql_close($con);
																
												
							
?>			
<html>

    <head>

        <title>Set_Password</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="HTML,CSS,XML,JavaScript,jQuery">

        <!-- styles -->
        <link rel="stylesheet" href="css/set_pass.css" type="text/css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    
    </head>

    <body>

        <div id="d">

            <span class="btn-danger">
            
            <?php
                    //displaying error here
                    echo $er;
            ?>

            </span><br><br>
            
                <form id="form" name="form" method="post"> 

                    <label id="lbl">Set New Password Here!! :</label><br>
            
                        <label id="lbl">Enter New Password:</label>

                            <input class="ps" type="password" name="pass" id="pass" placeholder="new password" />

                                <span class="glyphicon glyphicon-lock" ></span><br><br>

                                    <label id="lbl">Confirm Password:</label>

                                        <input class="ps" type="password" name="cpass" id="cpass" placeholder="confirm password" />
    
                                            <span class="glyphicon glyphicon-lock" ></span><br>

                                                <input id="submit" type="submit" class="btn btn-success" name="set" value="Set" />

                </form>
        
        </div>

<!-- JavaScripts -->

<script src="js/jquery-1.9.1.js" ></script>
<script src="js/jquery-1.12.0.min.js" ></script> 
<script src="js/bootstrap.min.js" ></script>
<script src="js/bootstrap.js" ></script>
<script type="text/javascript" >

    //start checking on document refresh
    $(document).ready(function() 
    {
        //its called when form submited
        $("#form").submit(function() 
        {
            if($("#pass").val()=="" )  
            {  
                alert('password must required');  
                $("#pass").focus();
                return false;  
            }  
            else if($("#cpass").val()=="")  
            {  
                alert('confirm password must required');  
                $("#cpass").focus();
                return false;  
            }  
            else if($("#pass").val() != $("#cpass").val() )  
            {  
                alert('confirm password must required');  
                $("#cpass").focus();
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
