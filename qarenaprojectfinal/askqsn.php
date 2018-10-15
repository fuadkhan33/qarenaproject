<!DOCTYPE html>
<?php
	include('Module/connection.php');
	session_start();
	$username = $_SESSION['user_name'];
	//query for user_id
	//get user id first
	$userIdQuery = "select user_id from users where user_name ='".$username."';";
	$result = mysqli_query($con,$userIdQuery);
	$thisUserId = mysqli_fetch_assoc($result);
	$userId = $thisUserId['user_id'];
	
	
?>

<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<title>Qarena -Ask Question</title>
		<link rel="stylesheet" href="qa-styles.css">
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


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
						
						
						<div class="container"> <! --- using bootstrap comment box--->
									<h1>Please ask proper question</h1>
									
									<form role="form" action="submit_qsn.php?userID=<?php echo($userId);?>" method="post">
										<div class="form-group">
											<div class="col-md-6">
												<textarea name="question" id="question" type="text" class="form-control" rows="3" placeholder="What's up?" required></textarea>
											</div>
										</div>

										<div class="row">
											<button type="submit" class="btn btn-default">Question</button>
										</div>
									</form>
								</div>
						</div>
					
				</div> <!-- END main-wrapper -->
			</div> <!-- END main-shadow -->
		</div> <!-- END body-wrapper -->
		
		
		<div style="position:absolute; left:-9999px; top:-9999px;">
			<span id="qa-waiting-template" class="qa-waiting">...</span>
		</div>

</body></html>