<?php
include('library.php');
if(empty($_SESSION['fid']) || $_SESSION['fid']==''){
    header("Location: flogin.php");
    exit();   
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard | Interactive Language Learning</title>
        <link type="text/css" rel="stylesheet" href="css/cards.css" />        
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
            $faculty_details = get_faculty_details($_SESSION['fid']);
            navbar_faculty();
        ?>	
        <div class="container">
            <div class="row">
                <div style="margin-left: 20px;">
                    <div class="card" style="">
                        <a href="passage_list.php" class="link">
                                <img src="pics/reading.png" alt="" style="width: 20rem; height: 15rem;">
                        </a>
                        <div class="card-block">
                            <h4 class="card-title" >Reading</h4>
                        </div>
                    </div>	
                </div>
                <div style="margin-left: 20px;">
                    <div class="card" style="">
                        <a href="audio_list.php" class="link"> 
                            <img src="pics/listen.jpg" alt="" style="width: 20rem; height: 15rem;">
                        </a>
                        <div class="card-block">
                            <h4 class="card-title" >Listening</h4>
                        </div>
                    </div>
                </div>
                <div style="margin-left: 20px;">
                    <div class="card" style="">
                        <a href=# class="link">
                            <img src="pics/undefined.png" alt="" style="width: 20rem; height: 15rem;">
                        </a>
                        <div class="card-block">
                            <h4 class="card-title" >Module 3</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div style="margin-left: 20px;">
                    <div class="card" style="">
                        <a href=# class="link">
                            <img src="pics/undefined.png" alt="" style="width: 20rem; height: 15rem;">
                        </a>
                        <div class="card-block">
                            <h4 class="card-title" >Module 4</h4>
                        </div>
                    </div>
                </div>
                <div style="margin-left: 20px;">
                    <div class="card" style="">
                        <a href="dictionary.php" class="link">
                            <img src="pics/dictionary.png" alt="" style="width: 20rem; height: 15rem;">
                        </a>
                        <div class="card-block">
                            <h4 class="card-title" >Dictionary</h4>
                        </div>
                    </div>
                </div>
                <div style="margin-left: 20px;">
                    <div class="card" style="">
                        <a href="mymarks.php" class="link">
                            <img src="pics/marks.jpg" alt="" style="width: 20rem; height: 15rem;">
                        </a>
                        <div class="card-block">
                            <h4 class="card-title">My Marks</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/navbar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    </body>
</html>