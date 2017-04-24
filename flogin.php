<?php

include('library.php');

if(isset($_SESSION['fid']) && $_SESSION['fid']!=''){
    header("Location: facultymain.php");
    exit;   
}

if(isset($_POST["cll_submit"]) && $_POST["cll_submit"]!=''){
        
    if(isset($_POST["funame"]) && $_POST["funame"]!='' && isset($_POST["fpass"]) && $_POST["fpass"]!=''){
        $login = check_faculty_login($_POST["funame"],$_POST["fpass"]);   
    }else{
        $login='';
    }
    if($login!="0"){
        header("Location: facultymain.php");
        exit;       
    }else{
        header("Location: flogin.php?login=failed");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Faculty Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body style="background: #ccffcc;">
        <div class="login-page">
            <div class="form">
                <form class="login-form" action="" method="post">
                    <h1 /> FACULTY LOGIN
                    <br /><br />
                    <input type="text" placeholder="Username" name="funame"/>
                    <input type="password" placeholder="Password" name="fpass"/>
                     <input class="btn btn-primary" name="cll_submit" type="submit" Value="Login">
                </form>
            </div>
        </div>
    </body>
</html>