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
        <link rel="stylesheet" type="text/css" href="css/listen.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
            <div class="passage"> On the basis of the audio clip below, answer the questions that follow:</div><br>
                <?php
                    $audio_details = get_audio_details();
                    foreach($audio_details as $audio_details_val){
                        #echo $audio_details_val['path'].$audio_details_val['name'];
                ?>  
        
                <audio controls> 
                    <source src="<?php echo $audio_details_val['path']; ?>\<?php echo $audio_details_val['name']; ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <?php } ?>
            <div>
                <form class="opt">
                    <p class="question"> Question1 </p>
                    <!--                <label for="fname">Answer   </label>-->
                    <input type="text" id="fname" name="fname">
<!--                    <input type="submit" value="Submit">-->
                    <p class="question"> Question2 </p>
                    <!--                <label for="fname">Answer   </label>-->
                    <input type="text" id="fname" name="fname"><br><br>
                    <p class="left"><input type="submit" value="Submit"></p>
<!--                    <p class="right"><a href="studentmain.php">Done</a></p>-->
                </form>
            </div>
        </div>
        <script src="js/navbar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    </body>
</html>