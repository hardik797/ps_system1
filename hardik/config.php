<?php 

$db_host = 'localhost';
$db_name = "db_hardik";
$db_user = "root";
$db_password = "";


//for stroing errors
$er = '';


//CREATING CONNECTION
try
{
	$conn = new PDO("mysql:host=$db_host;dbname=$db_name;",$db_user,$db_password);
}
catch (PDOException $con_er)
{
	$er="SQL Error:-".$con_er;
}


//FOR INSERT,UPDATE,DELETE SQL QUERIES

function execute_query($query, $parameters = array())
{
    try
    {
        global $conn;
        $statement = $conn->prepare($query);
        return $statement->execute($parameters);
        $conn->commit();        

    }
    catch (PDOException $sql_er)
    {
        $er="SQL Error:-".$sql_er;
    }
}

//FOR SELECT SQL QUERY ONLY
function fetch_data($query,$parameters = array() , $nums = 0)
{
    try
    {
        global $conn;
        $statement = $conn->prepare($query);
        $statement->execute($parameters);
        $result = $statement->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $statement->fetchAll();
        if ($nums == 0) 
        {
            $data = $result[0];        
        } 
        elseif ($nums >= 1) 
        {
            $data = $result;
        } 
        else 
        {
            $data = "no any record found";
        }
        return $data;
     
    }
    catch (PDOException $sql_er)
    {
        $er="SQL Error:-".$sql_er;
    }
}
?>