<?php
	include('Module/connection.php');
	$qsn_id = $_GET['qsnID'];
	$userID = $_GET['userID'];
	$isLike = $_GET['is_liked'];
	//see is there any existing row in database 
	$queyForRowCheck = "select * from like_question where question_id = ".$qsn_id." and user_id=".$userID.";";
	$queyForRowCheckResult = mysqli_query($con,$queyForRowCheck);
	$rowNumber = mysqli_num_rows($queyForRowCheckResult);
	echo($isLike);
	echo($rowNumber);
	if($rowNumber==0){
		// now set liked for user_id if no row
		if($isLike == 0){
			//set like in the database
			$queryForUseLike = "insert into like_question(is_liked,user_id,question_id) values(1,".$userID.",".$qsn_id.");";
			$queryForUseLikeResult = mysqli_query($con,$queryForUseLike);
		} else {
			//set Unlike in the database
			$queryForUseLike = "insert into like_question(is_liked,user_id,question_id) values(0,".$userID.",".$qsn_id.");";
			$queryForUseLikeResult = mysqli_query($con,$queryForUseLike);
		}
	} else {
		//if there any row in the database
		if($isLike == 0){
			//set like in the database
			$New1queryForUseLike = "update like_question set is_liked=1 where question_id = ".$qsn_id." and user_id=".$userID.";";
			$queryForUseLikeResult = mysqli_query($con,$New1queryForUseLike);
		} else {
			//set Unlike in the database
			$New2queryForUseLike = "update like_question set is_liked=0 where question_id = ".$qsn_id." and user_id=".$userID.";";
			$queryForUseLikeResult = mysqli_query($con,$New2queryForUseLike);
		}
	}
	//go back to previous page after submission
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}
	header("location: ".$previous);
	
?>