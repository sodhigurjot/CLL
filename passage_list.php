<?php
include('library.php');
if(empty($_SESSION['fid']) || $_SESSION['fid']==''){
    header("Location: flogin.php");
    exit();   
}
$success_msg = '';
if(isset($_POST['modalSubmit'])){
	delete_passage($_POST['modalQuestionID']);
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
				<a href="facultymain.php">
					<i class="fa fa-home" aria-hidden="true" style="font-size: 20px;">
						Home
					</i>
				</a>
			</span>
			<br>
			<?php
				echo $success_msg;
			?>
			<h2>
				Passages
			</h2>
			<table id="table_id" class="table table-bordered display">
				<thead>
					<tr>
						<th>
							Passage
							<a href="passage_add.php"><i class="fa fa-plus"></i></a>
						</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$passages = get_all_passages();
						foreach($passages as $passages){
					?>
					<tr>
						<td><?php echo $passages['passage']; ?></td>
						<td>
							<a href="reading_list.php?passage=<?php echo $passages['id']; ?>"><i class="fa fa-question"></i></a>
							|
							<?php
								modal_generator('delete','passage',$passages['id']);
							?>
							<a href=# data-toggle="modal" data-target="#myModal_<?php echo $passages['id']; ?>"><i class="fa fa-times"></i></a>
							|
							<a href="question_add.php?id=<?php echo $passages['id']; ?>" ><i class="fa fa-plus"></i></a>
							|
							<a href="passage_edit.php?id=<?php echo $passages['id']; ?>"><i class="fa fa-pencil"></i></a>
						</td>
					</tr>
					<?php } ?>
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