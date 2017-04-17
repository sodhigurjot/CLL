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
        <link rel="stylesheet" href="css/passage.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <?php            
            $k = $_REQUEST["passage"];
            $j = 1;
            $pagePassage = $k;
            $passages = get_passages($k);
            $questions = get_questions($k);
            //print_r($questions);
            if(empty($passages)){
                header("Location: studentmain.php");
            }
            $i=0;
            $_SESSION["key"] = $k;                
        ?>         
        <div class="whole">
            <h1>Reading</h1>
            <div class="passage">
                <p class="passage"><?php echo $passages['passage']; ?></p>
            </div>
            <form class="opt" action="calculate_passage_marks.jsp?passage=<%=pagePassage%>" method="POST">
                <?php 
                    foreach($questions as $questions){
                    $i++;
                ?>
                <p class="question"><h6>Q<?php echo $i; ?>.  <?php echo $questions['question']; ?></p></h6>
            
                    <input class='opt' type="radio" name="ans<?php echo $i; ?>" value="<?php echo $questions['ans1']; ?>" id="radio01<?php echo $i; ?>"><label for="radio01<?php echo $i; ?>"><span></span><?php echo $questions['ans1']; ?></label><br>
                    <input class='opt' type="radio" name="ans<?php echo $i; ?>" value="<?php echo $questions['ans2']; ?>" id="radio02<?php echo $i; ?>"><label for="radio02<?php echo $i; ?>"><span></span><?php echo $questions['ans2']; ?></label><br>
                    <input class='opt' type="radio" name="ans<?php echo $i; ?>" value="<?php echo $questions['ans3']; ?>" id="radio03<?php echo $i; ?>"><label for="radio03<?php echo $i; ?>"><span></span><?php echo $questions['ans3']; ?></label><br>
                    <input class='opt' type="radio" name="ans<?php echo $i; ?>" value="<?php echo $questions['ans4']; ?>" id="radio04<?php echo $i; ?>"><label for="radio04<?php echo $i; ?>"><span></span><?php echo $questions['ans4']; ?></label><br>
                </p>
                <?php } ?>
            </form>
        </div>
        <div class="whole">
            <h4>Go to passage:</h4>
            <?php
                $passage_count = count(get_all_passages());
                for ($i = 1; $i <= $passage_count; $i++) {
                                 
            ?>            
            <a href="reading.php?passage=<?php echo $i; ?>"><input type="button" value="<?php echo $i ?>"></a>
            <?php
                }
            ?>
            <div style="float: right">
                <a href="studentmain.php">Go to main menu</a>
            </div>
        </div>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>