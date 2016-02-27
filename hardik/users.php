<?php
    //including required files
    //maintain session
    include('session.php');
    
    //checking user session available or not
    if (!isset($_SESSION['role']))
    {

        header("locaiton: index.php?er=no admin login found");

    }


    //for storing errors
    $er='';

    //check whether query string passing any error
    if (isset($_GET['er']))
    { 
        //displaying error message
        $er=$_GET['er']; 
    } 

/*********************************************************************************************************************|
**********************************************************************************************************************|
|                                                                                                                     |
|                                           delete user profile codes goes here                                       |
|                                                                                                                     |
/*********************************************************************************************************************|
**********************************************************************************************************************/

    
    //checking whether id passed or not?
    if (isset($_GET['delete_id']) && isset($_GET['action']))
    {

        
        if ( $_GET['action'] == "delete")
        {
            //storing passed id to variable
            $id=mysql_real_escape_string($_GET['delete_id']);
        
            // checking whether id is not blank
            if ($id>1) 
            {

                // deleting particular user from user table using id
                $delete_sql="delete from tbl_users  where id='".$id."' " ;

                $delete_query=mysql_query($delete_sql);
                
                //checking query is performed or not?
                if ($delete_query == 1)
                {
                    //store error message 
                    $er="Record Deleted";
                }
                else
                {   
                    //store error message 
                    $er="no user found to delete ";
                }

            //id checker if end here                                                                
            }
        }
        else
        {
            $er="no delete action found";
        }

    //main if end here                                              
    }


/*********************************************************************************************************************|
**********************************************************************************************************************|
|                                                                                                                     |
|                             profile image displaying and profile managements codes goes here                        |
|                                                                                                                     |
|                                                                                                                     |      
/*********************************************************************************************************************|
**********************************************************************************************************************/

    //geting id for given passed username from database
    $user_sql="select id,username from tbl_users where id>1 ";
                        
    //firing query
    $query=mysql_query($user_sql);            

    //checking num rows
    $check=mysql_num_rows($query);

    //checking num rows availabel in database
    if ($check == 0)
    {
        header('location:dashboard.php?er=no any user found');
        
    }
    else
    {

        while($row=mysql_fetch_array($query))
        {
            /* image displaying part strat from here*/
                                                                                                            
            //selecting image path from database for particular user    
            $file_sql=" select filepath 
                            from tbl_files f INNER JOIN tbl_users u 
                                ON f.users_id=u.id and u.username='".$row['username']."' order by filepath desc ";


            //fire query
            $file_query=mysql_query($file_sql);

            //fetching data
            $rows=mysql_fetch_array($file_query);
            
?>

<!DOCTYPE html>

<html lang="en">

    <head>

    <title>Manage_Users</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="HTML,CSS,XML,JavaScript,jQuery">
        
        <!-- The styles -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/user_table.css" rel="stylesheet" type="text/css">
        
    </head>

    <body>

        <div class="container">

            <div class="row">

                <!-- Responsive Data Table -->
                <div class="container-fluid">

                    <div class="row">

                        <div class="box col-md-12">
                                
                            <div class="box-inner well">

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
                                                        //displaying data into datatable
                                                        echo $row['username'];                                                         
                                                ?>
                                                </td>
                                                
                                                <td>
                                                <?php  
                                                        //displaying image  
                                                        echo('<img src="'.$rows['filepath'].'" alt=loading_error" height="100" width="100">');
                                                ?>
                                                </td>
                                                
                                                <td class="center">
                                                        &nbsp;
                                                        <a class="btn btn-info" href="admin_edit.php?action=edit&edit_id=<?php echo $row['id']; ?>">

                                                            <i class="glyphicon glyphicon-edit icon-white"></i>Edit
                                                        </a>
                                                        &nbsp;
                                                        <a class="btn btn-danger" onclick="return confirm('are you sure you want to DELETE ?')" href="users.php?action=delete&delete_id=<?php echo $row['id']; ?>">

                                                            <i class="glyphicon glyphicon-trash"></i>Delete</a>
                                                </td>
<?php 
            

        }//end while for users

    } //terminating num row else here
    
//closing database connection
mysql_close($con);

?>

                                            </tr>

                                        </tbody>
                                
                                    </table>

                                        <a href='dashboard.php'>BACK</a> &nbsp;
                                        <span class="btn-danger">
                                        <?php
                                                //displaying errors
                                                echo $er;
                                        ?>
                                        </span> 

                                        

                                </div>

                            </div>

                        </div><!--/span-->

                    </div><!--/row-->

                </div>

            </div>

        </div>

        <!-- jQuery -->
        <script src="bower_components/jquery/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.js"></script>


    </body>

</html>