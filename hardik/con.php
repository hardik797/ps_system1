<?php

    //creating connection
    $con=mysql_connect("localhost","root","");

    //selecting database
    mysql_select_db('db_hardik');
    
    //checking whether connection available or not?
    if (!$con)
    {
        $er="Connection Failed"; 
    }

?>

