<?php 
	//include database connection
	include('Module/connection.php');
	session_start();
	//starting session for get username
	if(!isset($_SESSION['user_name'])){
		header("Location: http://localhost/qarenaprojectfinal/index.php");
	}
	
	
	$username = $_SESSION['user_name'];
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Qarena Homepage</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
</head>

<body>

    <!-- including nav bar  --->
	<?php include('navbar.php')?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-9" >
            
            <?php 
				//for featching everything from qsn table
				$sqlquery = "select * from question;";
				if($result = mysqli_query($con,$sqlquery)){
					//fetch accociative array
					while($row = mysqli_fetch_assoc($result)){
			?>
					<!--- each qsn border ----->
                   <a href="qsnWithAns.php?userId=<?php
								echo($row['user_id']);
							?>&&qsnID=<?php echo($row['question_id'])?>">
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h4><?php
										//this part is for getting user_name
										$tempQuery = "Select user_name from users where user_id=".$row['user_id'].";";
										$userNameResult = mysqli_query($con,$tempQuery);
										$user_name_row = mysqli_fetch_row($userNameResult);
										echo($user_name_row[0]);
									
									?>
                                </h4>
                                <p><?php echo(substr($row['question_text'],0,100)."...");?></p> <!--- select asubstring from array---->
                            </div>
                        </div>
                    </div> 
                    </a><!--- qsn border ends ---->
					
			<?php
					}
				}
			?>
					

                </div>

            </div>

        </div>
        <?php include('footer.php');?>

   

</body>

</html>

