<?php

	//maintaing session
	session_start();

	//destrying and redirecting to home page
	if (session_destroy())
	{
		header('location:index.php?er=you successfully logout');
	}

?>