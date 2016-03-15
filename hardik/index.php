<?php
    //including required files
    include('login_check.php');
    //for stroing errors
    $er='';
    //chcking whether querystring pass any error
    if(isset($_GET['er']))
    {
        //storing error into message
        $er=$_GET['er'];
    }
    //maintain session
    if (isset($_SESSION['id']))
    {
        
        if (isset($_SESSION['id']) == 1 && isset($_SESSION['role']) == 'admin') 
        {
            header('location:dashboard.php');
        }
        else
        {            
            header('location:manage_profile.php?id='.$_SESSION['id']);
        }
    }    
    
?>

<html>

    <head>

        <title>Login</title>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="keywords" content="HTML,CSS,XML,JavaScript,jQuery">
            <!-- styles-->
            <link rel="stylesheet" href="css/index.css" type="text/css" />
            <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
            <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    </head>

    <body>

        <div id="d">

            <span class="btn-danger">
                <?php 
                    
                    echo $er;
                    
                ?>
            </span>

                <form id="form" name="form" role="form" class="form" method="post" > 
                    
                    <label>Admin Login Here!! </label><br>
                    
                        <label>Enter Username :</label>&nbsp;
                        
                            <input type="text" name="uname" id="uname" placeholder="username" />
                            
                                <span class="glyphicon glyphicon-user" id="spa"></span><br>
                    
                                    <label>Enter Password :</label>&nbsp;
                        
                                        <input type="password" name="password" id="pass" placeholder="password" />
                            
                                            <span class="glyphicon glyphicon-lock" id="spa"></span><br>
                        
                                                <input type="submit" class="btn btn-success" name="login" value="Login" />&nbsp;
                        
                                                    <input type="button" class="btn btn-danger" name="reg" value="Register" onclick="location.href='register.php';" /><br><br>
                    
                                                        <label id="forgot"><a href="forgotpassword.php"> forgot password</a></label>
                
                </form>        

        </div>

        <script src="js/jquery-1.9.1.js" ></script>
        <script src="js/jquery-1.12.0.min.js" ></script> 
        <script src="js/bootstrap.min.js" ></script>
        <script src="js/bootstrap.js" ></script>
        <script type="text/javascript" >
            //validation formating variables
            var username = /^[a-z]|[0-9]/ ;
            var numbers = /^[0-9]*$/ ;
            var charspaceonly = /^[a-zA-Z ]*$/;
            var charnumspace = /^[a-zA-Z\s]*$/;
            var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
            $(document).ready(function() 
            {
                $("#form").submit(function() 
                {
                    if($("#uname").val()=="")  
                    {  
                        alert('Username must required');  
                        $("#uname").focus();
                        return false;  
                    }  
                    else if($("#pass").val()=="")  
                    {  
                        alert('Password must required');  
                        $("#pass").focus();
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