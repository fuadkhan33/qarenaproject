<?php
	session_start();
	if(isset($_SESSION['user_name'])){
		session_destroy();
		header("location: https://localhost/qarenaprojectfinal/index.php");
	} else {
		header("location: https://localhost/qarenaprojectfinal/index.php");
	}
	
	
?>