<?php
	//including important files
	include('config/database.php');
   
    //storing error 
    $er='';

    //checking any error is generated
    if (isset($_GET['er']))
    {
        $er=$_GET['er'];
    }

?>
<html>
	<head>	
	<!--
	jquery files, css files, js files include all files here
	-->	
    <style type="text/css">
        
            label
            {
                font-size: 20px;
                font-weight: bolder;
                color: #4863A0;
                width: 200px;
                height: 30px;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: 10px;
            }
            select
            {
                padding-left: 45px; 
                height: 40px;
                margin-left: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
                width: 200px;
                font-size: 20px;
                font-weight: bolder;
                color: #B66B5F; 
            }
            input, input[type='submit']
            {
                text-align: center;
                height: 40px;
                width: 200px;
                margin-top: 10px;
                margin-left: 10px;
                margin-bottom: 10px;
                font-size: 20px;
                font-weight: bolder;
                color: #307D7E;
            }
           
            
        
    </style>
	<!-- <script src="js/jquery-1.9.1.js"></script>	-->
    <link rel="stylesheet" type="text/css" href="src/DateTimePicker.css" />
    <script type="text/javascript" src="src/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="src/DateTimePicker.js"></script>
    <script type="text/javascript">
        
            $(document).ready(function()
            {
                $("#dtBox").DateTimePicker();
            });
        
    </script>

	</head>
	<body>