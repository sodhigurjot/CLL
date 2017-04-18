<?php
include('library.php');
if(empty($_SESSION['sid']) || $_SESSION['sid']==''){
    header("Location: index.php");
    exit();   
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>My marks</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    </head>
    <body>
        <?php           
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");            
            $user_details = get_user_details($_SESSION['sid']);
            $student_marks = get_marks();
            navbar();
        ?>  
        <div class="container">
            <br>
            <div class="jumbotron">
                <h1 class="display-3">Hello, <?php echo $user_details['name']; ?></h1>
                <p class="lead">Your score in this Interactive Language Learning module is given below.</p>
                <hr class="my-4">
                <p>You have a total score of <?php echo $student_marks; ?>.</p>
                <p class="lead">
                  <a class="btn btn-primary btn-lg" href="studentmain.php" role="button">Return to main menu</a>
                </p>
            </div>            
        </div>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    </body>
</html>
