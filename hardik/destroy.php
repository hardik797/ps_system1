<?php
	//starting session
	session_start();

	//destrying and redirecting to home page
	if (session_destroy())
	{	
		header('location:index.php?er=no such user found please login again or register ');
	}
?>