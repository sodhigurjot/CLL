<?php
include('library.php');
if(empty($_SESSION['fid']) || $_SESSION['fid']==''){
    header("Location: flogin.php");
    exit();   
}
$success_msg = '';
if(isset($_POST['modalSubmit'])){
	delete_audio_question($_POST['modalQuestionID']);
	$success_msg.= '
		<div class="alert alert-success">Question successfully deleted.</div>';
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
        <link rel="stylesheet" type="text/css" href="css/DataTables/datatables.min.css"/>
        <style>
        	select.form-control:not([size]):not([multiple]){
        		height: 100% !important;
        	}
        	#table_id_wrapper{
        		display:block !important;
        	}
        </style>
    </head>
    <body>
        <?php           
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");            
            $faculty_details = get_faculty_details($_SESSION['fid']);
            navbar_faculty();
        ?>	
        <div class="container" style="margin-top: 5% !important;">
        	<span style="float: right;">
				<a href="audio_list.php">
					<i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 20px;">
						Back
					</i>
				</a>
			</span>
			<br>
			<?php
				echo $success_msg;
			?>
			<h2>
				Questions
			</h2>
			<table id="table_id" class="table table-bordered display">
				<thead>
					<tr>
						<th>Questions</th>
						<th>Option 1</th>
						<th>Option 2</th>
						<th>Option 3</th>
						<th>Option 4</th>
						<th>Correct answer</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$k = $_REQUEST["audio"];
						$questions = get_audio_questions($k);
						if(!empty($questions)){
						foreach($questions as $questions){
					?>
					<tr>
						<td><?php echo $questions['question']; ?></td>
						<td><?php echo $questions['ans1']; ?></td>
						<td><?php echo $questions['ans2']; ?></td>
						<td><?php echo $questions['ans3']; ?></td>
						<td><?php echo $questions['ans4']; ?></td>
						<td><?php echo $questions['ans']; ?></td>
						<td>
							<a href="audio_question_edit.php?q_id=<?php echo $questions['q_id']; ?>"><i class="fa fa-pencil"></i></a>
							|
							<?php
								modal_generator('delete','question',$questions['q_id']);
							?>
							<a href=# data-toggle="modal" data-target="#myModal_<?php echo $questions['q_id']; ?>"><i class="fa fa-times"></i></a>
						</td>
					</tr>
					<?php } }?>
				</tbody>
			</table>
        </div>
        <script src="js/navbar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script type="text/javascript" src="css/DataTables/datatables.min.js"></script>
        <script>
        	$(document).ready( function () {
			    $('#table_id').DataTable();
			} );
        </script>
    </body>
</html>