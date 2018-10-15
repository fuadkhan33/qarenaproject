<?php
	$host = "localhost";
	$userName = "root";
	$password = "";
	$dbname = "qarena";
	//$con = mysqli_($host, $userName, $password, $dbname);
	$con=mysqli_connect($host,$userName,$password,$dbname); 

	// Check connection
	if (mysqli_connect_errno())
    {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>