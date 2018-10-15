<?php 
	
	include('connection.php');
	//function for redirect
	function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
	}
 	//get all value from post methord
	
	//create a insert database query for login
	//first in users table
	
	
		//first print no warning
		
		## query database
		# prepare data for insertion
		$username   = $_POST['username'];
		$password   = $_POST['password'];
		$email      = $_POST['email'];
		$username= mysqli_real_escape_string($con, $username);
		$email = mysqli_real_escape_string($con, $email);

		# check if username and email exist else insert
		// u = username, e = emai, ue = both username and email already exists
		$username = $_POST['username'];
		$usernamecheck=mysqli_query($con,"SELECT user_name FROM users WHERE user_name='".$username."';");
		$emailcheck = mysqli_query($con,"SELECT email_id FROM account WHERE email_id='".$email."';");
		
		if ( mysqli_num_rows($usernamecheck)>=1 ){
			$warning = "User Name: ".$username."  Already Registered";
			
		} else if(mysqli_num_rows( $emailcheck)>=1 ){
			$warning = "Email: ".$email."  Already Registered";
		}
		else{
				# insert data into mysql database
			
				//echo($row[0]);
				$sql0 = "INSERT  INTO  users(user_name,password) values ('".$username."','".$password."');";
				$sql1 = "INSERT INTO account(user_id,email_id) values ((select user_id from users where user_name='".$username."'),'".$email."');";
			
				if (mysqli_query($con,$sql0) && mysqli_query($con,$sql1)) {
					$warning = "You are Successfully Registered Thank You";
				} else {
					$warning = mysqli_error($con).mysqli_error($con);
					
				}
				
				
			}
			
?>
   <html>
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Login and Registration Form with HTML5 and CSS3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />

    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <a href="https://Facebook.com/neon.demon.3">
                    <strong>&laquo; Developed By: </strong>Multiverse
                </a>
                <span class="right">
                    <a href="https://Facebook.com/neon.demon.3">
                        <strong>Learning is the eye of mind.</strong>
                    </a>
                </span>
                <div class="clr"></div>
            </div><!-- Codrops top bar -->
            <header>
                <h1><span><?php echo($warning);?></span></h1>
            </header>
            <header>
				<p>
          			<span> <a href="https://localhost/qarenaprojectfinal">Please click here to return Login/Register Page</a></span>  
           		</p>
            </header>
        </div>
    </body>
</html>