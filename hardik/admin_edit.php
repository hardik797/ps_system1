<?php

    // including required files to maintain session
    include('session.php');


    //checking user session available or not
    if (!isset($_SESSION['role']))
    {

        header("locaiton: index.php?er=no admin login found");

    }


    // error variable for storing errors...
    $er='';
    if (isset($_GET['er']))
    {
        $er=mysql_real_escape_string($_GET['er']);
    }

    //checking if page posted or not?
    if (isset($_POST['update']))
    {
        //storing passed value in to variables
        $id=mysql_real_escape_string($_POST['id']);

        
        if (isset($_POST['uname']))
        {
            $uname=mysql_real_escape_string($_POST['uname']);
        }
        else
        {
            $er = "username is required field.";
        }
        
        if (isset($_POST['mail']))
        {
            $mail=mysql_real_escape_string($_POST['mail']);    
        }
        else
        {
            $er="email address is required field";
        }
        
        //if all elements are set then its value assigned to variables    
        if (isset($_POST['pass']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['add1']) && isset($_POST['add2']) && isset($_POST['city']))
        {

            $mail=mysql_real_escape_string($_POST['mail']);    
            $fname=mysql_real_escape_string($_POST['fname']);
            $lname=mysql_real_escape_string($_POST['lname']);
            $add1=mysql_real_escape_string($_POST['add1']);
            $add2=mysql_real_escape_string($_POST['add2']);
            $city=mysql_real_escape_string($_POST['city'] );
            $pass=mysql_real_escape_string($_POST['pass']);

        }
            
        //checking whether password is empty or not?
        $pass = !empty($_POST["pass"]) ? md5($_POST["pass"]) : "";
        if (!empty($pass))
        {
            $pass = ", password='".$pass."'";
        }
          

        //updating user details 
        
            $update_sql=" update tbl_users 
                set 
                username = '".$uname."', 
                email = '".$mail."', 
                fname = '".$fname."', 
                lname = '".$lname."', 
                add1 = '".$add1."', 
                add2 = '".$add2."', 
                city = '".$city."'".$pass."
                where id = '".$id."' ";
     
        
                
        $update_query= mysql_query($update_sql);


        //checking whther query performed?
        if ($update_query == 1)
        {   


            if (isset($_FILES['img']))
            {
                
                // actual path where image may store 
                $target_dir = "uploads/$uname/";

                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                
                //checking image extention type
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    
                if (!file_exists($target_dir) ) 
                {
                    //creating directory 
                    mkdir($target_dir,0777,true);
                    
                }
                
                //validating and applying file path
                $img_sql_query=mysql_query("select filepath from tbl_files where filepath='".$target_file."'");

                $img_rows=mysql_num_rows($img_sql_query);
                //chceking whether image already exists or not
                if ($img_rows != 0)
                {
                    $er="image already exists";
                }
                else
                {                    

                    $file_sql="insert into tbl_files(users_id,filepath) values('".$id."','".$target_file."')";
                        
                    // if everything is ok, try to upload file
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) 
                    {
                        $file_query=mysql_query($file_sql);
                        //redirecting to user profile page
                        header('location:users.php?er=image and user data has been upldated');
                        exit;
                    }
                    else 
                    {
                        $er= "Sorry, there was an error uploading your file.";
                    }
                }

            }
            else
            {
                $er="image not selected";
            }
        }
        else
        {
            $er="sql have following error :-".mysql_error();
        }
    }

/*********************************************************************************************************************|
**********************************************************************************************************************|
|                                                                                                                     |
|                                    profile editing code start from here                                             |
|                                                                                                                     |
|                                                                                                                     |      
/*********************************************************************************************************************|
**********************************************************************************************************************/
        
    //checking whether id posted ?
    if (isset($_GET['action']) && isset($_GET['edit_id']))
    {

        if ($_GET['action'] != 'edit')
        {
            header('location:users.php?er=no edit action found');            
        }
        else
        {
   
           //strring passed value
           $id=mysql_real_escape_string($_GET['edit_id']);
            
           //selecting particular user from database
           $edit_sql="select * from tbl_users where id='".$id."'";

           $edit_query=mysql_query($edit_sql);


           //checking num rows
           $check=mysql_num_rows($edit_query);

           if ($check == 1)
           {   
                                  
                //fetching data
                $result=mysql_fetch_array($edit_query);
            

?>

<!DOCTYPE html>

    <html lang="en">
        
        <head>
   
            <meta charset="utf-8">
            <title>Update_Profile</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">    

            <!-- stylsheets and required javascripts and jquery plugin files-->
            <!--<link rel="stylesheet" type="text/css" href="admin_edit.css">-->
            <link rel="stylesheet" type="text/css" href="css/edit_user.css">
            <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">        
        
        </head>

    <body>

    <div class="container">

        <div class="row">
        
            <div id="d"><br>

                <span class="btn-danger">

				    <?php 

                        //displaying error if any generated
						echo $er; 

				    ?>

                </span>

                    <form id="form" name="form" method="post" role="from" enctype="multipart/form-data" ><br><br>

                        <!-- take id as hidden input for updating particular user data -->

                        <input type="hidden" name="id" value="<?php echo $result['id']; ?>" />

                        <label>Update Username :</label>

                        <input type="text" name="uname" value="<?php echo $result['username']; ?>" id="uname" placeholder="username" /><br>

                        <label>Update Email :</label>

                        <input type="text" name="mail" value="<?php echo $result['email']; ?>" id="mail" placeholder="example@example.com" /> <br>

                        <label>Update FirstName :</label>

                        <input type="text" name="fname" value="<?php echo $result['fname']; ?>" id="fname" placeholder="John" /><br>

                        <label>Update LastName :</label>

                        <input type="text" name="lname" value="<?php echo $result['lname']; ?>" id="lname" placeholder="Woo" /> <br>

                        <label>Update Addres1 :</label>

                        <input type="text" name="add1" value="<?php echo $result['add1']; ?>" id="add1" placeholder="132-xyz street" /><br>

                        <label>Update Addres2 :</label>

                        <input type="text" name="add2" value="<?php echo $result['add2']; ?>" id="add2" placeholder="opp.xyz road" /> <br>

                        <label>Update City :</label>

                        <input type="text" name="city" value="<?php echo $result['city']; ?>" id="city" placeholder="New York" /><br>

                        <label>Choose Profile Image :</label>

                        <input type="file" name="img" id="img" class=""/> <br>

                        <label>Update Password :</label>

                        <input type="text" name="pass" id="pass" placeholder="*******" /><br>
					   
                        <input type="submit" class="btn btn-success" name="update" value="Update" />&nbsp; 

                        <input type="button" class="btn btn-info" name="back" value="Back" onclick="location.href='users.php';" /><br><br>

                </form>

            </div><!--/.div-->

        </div><!--/.row-->

    </div><!--/.container-->
<?php

                
            //num rows if end here
            }
             
        // action checking else end here
        }

    }//main if end here
    
    //closing conneciton
    mysql_close($con); 

?>
<!-- external javascript -->
<!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-1.9.1.js" ></script>
	<script src="js/jquery-2.2.0.min.js" ></script> 


    <!-- Javascript validations -->
    <script type="text/javascript" >

    	//validating username expression
    	var username = /^[a-z]|[0-9]/ ;
    	//validating numbers expresssion 
    	var numbers = /^[0-9]*$/ ;
    	// validating character with white space only
    	var charspace= /^[a-zA-Z ]*$/;
    	//validating email string exression
    	var mail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;

    	$(document).ready(function() 
    	{
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
    			else  
    			{  
    				return true;    
    			}     	
    		});
    	});

    </script>

    </body>

</html>