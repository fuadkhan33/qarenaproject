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
	//get all profile info query
	$allInfoQuery = "select * from account where user_id =".$userId.";";
	$allInfoQueryRes = mysqli_query($con,$allInfoQuery);
	$allInfoQueryRows = mysqli_fetch_assoc($allInfoQueryRes);
	
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
		<!-- PROFILE STARTS HERE -->
		<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="well well-sm">
					<div class="row">
						<div class="col-sm-6 col-md-4">
							<img src="<?php echo($allInfoQueryRows['image'])?>" alt="" class="img-rounded img-responsive" />
						</div>
						<div class="col-sm-6 col-md-8">
							<h4>
								<?php echo($allInfoQueryRows['first_name'])?> <?php echo($allInfoQueryRows['last_name'])?></h4>
							<small><cite title="San Francisco, USA"><? echo($allInfoQueryRows['state']); ?> , <?php echo($allInfoQueryRows['country']);?> <i class="glyphicon glyphicon-map-marker">
							</i></cite></small>
							<p>
								<i class="glyphicon glyphicon-envelope"></i>Email: <?php echo($allInfoQueryRows['email_id'])?>
								<br />
								<i class="glyphicon glyphicon-th-list"></i>Occupation: <?php echo($allInfoQueryRows['email_id'])?>
								<br />
								
							<!-- Split button -->
							<a href="updateProfile.php">
							<div class="btn-group">
								<button type="button" class="btn btn-primary">
									Update Profile</button>
									
								</button>
								
							</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
		<div style="position:absolute; left:-9999px; top:-9999px;">
			<span id="qa-waiting-template" class="qa-waiting">...</span>
		</div>

</body></html>