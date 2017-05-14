<?php
include('library.php');
if(empty($_SESSION['sid']) || $_SESSION['sid']==''){
    header("Location: index.php");
    exit();   
}

$interview_id = $_GET['interview_id'];
$video_details = get_video_details($interview_id)[0];

if(empty($video_details)){
    header("Location: studentmain.php");
}

?>
<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" type="text/css" href="css/listen.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/passage.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    </head>
        <title>
            Listening
        </title>
    </head>
    <body>
        <?php         
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");            
            $user_details = get_user_details($_SESSION['sid']);
            navbar();
        ?>
        <div class="whole">            
            <div class="passage">
                Watch the video given below and observe a job interview being conducted :
            </div>
            <br>
            <video width="100%" controls> 
                <source src="<?php echo $video_details['path']; ?>\<?php echo $video_details['name']; ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </video>
            <br>
            <br>
            <blockquote class="blockquote">
                <?php echo $video_details['content']; ?>
            </blockquote>
        </div>
        <div class="whole">
            <h4>Go to interview clip:</h4>
            <?php
                $video_count = count(get_video_details());
                for ($i = 1; $i <= $video_count; $i++) {
                                 
            ?>            
            <a href="interview.php?interview_id=<?php echo $i; ?>"><input type="button" class="btn btn-secondary" value="<?php echo $i ?>"></a>
            <?php
                }
            ?>
            <div style="float: right">
                <a href="studentmain.php">Go to main menu</a>
            </div>
        </div>
        <script src="js/navbar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    </body>
</html>