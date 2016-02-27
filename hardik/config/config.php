<?php 

$db_host='localhost';
$db_name="db_hardik";
$db_user="root";
$db_password="";


//for stroing errors
$er='';

try
{
	$mysql_connection = new PDO("mysql:host=dbname=$db_name;"$db_host,$db_user,$db_password);
}
catch (PDOException $con_er)
{
	$er="SQL Error:-".$con_er;
}


//for insert,update,delete

function execute_query($query, $parameters = array())
{
	try
	{
    	global $mysql_connection;
    	$statement = $mysql_connection->prepare(query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    	$statement->execute($parameters);
    }
	catch (PDOException $sql_er)
	{
		$er="SQL Error:-".$sql_er;
	}
}

//for select only
function fetch_data($query, $parameters = array())
{
    try
    {
    	global $mysql_connection;
    	$statement = $mysql_connection->prepare(query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    	$statement->execute($parameters);
    	$result = $statement->fetch();
    	return $result;
    }
    catch (PDOException $qry_er)
    {
        $er="SQL Error:-".$qry_er;
    }
}
$mysql_connection=null;
?>