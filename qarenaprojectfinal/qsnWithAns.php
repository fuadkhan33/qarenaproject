<!DOCTYPE html>
<?php
	include('Module/connection.php');
	
	//get back to login page if not loged in
	session_start();
	if(!isset($_SESSION['user_name'])){
		header("Location: http://localhost/qarenaprojectfinal/index.php");
	}
	$username = $_SESSION['user_name'];
	$sql = "select user_id from users where user_name='$username'";
	$assoc = mysqli_fetch_assoc(mysqli_query($con,$sql));
	$user_id = $_GET['userId'];
	$qsnID = $_GET['qsnID'];
	//get qsn from query
	$qsnTextQuery = "select question_text,user_name,question_id,like_count from question natural join users where user_id=".$user_id." and question_id=".$qsnID.";";
	$resultForQsnTxt = mysqli_query($con,$qsnTextQuery);
	//here $hellOfrow[o] will get qsn text and $hellOfrow[1] and will get username of who asq this qsn and $$hellOfrow[2] have the qsn id
	//and $hellofrow[3] has question like_count
	$hellOfrow = mysqli_fetch_row($resultForQsnTxt);
	//Now go for answer qsn(Very shitty job just quite more job)
	$getAllansRinfoQuery = "select * from users natural join answer where question_id=".$hellOfrow[2].";";
	$resultForAns = mysqli_query($con,$getAllansRinfoQuery);
	$allInformationAboutAns = mysqli_fetch_assoc($resultForAns);
	//number of answer
	$numRowofAns = mysqli_num_rows($resultForAns);
	//another query for answer id
	$queryForAnsId = "Select answer_id from answer where question_id=".$qsnID.";";
	$resultQueryForAnsId = mysqli_query($con,$queryForAnsId);
	$rowForAnsId = mysqli_fetch_row($resultQueryForAnsId);
	//get is_liked for this user
	//liked or unliked check for qsn
	$queryForLikedUnlikedValue = "select is_liked from like_question where question_id=".$hellOfrow[2]." and user_id='".$assoc['user_id']."';";
	$queryForLikedUnlikedValueResult = mysqli_query($con,$queryForLikedUnlikedValue);
	$isLike = mysqli_fetch_assoc($queryForLikedUnlikedValueResult);

	

	//
	
	
?>

<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<title>Is My Website ok? - Localhost Q&amp;A</title>
		<link rel="stylesheet" href="qa-styles.css">
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
	</head>
	<body >
		<?php include('navbar.php');?>
		<div class="qa-body-wrapper">
			
			
			<div class="qa-main-shadow">
				
				<div class="qa-main-wrapper">

					<div class="qa-main">
						<h1>
							<a href="#">
								<span class="entry-title"><?php echo($hellOfrow[0]);?></span>
							</a>
						</h1>
						<div class="qa-part-q-view">
							<div class="qa-q-view  hentry question" id="q1">
								<form method="post" action="#">
									<input type="hidden" name="code" value="">
								</form>
								<div class="qa-q-view-main">
								
									<form method="post" action="#">
										<div class="qa-q-view-content">
											<a name="1"></a><div class="entry-content"></div>
										</div>
										<div class="qa-voting qa-voting-net" id="voting_1">
											<div class="qa-vote-buttons qa-vote-buttons-net">
												<input title="Click to vote up" name="vote_1_1_q1" onclick="" type="submit" value="+" class="qa-vote-first-button qa-vote-up-button"> 
												<input title="Click to vote down" name="vote_1_-1_q1" onclick="" type="submit" value="–" class="qa-vote-second-button qa-vote-down-button"> 
											</div>
											<div class="qa-vote-count qa-vote-count-net">
												<span class="qa-netvote-count">
													<span class="qa-netvote-count-data">
													<?php
														//now get like count
														$likeQuestionQuery = "select count(is_liked) from like_question  where question_id=".$hellOfrow[2]." and is_liked=1;";
														$likeQuestionQueryResult = mysqli_query($con,$likeQuestionQuery);
														$fetchLikeCount = mysqli_fetch_row($likeQuestionQueryResult);
														echo($fetchLikeCount[0]);
													?>
														<span class="votes-up"><span class="value-title" title="0"></span></span><span class="votes-down"><span class="value-title" title="0"></span></span></span><span class="qa-netvote-count-pad"> 
													
														</span>
												</span>
											</div>
											<div class="qa-vote-clear">
											</div>
										</div>
										<span class="qa-q-view-avatar-meta">
											<span class="qa-q-view-meta">
												<a href="#" class="qa-q-view-what">asked</a>			
												<span class="qa-q-view-who">
													<span class="qa-q-view-who-pad">by </span>
													<span class="qa-q-view-who-data"><span class="vcard author"><a href="#" class="qa-user-link url fn entry-title nickname"><?php echo($hellOfrow[1]);?></a></span></span>
													<span class="qa-a-item-avatar-meta">
													<span class="qa-a-item-meta">
														<a href="deleteQuestion.php?qsnID=<?php echo($qsnID)?>" class="qa-a-item-what">Delete Question</a>
													</span>
													
													</span>
													<span class="qa-q-item-meta">
														<a style="border-left: 50px;"  href="likeQsn.php?qsnID=<?php echo($hellOfrow[2])?>&& userID=<?php echo($user_id)?>&&is_liked=
														<?php 
															echo($isLike['is_liked']);
														 ?>
														" class="qa-a-item-what">
													<?php
														//liked or unliked check
														if($isLike['is_liked']==0){
															echo("Like");
														} else {
															echo("Unlike");
														}
													
													?>
														</a>
													</span>
												</span>
											</span>
										</span>
										
										
										<div class="qa-q-view-c-list" style="display:none;" id="c1_list">
										</div> <!-- END qa-c-list -->
										
										<input type="hidden" name="code" value="">
										<input type="hidden" name="qa_click" value="">
									</form>
									<div class="qa-c-form">
									</div> <!-- END qa-c-form -->
									
								</div> <!-- END qa-q-view-main -->
								<div class="qa-q-view-clear">
								</div>
							</div> <!-- END qa-q-view -->
							
						</div>
						<div class="qa-part-a-form">
							<div class="qa-a-form" id="anew" style="display:none;">
								<h2>Your answer</h2>
								<form method="post" action="#" name="a_form">
									<table class="qa-form-tall-table">
										<tbody><tr>
											<td class="qa-form-tall-data">
												<input name="a_content_ckeditor_ok" id="a_content_ckeditor_ok" type="hidden" value="0"><input name="a_content_ckeditor_data" id="a_content_ckeditor_data" type="hidden" value="">
												<textarea name="a_content" rows="12" cols="40" class="qa-form-tall-text"></textarea>
											</td>
										</tr>
										<tr>
											<td class="qa-form-tall-label">
												Your name to display (optional):
											</td>
										</tr>
										<tr>
											<td class="qa-form-tall-data">
												<input name="a_name" type="text" value="" class="qa-form-tall-text">
											</td>
										</tr>
										<tr>
											
										</tr>
										
										<tbody><tr>
											<td colspan="1" class="qa-form-tall-buttons">
												<input onclick="" value="Add answer" title="" type="submit" class="qa-form-tall-button qa-form-tall-button-answer">
												<input name="docancel" onclick="" value="Cancel" title="" type="submit" class="qa-form-tall-button qa-form-tall-button-cancel">
											</td>
										</tr>
									</tbody></table>
									<input type="hidden" name="a_editor" value="">
									<input type="hidden" name="a_doadd" value="1">
									<input type="hidden" name="code" value="">
								</form>
							</div> <!-- END qa-a-form -->
							
						</div>
						<div class="qa-part-a-list">
							<h2 id="a_list_title"><?php echo($numRowofAns);?> Answer</h2>
							<?php
								$ansResultQuery = "Select * from answer natural join users where question_id=".$qsnID.";";
								$resultQuery = mysqli_query($con,$ansResultQuery);
								while($hellOfAnsrow = mysqli_fetch_assoc($resultQuery)){
							?>
								<div class="qa-a-list" id="a_list">
								
								<div class="qa-a-list-item  hentry answer" id="a2">
									<div class="qa-voting qa-voting-net" id="voting_1">
											<div class="qa-vote-buttons qa-vote-buttons-net">
												<input title="Click to vote up" name="vote_1_1_q1" onclick="" type="submit" value="+" class="qa-vote-first-button qa-vote-up-button"> 
												<input title="Click to vote down" name="vote_1_-1_q1" onclick="" type="submit" value="–" class="qa-vote-second-button qa-vote-down-button"> 
											</div>
											<div class="qa-vote-count qa-vote-count-net">
												<span class="qa-netvote-count">
													<span class="qa-netvote-count-data">
													<?php
														//now get like count
														$likeQuestionQuery2 = "select count(is_liked) from like_answer  where answer_id=".$hellOfAnsrow['answer_id']." and is_liked=1;";
														$likeQuestionQueryResult2 = mysqli_query($con,$likeQuestionQuery2);
														$fetchLikeCount2 = mysqli_fetch_row($likeQuestionQueryResult2);
														echo($fetchLikeCount2[0]);
														//liked or unliked check for ans
														$queryForLikedUnlikedValueAns = "select is_liked from like_answer where answer_id=".$hellOfAnsrow['answer_id'].";";
														$queryForLikedUnlikedValueResult = mysqli_query($con,$queryForLikedUnlikedValueAns);
														$queryForLikedUnlikedValueResult = mysqli_query($con,$queryForLikedUnlikedValueAns);
														$isAnsLike = mysqli_fetch_assoc($queryForLikedUnlikedValueResult);
													?>
														<span class="votes-up"><span class="value-title" title="0"></span></span><span class="votes-down"><span class="value-title" title="0"></span></span></span><span class="qa-netvote-count-pad"> 
													
														</span>
												</span>
											</div>
											<div class="qa-vote-clear">
											</div>
										</div>
									<div class="qa-a-item-main">
										<form method="post" action="">
											<div class="qa-a-selection">
											</div>
											<div class="qa-a-item-content">
												<a name="2"></a><div class="entry-content"><?php echo($hellOfAnsrow['answer_text']);?></div>
											</div>
											<span class="qa-a-item-avatar-meta">
												<span class="qa-a-item-meta">
													<a href="" class="qa-a-item-what">answered</a>
													
													<span class="qa-a-item-who">
														<span class="qa-a-item-who-pad">by </span>
														<span class="qa-a-item-who-data"><span class="vcard author"><a href="" class="qa-user-link url fn entry-title nickname"><?php echo($hellOfAnsrow['user_name']);?></a></span></span>
														
													</span>
												</span>
											</span>
											<span class="qa-a-item-avatar-meta">
												<span class="qa-a-item-meta">
													<a href="deleteComment.php?ansID=<?php echo($hellOfAnsrow['answer_id'])?>&& qsnID=<?php echo($qsnID)?>" class="qa-a-item-what">Delete Comment</a>
												</span>
											</span>
											<span class="qa-a-item-avatar-meta">
												<span class="qa-a-item-meta">
													<a href="likeComment.php?ansID=<?php echo($hellOfAnsrow['answer_id'])?>&& userID=<?php echo($user_id)?>&&is_liked=
														<?php 
															echo($isAnsLike['is_liked']);
														 ?>" class="qa-a-item-what">
													<?php
														
														//liked or unliked check
														if($isAnsLike['is_liked']==0){
															echo("Like");
														} else {
															echo("Unlike");
														}
													
													?>
													
														 </a>
												</span>
											</span>
											<div class="qa-a-item-c-list" style="display:none;" id="c2_list">
										    </div> <!-- END qa-c-list -->
											
											
										</form>
										<div class="qa-c-form" id="c2" style="display:none;">
											<h2>Your comment on this answer:</h2>
											<form method="post" action="" name="c_form_2">
												<table class="qa-form-tall-table">
													<tbody><tr>
														<td class="qa-form-tall-data">
															<textarea name="c2_content" id="c2_content" rows="4" cols="40" class="qa-form-tall-text"></textarea>
														</td>
													</tr>
													<tr>
														<td class="qa-form-tall-label">
															Your name to display (optional):
														</td>
													</tr>
													<tr>
														<td class="qa-form-tall-data">
															<input name="c2_name" type="text" value="" class="qa-form-tall-text">
														</td>
													</tr>
													<tr>
														<td class="qa-form-tall-label">
															<label>
																<input name="c2_notify" id="c2_notify" onclick="" type="checkbox" value="1" checked="" class="qa-form-tall-checkbox">
																<span id="c2_email_shown">Email me at this address if a comment is added after mine:</span><span id="c2_email_hidden" style="display:none;">Email me if a comment is added after mine</span>
															</label>
														</td>
													</tr>
													</tbody><tbody id="c2_email_display">
														<tr>
															<td class="qa-form-tall-data">
																<input name="c2_email" id="c2_email" type="text" value="" class="qa-form-tall-text">
																<div class="qa-form-tall-note">Privacy: Your email address will only be used for sending these notifications.</div>
															</td>
														</tr>
													</tbody>
													<tbody><tr>
														<td colspan="1" class="qa-form-tall-buttons">
															<input onclick=" return qa_submit_comment(1, 2, this);" value="Add comment" title="" type="submit" class="qa-form-tall-button qa-form-tall-button-comment">
															<input name="docancel" onclick="return qa_toggle_element()" value="Cancel" title="" type="submit" class="qa-form-tall-button qa-form-tall-button-cancel">
														</td>
													</tr>
												</tbody></table>
												<input type="hidden" name="c2_editor" value="">
												<input type="hidden" name="c2_doadd" value="1">
												<input type="hidden" name="c2_code" value="">
											</form>
										</div> <!-- END qa-c-form -->
										
									</div> <!-- END qa-a-item-main -->
									<div class="qa-a-item-clear">
									</div>
								</div> <!-- END qa-a-list-item -->
							</div>
							<?php	
								}
								?>
							 <!-- END qa-a-list -->
							<div class="container"> <! --- using bootstrap comment box--->
									<h1>Please give proper answer</h1>
									
									<form role="form" action="commentSubmission.php?qsnID=<?php echo($hellOfrow[2]);?>" method="post">
										<div class="form-group">
											<div class="col-md-6">
												<textarea name="comment" id="comment" type="text" class="form-control" rows="3" placeholder="What's up?" required></textarea>
											</div>
										</div>

										<div class="row">
											<button type="submit" class="btn btn-default">Answer</button>
										</div>
									</form>
								</div>
						</div>
					</div> <!-- END qa-main -->
					
				</div> <!-- END main-wrapper -->
			</div> <!-- END main-shadow -->
		</div> <!-- END body-wrapper -->
		
		
		<div style="position:absolute; left:-9999px; top:-9999px;">
			<span id="qa-waiting-template" class="qa-waiting">...</span>
		</div>

</body></html>