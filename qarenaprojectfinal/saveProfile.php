<!DOCTYPE html>
<?php
	include('Module/connection.php');
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
	$firstName = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$emailid = $_POST['email'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$occupation = $_POST['occupation'];

	//code for image upload
	$path ="uploads/person.jpg";
				if($_FILES['images']['size']>1000){
					//now done coding for uploading image
					$path="uploads/".$_FILES['images']['name'];
					$fileName=$_FILES['images']['tmp_name'];
					if(isset($_FILES['images'])){
						if(file_exists($path)){
							$error['images']="Image Already Exist";
						} else {
							move_uploaded_file($fileName,$path);
						}

					}
				}

	
	//storind the data in your database
	$query= "update account set first_name = '".$firstName."',last_name = '".$lastName."',email_id = '".$emailid."',country= '".$country."',state = '".$state."',occupation='".$occupation."',image='$path' where user_id=".$userId.";";
	mysqli_query($con,$query);
	echo(mysqli_error($con));

		
	
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
		<div class="col-md-9 personal-info">
			<h2 style="color: green"> Successfully Saved</h2>
		</div>
		
		
		<div style="position:absolute; left:-9999px; top:-9999px;">
			<span id="qa-waiting-template" class="qa-waiting">...</span>
		</div>

</body></html>