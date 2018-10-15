<?php
	include('Module/connection.php');
	//getting username from session
	session_start();
	$user_name = $_SESSION['user_name'];
	//get user id first
	$userIdQuery = "select user_id from users where user_name='".$user_name."';";
	$result = mysqli_query($con,$userIdQuery);
	$thisUserId = mysqli_fetch_row($result);
	$qsnID = $_GET['qsnID'];
	echo($qsnID);
	echo($thisUserId[0]);
	$sql = "delete from question where question_id ='".$qsnID."' and user_id='".$thisUserId[0]."';";
	$q = mysqli_query($con,$sql);
	
	
	//for go back to Home page
	
	$previous = "index.php";

	
	header("location: ".$previous);
	
?>