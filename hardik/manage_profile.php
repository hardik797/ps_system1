<?php

    //including require files
    //maintain session
    include('session.php');

    //for storing errors 
    $er='';

    //checking if any errors generated
    if (isset($_GET['er']))
    { 
        $er=$_GET['er'];
    }


    //checking if username passed or not? 
    if (!isset( $_GET['id']))
    {
        //no such user found
        header('location:index.php?er=no such user found ');
    }
    else
    {
        //storing passed user into variable
        $id=trim($_GET['id']);

        //validating session
        if ($id != $log_id)
        {
            unset($_SESSION['id']);
            header('location:index.php?er=login failed!! plz do not try to edit query string');
            exit;
        }
        else
        {
            //geting id for given passed username from database
            $edit_sql=" select id,username from tbl_users where id='".$id."' ";

            //firing query
            $edit_query=mysql_query($edit_sql);
            
            //checking num rows
            $check=mysql_num_rows($edit_query);

            if ($check != 1)
            {
                $er="no record found";
            }
            else
            {
                //retrive data from database    
                $user_row=mysql_fetch_array($edit_query);
                /* image displaying part strat from here*/

                //selecting image path from database for particular user    
                $path_sql=" select distinct filepath 
                            from tbl_files f,tbl_users u 
                            where f.users_id=u.id and f.users_id  ='".$user_row['id']."' order by filepath desc";
                                                                        
                //fire query
                $path_query=mysql_query($path_sql);
                //fetching data
                $path_row=mysql_fetch_array($path_query);

                
                
                                                                        
                
?>

<html>

    <head>
        
        <title>Manage_Profile</title>
            
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="keywords" content="HTML,CSS,XML,JavaScript,jQuery">
            
            <!-- The styles -->
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
            <link href="css/edit_user.css" rel="stylesheet" type="text/css">
            
            <!-- jQuery -->
            <script src="bower_components/jquery/jquery.min.js"></script>
            <script src="js/jquery-1.9.1.js" ></script>
            <script src="js/jquery-1.12.0.min.js" ></script> 
            <script src="js/bootstrap.min.js" ></script>
            <script src="js/bootstrap.js" ></script>
    
    </head>

    <body>

        <div class="container">

            <div class="row">

                <!-- Responsive Data Table -->
                <div class="row">
                    
                    <div class="box col-md-12"><br>
                        
                        <label >Welcome &nbsp;  <?php echo $log_user; ?>  </label>
                            
                        <label>Manage Your Profile &nbsp; <span class="glyphicon glyphicon-off"><a href="logout.php">Logout</a></span></label><br>

                            <span class="btn-danger">

                                <?php
                                        //displaying error
                                        echo $er;                                   

                                ?>

                            </span> 

                                <div class="box-inner"><br>
                                   
                                    <div class="box-content">

                                        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">

                                            <thead>

                                                <tr>

                                                    <th>Username</th>
                     
                                                    <th>Profile Picture</th>
                     
                                                    <th>Actions</th>
                                                </tr>
                                            
                                            </thead>
                                            
                                            <tbody>

                                                <tr>
                                                    <td> 
                                                    <?php 
                                                        //displaying username field in table
                                                        echo $user_row['username']; 
                                                    ?>
                                                    </td>

                                                    <td>
                                                    <?php                                                       
                                                        
                                                        //displaying image                                                          
                                                        echo('<img src="'.$path_row['filepath'].'" alt=load_error" height="100" width="100">');

                                                    ?>
                                                    </td>

                                                    <td class="center">

                                                        <a class="btn btn-info" href="edit_user.php?id=<?php echo $user_row['id']; ?>">

                                                            <i class="glyphicon glyphicon-edit icon-white"></i>Edit
                                                        </a>
<?php   
            //closing record checker else
            }

        //closing session validator else
        }

    //closing main else 
    }

    //terminating connection
    mysql_close($con);
?>

                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>                        
                        
                                </div>
                    
                            </div>
                
                        </div><!--/table/row-->

                    </di   v><!--/row-->

                </div><!--/container-->
            
            </div>

    </body>

</html>