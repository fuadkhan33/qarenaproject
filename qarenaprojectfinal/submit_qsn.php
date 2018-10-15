<?php
	include('Module/connection.php');
	$user_id = $_GET['userID'];
	//get qsn via post
	$question_text = $_POST['question'];
	//query for insert qsn
	$sql = "insert into question(user_id,question_text) values (".$user_id.",'".$question_text."')";
	mysqli_query($con,$sql);
?>
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
            </div><!--/ Codrops top bar -->
            <header>
                
            </header>
            <header>
				<p>
          			<span> Successfully submitted</span>  
          			<span> <a href="https://localhost/qarenaprojectfinal">Please click here to go home page</a></span>  
           		</p>
            </header>
        </div>
    </body>
</html>