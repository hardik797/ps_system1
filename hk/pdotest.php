<?php
$db_host='localhost';
$db_name="db_hardik";
$db_user="root";
$db_password="";

try
{
	$mysql_connection = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_password);
}
catch(PDOException $error)
{
	$er="SQL Error:-".$error;
}


//for insert,update,delete

function execute_query($query, $parameters = array())
{
	global $mysql_connection;
	$statement = $mysql_connection->prepare($query);
	$statement->execute($parameters);

	echo "Query Performed Successfully";
}
//for select only
function fetch_data($query, $parameters = array())
{
	global $mysql_connection;
	$statement = $mysql_connection->prepare($query);
	$statement->execute($parameters);
	$result = $statement->fetch();
	return $result;
}

$token="@^#&%123ASDF*)&_+asfd";
$pass=sha1('hardik'.$token);


execute_query("insert into tbl_users (username,email,password) values(?,?,?)", array('hardy123','hardy123@gmail.com',$pass));


?>