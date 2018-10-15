<!DOCTYPE html>
<?php 
	session_start();
	if(isset($_SESSION['user_name'])){
		header("Location: home.php");
	}
?>

<html lang="en" class="no-js"> 
    <head>
        <meta charset="UTF-8" />
        <!--include external framework -->
        <title>Qarena Login/Registration </title>
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
            <!--  top bar -->
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
            </div><!--/ End Codrops top bar -->
            <header>
                <h1>Qarena - <span>Question Ans and Solution</span></h1>
				<nav class="codrops-demos">
					<span>You can start question by just sign-up</span>
				</nav>
            </header>
			<!-- Section for login form -->
            <section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="login.php" autocomplete="off" method="post"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                            <span><?php echo($error); ?></span>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="Module/registration.php" autocomplete="off" method="post"> 
                                <h1> Sign up </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="username" required="required" type="text" placeholder="mysuperusername690" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" >Your email</label>
                                    <input id="emailsignup" name="email" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" >Name</label>
                                    <input id="emailsignup" name="name" required="required" type="text" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="password" required="required" type="password" placeholder="eg. X8df!90EO"
                                     onChange="check_pass()" />
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm password </label>
                                    <input id="passwordsignup_confirm" name="confirmpassword" required="required" type="password" placeholder="eg. X8df!90EO" onChange="check_pass();"/>
                                </p>
                                <p name="warning" id="warning" ></p>
                                <p class="signin button"> 
									<input type="submit" id ="submit" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>
