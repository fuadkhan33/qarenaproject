<?php
	
	//including connection php file
	include('Module/connection.php');
	//Define a error String 
	$error = '';
	
	// Starting Session
	if(isset($_SESSION['user_name'])){
		header("location: home.php");
	}
	session_start();
	
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid.";
		//include login form whern error
		include('log_error.php');
	}
	else
	{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];

		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($con,$username);
		$password = mysqli_real_escape_string($con,$password);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysqli_query($con,"select * from users where password='$password' AND user_name='$username'");
		$rows = mysqli_num_rows($query);
		if ($rows == 1) {
			$_SESSION['user_name']=$username;
			header("location: home.php");
		} else {
			$error = "Username or Password is invalid.";
			//include login form whern error
			include('log_error.php');
		}
		mysqli_close($con); // Closing Connection
	}
	
?>
<head>
	
</head>
 