<?php
include('library.php');
if(empty($_SESSION['fid']) || $_SESSION['fid']==''){
    header("Location: flogin.php");
    exit();   
}
$success_msg = '';
if(isset($_POST['submit'])){
	$q_id = get_audio_q_id($_REQUEST["id"]);
	add_audio_question($_REQUEST["id"],$q_id,$_POST['question'],$_POST['option_one'],$_POST['option_two'],$_POST['option_three'],$_POST['option_four'],$_POST['answer']);
	$success_msg.= '
		<div class="alert alert-success">Question successfully updated.</div>';
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
			<?php
				echo $success_msg;
			?>
			
			<form method="post" onsubmit="check_ans()">
				<script>
					function check_ans(){
						if(document.getElementById('option_one_ans').checked) {
							document.getElementById('option_one_ans').value = document.getElementById('option_one').value
						}
						if(document.getElementById('option_two_ans').checked) {
							document.getElementById('option_two_ans').value = document.getElementById('option_two').value
						}
						if(document.getElementById('option_three_ans').checked) {
							document.getElementById('option_three_ans').value = document.getElementById('option_three').value
						}
						if(document.getElementById('option_four_ans').checked) {
							document.getElementById('option_four_ans').value = document.getElementById('option_four').value
						}
					}
				</script>

				<span style="float: right;">
					<a href="audio_list.php">
						<i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 20px;">
							Back
						</i>
					</a>
				</span>
				<br>
				<h2>Add question</h2>
				<br>			
				<div class="form-group row">
					<label class="col-2 col-form-label">Question</label>
					<div class="col-10">
						<textarea class="form-control" name="question" rows="3"></textarea> 
					</div>
				</div>

				<div class="form-group row">
					<label class="col-2 col-form-label">Option 1</label>
					<div class="col-10 row">
						<div class="col-10">
							<input type="text" class="form-control" name="option_one" id="option_one">
						</div>
						<div class="col-2">
							<input type="radio" name="answer" id="option_one_ans">
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-2 col-form-label">Option 2</label>
					<div class="col-10 row">
						<div class="col-10">
							<input type="text" class="form-control" name="option_two" id="option_two">
						</div>
						<div class="col-2">
							<input type="radio" name="answer" id="option_two_ans">
						</div>
					</div>
				</div>	

				<div class="form-group row">
					<label class="col-2 col-form-label">Option 3</label>
					<div class="col-10 row">
						<div class="col-10">
							<input type="text" class="form-control" name="option_three" id="option_three">
						</div>
						<div class="col-2">
							<input type="radio" name="answer" id="option_three_ans">
						</div>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-2 col-form-label">Option 4</label>
					<div class="col-10 row">
						<div class="col-10">
							<input type="text" class="form-control" name="option_four" id="option_four">
						</div>
						<div class="col-2">
							<input type="radio" name="answer" id="option_four_ans">
						</div>
					</div>
				</div>

				<input type="submit" name="submit" value="Submit" class="btn btn-primary">

			</form>

			<?php 
				
			?>
        </div>
        <script src="js/navbar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    </body>
</html>