<?php 
    //maintain session
    include('session.php');
   
    //for storing errors if any 
    $er='';
    if (isset($_GET['er']))
    {
        $er=$_GET['er'];
    }
?>
<!DOCTYPE html>

    <html lang="en">

        <head>
   
            <meta charset="utf-8">
            <title>Admin_Panel</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
            

            <!-- The styles -->
            <link href='css/bootstrap.min.css' rel='stylesheet' type="text/css">
            <link href='css/bootstrap.css' rel='stylesheet' type="text/css">
            <link href='css/dash.css' rel='stylesheet' type="text/css">
            

        </head>

<body>

    <div class="container-fluid">

        <div class="row">

            <div class="b">
                <?php 
                        //displaying errors if any generated
                        echo $er;
                ?> 
            </div>


                <!-- displaying session  -->
                <div class="right">Welcome : &nbsp; <span><?php echo $log_user; ?></span> </div>
                <a class="right" href="logout.php">Logout</a>
                <label><a href="users.php">Manage Users</a></label>


        <!-- ****** row end here ****** -->
        </div>


    <!-- ****** container end here ****** -->
    </div>


<!-- jQuery -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/jquery-1.12.0.min.js"></script>


</body>

</html>