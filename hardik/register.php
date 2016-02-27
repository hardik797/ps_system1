<?php

    //includeing database connection file
    include('con.php');
    
    //error variable to store error
    $er='';

    //checking whether form submited or not?
    if (isset($_POST['submit']))
    {
        
        //stroing passed value to variable 			
        $uname=mysql_real_escape_string($_POST['uname']);
        
        $mail=mysql_real_escape_string($_POST['mail']);
        
        $fname=mysql_real_escape_string($_POST['fname']);
        
        $lname=mysql_real_escape_string($_POST['lname']);
        
        $add1=mysql_real_escape_string($_POST['add1']);
        
        $add2=mysql_real_escape_string($_POST['add2']);
        
        $city=mysql_real_escape_string($_POST['city']);
        
        //generating md5 hash for orginal password
        $pass=md5($_POST['pass']);
        
        //check whether username already taken or not?
        $sql=mysql_query("select username,email from tbl_users where username='".$uname."' or email='$mail' ");
        
        //fetching data
        $re=mysql_num_rows($sql);

        
        
         //store error if username already taken
            
        //checking is any row generated with given user and pass or not?
        if ($re == 0)
        {
            //inserting data to database
            $sql="  insert into 
                    tbl_users(username, email, fname, lname, add1, add2, city, password) 
                    values('".$uname."', '".$mail."', '".$fname."', '".$lname."', '".$add1."', '".$add2."', '".$city."', '".$pass."' ) " or die(mysql_error());
            
            //fire query										
            $query=mysql_query($sql) or die(mysql_error());
              
            //checking query is fired or not?
            if ($query == 1)
            {
                //redirecting to user login page
                header('location:index.php?er=Registration Success, You Can Now Login');
            }
            else
            {
                //storing error
                $er="something went wrong!!";
            }

        //username validation if,else end here
        }
        else
        {
            $er="username or email already taken choose another one";
            
        }

    //main if end here
    }
    
    //terminatino database connection here!
    mysql_close($con);

?>

<html>

    <head>

        <title>User_Registeration_Form</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="HTML,CSS,XML,JavaScript,jQuery">

        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="css/user_register.css" type="text/css">

</head>

<body>

<div class="container">

    <div class="row">

	   <div id="d">

    		<span class="btn-danger">
            <?php 

                //displaying error if any generated
                echo $er; 

            ?>
    		</span>
            
            <form name="form" method="post" id="form" >
                
                <label >Fill The Require Fields </label>
            
                    <label >Enter Username :</label>
            
                        <input type="text" name="uname" id="uname" placeholder="Username" /><br>
            
                            <label >Enter Email :</label>
            
                                <input type="text" name="mail" id="mail" placeholder="example@example.com" /> <br>
            
                                    <label >Enter FirstName :</label>
            
                                        <input type="text" name="fname" id="fname" placeholder="John" /><br>
            
                                            <label >Enter LastName :</label>
            
                                                <input type="text" name="lname" id="lname" placeholder="Woo" /> <br>
            
                                                    <label >Enter Addres1 :</label>
            
                                                        <input type="text" name="add1" id="add1" placeholder="123-xyz street" /><br>
            
                                                            <label >Enter Addres2 :</label>
            
                                                                <input  type="text" name="add2" id="add2" placeholder="near xyz road" /> <br>
                                                        
                                                                    <label>Enter City :</label>
                                                                    
                                                                        <input type="text" name="city" id="city" placeholder="Newyork" /><br>
            
                                                                            <label >Choose Password :</label>
            
                                                                                <input type="password" name="pass" id="pass" placeholder="Password" /> <br>
            
                                                                                    <input type="submit" class="btn btn-success" name="submit" value="Submit" /> &nbsp;
            
                                                                                        <input type="button" class="btn btn-danger" name="back" value="Back" onclick="location.href='index.php';" />
            </form>

        </div><!--/div-->
    
    </div><!--/row-->

</div><!--/container-->

<!--        external Javascripts         -->
<script src="js/jquery-1.9.1.js" ></script>
<script src="js/jquery-2.2.0.min.js" ></script> 
<script src="js/bootstrap.min.js" ></script>
<script src="js/bootstrap.js" ></script>

<script type="text/javascript" >

    //format validation variables
    var username = /^[a-z]|[0-9]/ ;
    var numbers = /^[0-9]*$/ ;
    var charspace= /^[a-zA-Z ]*$/;
    var charnumspace = /^[a-zA-Z\s]*$/;
    var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;

    //start checking while page is load completed
    $(document).ready(function() 
    {
    
        //start checking while page is submited 
        $("form").submit(function() 
        {
        
            if($("#uname").val()=="")  
            {  
                alert('Username must required');  
                $("#uname").focus();
                return false;
            }  
            else if(!$("#uname").val().match(username))  
            {
                alert('Username must have alphabet characters only');  
                $("#uname").focus();
                return false;    
            }  
            else if($("#mail").val()=="")  
            {  
                alert('Email must required');  
                $("#mail").focus();
                return false;  
            }  
            else if(!$("#mail").val().match(mail))  
            {  
                alert('Email must in proper format');  
                $("#mail").focus();
                return false; 
            }  
            else if($("#fname").val()=="")  
            {  
                alert('Firstname is required');  
                $("#fname").focus();
                return false;  
            }  
            else if(!$("#fname").val().match(charspace))  
            {  
                alert('Only character & Whitespace allowed');  
                $("#fname").focus();
                return false;
            }  
            else if($("#lname").val()=="")  
            {  
                alert('Lastname is required');  
                $("#lname").focus();
                return false;  
            }  
            else if(!$("#lname").val().match(charspace))  
            {  
                alert('Only character & Whitespace allowed');  
                $("#lname").focus();
                return false;
            }  
            else if($("#add1").val()=="")  
            {  
                alert('Address is required');  
                $("#add1").focus();
                return false;  
            }  
            else if($("#city").val()=="")  
            {  
                alert('Your City is required');  
                $("#city").focus();
                return false;  
            }  
            else if(!$("#city").val().match(charspace))  
            {  
                alert('Only character & Whitespace allowed');  
                $("#city").focus();
                return false;  
            }  
            else if($("#pass").val()=="" && $("#pass").val()<6 )  
            {  
                alert('Password Must be 6 character or greater');  
                $("#pass").focus();
                return false;  
            }  
            else  
            {  
                //at this point form to be submited
                return true;    
            }       
        });
    });
</script>


	</body>

</html>
