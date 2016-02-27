<?php 

$db_host='localhost';
$db_name="ps_system";
$db_user="root";
$db_password="";

//for stroing errors
$er='';


//CREATING CONNECTION
try
{
	$mysql_connection = new PDO("mysql:host=$db_host;dbname=$db_name;",$db_user,$db_password);
	
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
        global $mysql_connection;
        $statement = $mysql_connection->prepare($query);
        return $statement->execute($parameters);
        $mysql_connection->commit();  
    }
    catch (PDOException $sql_er)
    {
        $er="SQL Error:-".$sql_er;
    }
}

//FOR SELECT SQL QUERY ONLY
function fetch_data($query, $parameters = array())
{
    try
    {
        global $mysql_connection;
        $statement = $mysql_connection->prepare($query);
		$statement->execute($parameters);
        $result = $statement->fetchAll();
		return	$result;
    }
    catch (PDOException $sql_er)
    {
        $er="SQL Error:-".$sql_er;
    }
}
?>