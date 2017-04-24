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
			<table class="table table-bordered">
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
						$k = $_REQUEST["passage"];
						$j = 1;
						$pagePassage = $k;
						$passages = get_passages($k);
						$questions = get_questions($k);
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
							<a href="" target="_BLANK"><i class="fa fa-pencil"></i></a>
							|
							<a href="" target="_BLANK"><i class="fa fa-times"></i></a>
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
    </body>
</html>