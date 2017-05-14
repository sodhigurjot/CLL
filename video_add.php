<?php
include('library.php');
if(empty($_SESSION['fid']) || $_SESSION['fid']==''){
    header("Location: flogin.php");
    exit();   
}
$success_msg = '';
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
        	if(isset($_POST['submit'])) {
				$uploads_dir = "D:/wamp64/www/cll/interview_video";
				$tmp_name = $_FILES["video"]["tmp_name"];
				$name = basename($_FILES["video"]["name"]);
				$uploaded_file_name = $uploads_dir."/".$name;
				move_uploaded_file($tmp_name, $uploaded_file_name);
				$path = addslashes("\cll\interview_video");
				add_video($name,$path,$_POST['content']);
				$success_msg.= '
					<div class="alert alert-success">Passage successfully updated.</div>';
			}      
            $faculty_details = get_faculty_details($_SESSION['fid']);
            navbar_faculty();
        ?>	
        <div class="container">
			<?php
				echo $success_msg;
			?>
			
			<form method="post" enctype="multipart/form-data" action="">

				<span style="float: right;">
					<a href="interview_list.php">
						<i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 20px;">
							Back
						</i>
					</a>
				</span>
				<br>
				<h2>
					Add video
				</h2>
				<br>			
				<div class="form-group row">
					<label class="col-2 col-form-label">Upload file</label>
					<div class="col-10">
						<input type="file" class="form-control" name="video"> 
					</div>
				</div>

				<div class="form-group">
					<label class="col-form-label">Content</label>
					<textarea class="form-control" name="content" rows="6"></textarea>
				</div>

				<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">

			</form>
        </div>
        <script src="js/navbar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    </body>
</html>