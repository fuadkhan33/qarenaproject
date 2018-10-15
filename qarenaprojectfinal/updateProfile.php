<!DOCTYPE html>
<?php
	include('Module/connection.php');
	
	//starting session for get username
	session_start();
	if(!isset($_SESSION['user_name'])){
		header("Location: http://localhost/qarenaprojectfinal/index.php");
	}
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
			
		<!--update profile form starts here -->
		<div class="container">
		<h1>Edit Profile</h1>
		<hr>
		<div class="row">
		  <!-- left column -->
		  

		  <!-- edit form column -->
		  <div class="col-md-9 personal-info">
		  	<!--image selector for profile ---->
			  
			
			<h3>Personal info</h3>

			<form class="form-horizontal" role="form" action="saveProfile.php" method="post" enctype="multipart/form-data">
			 
			<div class="form-group">
				<label class="col-lg-3 control-label">Upload A Photo:</label>
				<div class="col-lg-8">
				  <input type="file" required name="images" class="form-control">
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-lg-3 control-label">First name:</label>
				<div class="col-lg-8">
				  <input class="form-control" required name="firstname" type="text" value="">
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-lg-3 control-label">Last name:</label>
				<div class="col-lg-8">
				  <input class="form-control" required name="lastname" type="text" value="">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label class="col-lg-3 control-label">Email:</label>
				<div class="col-lg-8">
				  <input class="form-control" required name="email" type="email" value="">
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-lg-3 control-label">Country:</label>
				<div class="col-lg-8">
				  <input class="form-control" required name="country" type="text" value="">
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-lg-3 control-label">State:</label>
				<div class="col-lg-8">
				  <input class="form-control" name="state" type="text" value="">
				</div>
			  </div>
			  <div class="form-group">
				<label class="col-lg-3 control-label">Occupation:</label>
				<div class="col-lg-8">
				  <input class="form-control" required name="occupation" type="text" value="">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label class="col-md-3 control-label"></label>
				<div class="col-md-8">
				  <input type="submit"  class="btn btn-primary" value="Submit">
				  <span></span>
				  <a href="index.php">
				  	<input type="reset"  class="btn btn-default" value="Cancel">
				  </a>
				</div>
			  </div>
			</form>
		  </div>
	  </div>
	</div>
	<hr>
			</div> <!-- END main-shadow -->
		</div> <!-- END body-wrapper -->
		
		
		<div style="position:absolute; left:-9999px; top:-9999px;">
			<span id="qa-waiting-template" class="qa-waiting">...</span>
		</div>

</body></html>