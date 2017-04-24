<?php
include('library.php');
if(empty($_SESSION['sid']) || $_SESSION['sid']==''){
    header("Location: index.php");
    exit();   
}

$audio_id = $_GET['audio_id'];
$audio_details = get_audio_details($audio_id)[0];
$audio_questions = get_audio_questions($audio_id);

if(empty($audio_details)){
    header("Location: studentmain.php");
}

if(isset($_POST['audio_submit']) && $_POST['audio_submit']!=''){
    calculate_passage_marks($_REQUEST['audio_id'],$_POST['ans1'],$_POST['ans2'],$_POST['ans3'],'audio_questions');
    header("Location: listen.php?audio_id=".($_REQUEST['audio_id']+1));
    exit();
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
            <div class="passage"> On the basis of the audio clip below, answer the questions that follow:</div><br>
                <audio controls> 
                    <source src="<?php echo $audio_details['path']; ?>\<?php echo $audio_details['name']; ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <form class="opt" action="" method="POST">
                    <?php
                        $i=0;
                        foreach($audio_questions as $audio_questions){
                        $i++;
                        
                    ?>  
                    
                    <div>
                         <p class="question"><h6>Q<?php echo $i; ?>.  <?php echo $audio_questions['question']; ?></p></h6>
                
                        <input class='opt' type="radio" name="ans<?php echo $i; ?>" value="<?php echo $audio_questions['ans1']; ?>" id="radio01<?php echo $i; ?>"><label for="radio01<?php echo $i; ?>"><span></span><?php echo $audio_questions['ans1']; ?></label><br>
                        <input class='opt' type="radio" name="ans<?php echo $i; ?>" value="<?php echo $audio_questions['ans2']; ?>" id="radio02<?php echo $i; ?>"><label for="radio02<?php echo $i; ?>"><span></span><?php echo $audio_questions['ans2']; ?></label><br>
                        <input class='opt' type="radio" name="ans<?php echo $i; ?>" value="<?php echo $audio_questions['ans3']; ?>" id="radio03<?php echo $i; ?>"><label for="radio03<?php echo $i; ?>"><span></span><?php echo $audio_questions['ans3']; ?></label><br>
                        <input class='opt' type="radio" name="ans<?php echo $i; ?>" value="<?php echo $audio_questions['ans4']; ?>" id="radio04<?php echo $i; ?>"><label for="radio04<?php echo $i; ?>"><span></span><?php echo $audio_questions['ans4']; ?></label><br>
                    </p>
                    </div>
                    
                    <?php  }  ?>
                    <input type="submit" value="Submit" name="audio_submit">
                </form>
        </div>
        <div class="whole">
            <h4>Go to audio clip:</h4>
            <?php
                $audio_count = count(get_audio_details());
                for ($i = 1; $i <= $audio_count; $i++) {
                                 
            ?>            
            <a href="listen.php?audio_id=<?php echo $i; ?>"><input type="button" value="<?php echo $i ?>"></a>
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