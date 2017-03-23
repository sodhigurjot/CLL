<?php
include('library.php');
if(isset($_SESSION['sid']) && $_SESSION['sid']!=''){
	header("Location: studentmain.php");
	exit;	
}
if(isset($_REQUEST["signin"]) && $_REQUEST["signin"]!=''){
	if(isset($_POST["uname"]) && $_POST["uname"]!='' && isset($_POST["pass"]) && $_POST["pass"]!=''){
		$login = check_login($_POST["uname"],$_POST["pass"]);	
	}else{
		$login='';
	}
	if($login!="0"){
		header("Location: studentmain.php");
		exit;		
	}
}

if(isset($_REQUEST["signup"]) && $_REQUEST["signup"]!=''){
	if(isset($_POST["uname"]) && $_POST["uname"]!=''){
		$username = $_POST["uname"];
	}else{
		$username = "";
	}
	if(isset($_POST["pass"]) && $_POST["pass"]!=''){
		$password = $_POST["pass"];
	}else{
		$password = "";
	}
	if(isset($_POST["rno"]) && $_POST["rno"]!=''){
		$rollno = $_POST["rno"];
	}else{
		$rollno = "";
	}
	if(isset($_POST["name"]) && $_POST["name"]!=''){
		$name = $_POST["name"];
	}else{
		$name = "";
	}
	$register = student_register($name,$rollno,$username,$password);
	if($register ==  1){
		header("Location: register.php?register=success");
		exit;
	}elseif(stripos($register,'Duplicate') !== FALSE) {
		header("Location: register.php?register=failed");
		exit;
	}else{
		echo $register;
	}
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Regiter | Interactive Language Learning</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style-register.css">
        <link rel="stylesheet" href="css/form-elements-register.css">
        <style>
            .footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                /* Set the fixed height of the footer here */
                height: 30px;
                background-color: #f5f5f5;
            }
        </style>
    </head>
    <body>        
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Interactive Language Learning</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action="">
                    <input class="form-control mr-sm-2" type="text" placeholder="Username" name="uname"/>
                    <input class="form-control mr-sm-2" type="password" placeholder="Password" name="pass"/>
                    <input class="btn btn-outline-success my-2 my-sm-0" name="signin" type="submit" Value="Login">
                </form>
                &nbsp;
                <a href="register.php"><input type="button" value="Register" class="btn btn-outline-success my-2 my-sm-0" style="margin-top:6% !important;"></a>
            </div>
        </nav>
        <div class="container">
            <br>
            <?php
                $reg_alert="";
                if(isset($_GET["register"]) && $_GET["register"]!=''){
					$reg_alert=$_GET["register"];
					if($reg_alert=="failed"){
            ?>
						<div class="alert alert-danger">User registration failed. User name already exists.</div>
            <?php
					}else if($reg_alert=="success"){
            ?>
						<div class="alert alert-success">User successfully registered. Please login to continue.</div>
            <?php
					}
                }
                if(isset($_GET["login"]) && $_GET["login"]!=''){
                    $reg_alert=$_GET["login"];
                    if($reg_alert=="failed"){
			?>
						<div class="alert alert-danger">Username or password incorrect. Try again.</div>
			<?php
                    }
                }
                if(isset($_GET["logout"]) && $_GET["logout"]!=''){
                    $reg_alert=$_GET["logout"];
                    if($reg_alert=="yes"){
			?>
						<div class="alert alert-success">Successfully logged out!</div>
			<?php
                    }
                }
            ?>                    
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Login to our site</h3>
                            <p>Enter username and password to log on:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="" class="login-form">
                                <div class="form-group">
                                    <label class="sr-only" for="uname">Username</label>
                                    <input type="text" name="uname" placeholder="Username..." class="form-username form-control" id="uname">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="pass">Password</label>
                                    <input type="password" name="pass" placeholder="Password..." class="form-password form-control" id="pass">
                                </div>
                                <input type="submit" name="signin" value="Sign in!" class="btn">
                            </form>
                            <p class="message">Login as Faculty?<a href="flogin.php">Click here</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 middle-border"></div>
                <div class="col-sm-1"></div>
                <div class="col-sm-5">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Sign up now</h3>
                                <p>Fill in the form below to get instant access:</p>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-pencil"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" method="post" class="registration-form">
                                <div class="form-group">
                                    <label class="sr-only" for="name">Name</label>
                                    <input type="text" name="name" placeholder="Name..." class="form-first-name form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="rno">Roll number</label>
                                    <input type="text" name="rno" placeholder="Roll number..." class="form-last-name form-control" id="rno">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="uname">Username</label>
                                    <input type="text" name="uname" placeholder="Username..." class="form-email form-control" id="uname">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="pass">Password</label>
                                    <input type="password" name="pass" placeholder="Password..." class="form-email form-control" id="pass">
                                </div>
                                <input type="submit" name="signup" value="Sign me up!" class="btn">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <p align="center" class="text-muted">The Northcap University</p>
        </footer>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
