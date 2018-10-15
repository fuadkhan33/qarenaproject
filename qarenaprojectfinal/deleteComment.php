<?php
	include("Module/connection.php");
	session_start();
	//get qsnID
	$ans_id = $_GET['ansID'];


	$user_name = $_SESSION['user_name'];
	//get user id first
	$userIdQuery = "select user_id from users where user_name='".$user_name."';";
	$result = mysqli_query($con,$userIdQuery);
	$thisUserId = mysqli_fetch_row($result);
	//query for deletion
	$query = "Delete from answer where answer_id=".$ans_id." and user_id='".$thisUserId[0]."';";
	//run query
	mysqli_query($con,$query);
	//for go back to previous page
	$previous = "javascript:history.go(-1)";
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}
	header("location: ".$previous);
?>