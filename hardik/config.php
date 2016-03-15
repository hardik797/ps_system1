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
function fetch_row($query,$parameters = array())
{
    try
    {
        global $conn;
        $statement = $conn->prepare($query);
        $statement->execute($parameters);
		$result = $statement->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $statement->fetch();       
                return $result;
     
    }
    catch (PDOException $sql_er)
    {
        $er="SQL Error:-".$sql_er;
    }
}
function fetch_rows($query,$parameters = array() , $nums = 0)
{
    try
    {
        global $conn;
        $statement = $conn->prepare($query);
        $statement->execute($parameters);
		$result = $statement->setFetchMode(PDO::FETCH_ASSOC); 
        $result = $statement->fetchAll();
        return $result;
     
    }
    catch (PDOException $sql_er)
    {
        $er="SQL Error:-".$sql_er;
    }
}
?>