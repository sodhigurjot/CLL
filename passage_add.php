<?php
include('library.php');
if(empty($_SESSION['fid']) || $_SESSION['fid']==''){
    header("Location: flogin.php");
    exit();   
}
$success_msg = '';
if(isset($_POST['submit'])){
	add_passage($_POST['passage']);
	$success_msg.= '
		<div class="alert alert-success">Passage successfully updated.</div>';
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
			
			<form method="post">

				<span style="float: right;">
					<a href="passage_list.php">
						<i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 20px;">
							Back
						</i>
					</a>
				</span>
				<br>
				<h2>Add passage</h2>
				<br>			
				<div class="form-group row">
					<label class="col-2 col-form-label">Question</label>
					<div class="col-10">
						<textarea class="form-control" name="passage" rows="6"></textarea> 
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