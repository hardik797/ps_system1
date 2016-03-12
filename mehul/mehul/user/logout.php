<?php
include("../includes/session.php");


if(isset($_SESSION['user']))
{
	unset($_SESSION['user']);
}
header("location: login.php");
?>