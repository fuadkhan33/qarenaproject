<?php
	include('Module/connection.php');
	$ans_id = $_GET['ansID'];
	$userID = $_GET['userID'];
	$isLike = $_GET['is_liked'];
	//see is there any existing row in database 
	$queyForRowCheck = "select * from like_answer where answer_id = ".$ans_id." and user_id=".$userID.";";
	$queyForRowCheckResult = mysqli_query($con,$queyForRowCheck);
	$rowNumber = mysqli_num_rows($queyForRowCheckResult);
	echo($isLike);
	echo($rowNumber);
	if($rowNumber==0){
		// now set liked for user_id if no row
		if($isLike == 0){
			//set like in the database
			$queryForUseLike = "insert into like_answer(is_liked,user_id,answer_id) values(1,".$userID.",".$ans_id.");";
			$queryForUseLikeResult = mysqli_query($con,$queryForUseLike);
		} else {
			//set Unlike in the database
			$queryForUseLike = "insert into like_answer(is_liked,user_id,answer_id) values(0,".$userID.",".$ans_id.");";
			$queryForUseLikeResult = mysqli_query($con,$queryForUseLike);
		}
	} else {
		//if there any row in the database
		if($isLike == 0){
			//set like in the database
			$New1queryForUseLike = "update like_answer set is_liked=1 where answer_id = ".$ans_id." and user_id=".$userID.";";
			$queryForUseLikeResult = mysqli_query($con,$New1queryForUseLike);
		} else {
			//set Unlike in the database
			$New2queryForUseLike = "update like_answer set is_liked=0 where answer_id = ".$ans_id." and user_id=".$userID.";";
			$queryForUseLikeResult = mysqli_query($con,$New2queryForUseLike);
		}
	}
	if(isset($_SERVER['HTTP_REFERER'])) {
		$previous = $_SERVER['HTTP_REFERER'];
	}
	header("location: ".$previous);
	
?>