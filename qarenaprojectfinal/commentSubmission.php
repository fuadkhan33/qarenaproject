<?php
	include("Module/connection.php");
	session_start();
	$user_name = $_SESSION['user_name'];
	$qsn_id = $_GET['qsnID'];
	echo($qsn_id);
	//get user id first
	$userIdQuery = "select user_id from users where user_name ='".$user_name."';";
	$result = mysqli_query($con,$userIdQuery);
	$thisUserId = mysqli_fetch_assoc($result);
	$comment = $_POST['comment'];
	//comment submission query
	$insertQuery = "insert into answer(question_id,user_id,answer_text) values(".$qsn_id.",".$thisUserId['user_id'].",'".$comment."');";
	$result2 = mysqli_query($con,$insertQuery);
	$previous = "javascript:history.go(-1)";
	
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}
	header("location: ".$previous);
	
	
?>
