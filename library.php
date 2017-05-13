<?php
session_start();
$_SESSION['conn'] = mysqli_connect('localhost:3306', 'root', 'root', 'cll');
if($_SESSION['conn']->connect_error){
    die('Error : ('. $_SESSION['conn']->connect_errno .') '. $_SESSION['conn']->connect_error);
}
#Function to authenticate user id and password
function check_login($username,$password){
	
	$username = mysqli_real_escape_string($_SESSION['conn'], $username);
	$password = mysqli_real_escape_string($_SESSION['conn'], $password);
	$sql = "SELECT * FROM `student_login_tabl` WHERE `sid` = '$username' and `pass` = PASSWORD('$password')";
	$column = "";
	$result=mysqli_query($_SESSION['conn'],$sql);
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$_SESSION['sid'] = $row['sid'];
			$column = $row;
		}
	}else{
		$column = "0";
	}
	return $column;	
}

#Function to log out
function logout(){
	session_destroy();
}

#Function to register new user
function student_register($name,$rollno,$username,$password){
	$username = mysqli_real_escape_string($_SESSION['conn'], $username);
	$password = mysqli_real_escape_string($_SESSION['conn'], $password);
	$name = mysqli_real_escape_string($_SESSION['conn'], $name);
	$rollno = mysqli_real_escape_string($_SESSION['conn'], $rollno);
	
	$sql = "INSERT INTO `student_login_tabl` (sid,pass,name,rno) VALUES ('$username',PASSWORD('$password'),'$name','$rollno')";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}

	$sql1 = "INSERT INTO `marks` (`sid`) VALUES ('".$username."')";
	if ($_SESSION['conn']->query($sql1) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

#Function to get user details from user id
function get_user_details($user_id){
	$sql = "SELECT * FROM `student_login_tabl` WHERE `sid` = '".$user_id."' ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	$column = "";
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

#Function to get passages for reading module
function get_passages($k){
	$sql = "SELECT `passage` FROM `passage_tabl` WHERE `id`= ".$k." ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	$column = "";
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

#Function to get questions for reading module
function get_questions($k){
	$sql = "SELECT * FROM `questions` WHERE `id`=".$k." ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	$column = array();
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column[] = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

function get_all_passages(){
	$sql = "SELECT * FROM `passage_tabl` ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	$column = array();
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column[] = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}


#navbar
function navbar(){
	$user_details = get_user_details($_SESSION['sid']);
	echo '
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded navbar-fixed-top">            
            <a class="navbar-brand" href="index.php">Interactive Language Learning</a>
            <div class="pull-right" style="margin-left: 65%;">
                <ul class="nav navbar-nav" style="width: 100%;">
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href=# id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            echo $_SESSION['sid'];
                        echo '</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="studentdashboard.php">Dashboard</a>
                            <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Sign-out</a>
                        </div>
                    </li>
                    <li class="profile-image">                        
                        <a class="nav-link" href="#">';
                                if($user_details['image']!=null){ 
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $user_details['image'] ).'" width="50" height="50">';
                                }else{
                                    echo '<img class="profile-image" src="pics/avatar.png">';
                                }
                        echo '
                        </a>
                        
                    </li>
                </ul>
            </div>
	</nav>';
}

#function to change the password
function change_password($Current_Password,$New_Password,$Confirm_Password){
	$sql = "SELECT * FROM `student_login_tabl` WHERE `sid` = '".$_SESSION['sid']."' and `pass` = PASSWORD('".$Current_Password."')";
	$column = "";
	$result=mysqli_query($_SESSION['conn'],$sql);
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			if($New_Password == $Confirm_Password){
				$update_sql = "UPDATE `student_login_tabl` SET `pass` = PASSWORD('".$New_Password."') WHERE `sid` = '".$_SESSION['sid']."' ";
				if ($_SESSION['conn']->query($update_sql) === TRUE) {
					header("Location: studentdashboard.php?password_change=success");
               		exit();
				} else {
					return $_SESSION['conn']->error;
				}
			}else{
				header("Location: studentdashboard.php?password_change=failed");
               	exit();
			}
		}
	}else{
		header("Location: studentdashboard.php?password_change=curpassincorrect");
       	exit();
	}
	return $column;
}


#funtion to change profile pic
function change_profile_picture($image){
	$sql = "UPDATE `student_login_tabl` SET `image` ='$image' WHERE `sid` = '".$_SESSION['sid']."' ";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

#function to get student's marks
function get_marks(){
	$sql = "SELECT `marks` FROM `marks` WHERE `sid` = '".$_SESSION['sid']."' ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column = $row['marks'];
		}
	}else{
		$column = '0';
	}
	return $column;
}

#function to calculate marks
function calculate_passage_marks($passage,$ans1,$ans2,$ans3,$table_name='questions'){
	$student_marks = get_marks();
	$ans = array();
	$ans[] = $ans1;
	$ans[] = $ans2;
	$ans[] = $ans3;	
	for($i=1;$i<=3;$i++){
		$j = $i;
		--$j;
		$sql = "SELECT `ans` FROM $table_name WHERE `q_id` = '".$passage.$i."' ";
		$result = mysqli_query($_SESSION['conn'],$sql);
		if(mysqli_num_rows($result)>0){
			while($row = $result->fetch_assoc()){
				if($ans[$j] == $row['ans']){
					$student_marks++;
				}
			}
		}
	}

	$marks_sql = " UPDATE `marks` SET `marks` ='$student_marks' WHERE `sid` = '".$_SESSION['sid']."' ";
	if ($_SESSION['conn']->query($marks_sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

#function to get audio details
function get_audio_details($audio_id=''){
	$sql = "SELECT * FROM `audio` ";
	if($audio_id!=''){
		$sql.=" WHERE `id`=$audio_id ";
	}
	#echo $sql;
	$column = array();
	$result = mysqli_query($_SESSION['conn'],$sql);
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column[] = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

function get_audio_questions($k){
	$sql = "SELECT * FROM `audio_questions` WHERE `id`=".$k." ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	$column = array();
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column[] = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

function check_faculty_login($username,$password){

	$username = mysqli_real_escape_string($_SESSION['conn'], $username);
	$password = mysqli_real_escape_string($_SESSION['conn'], $password);
	$sql = "SELECT * FROM `faculty_login_tabl` WHERE `fid` = '$username' and `pass` = PASSWORD('$password')";
	$column = "";
	$result=mysqli_query($_SESSION['conn'],$sql);
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$_SESSION['fid'] = $row['fid'];
			$column = $row;
		}
	}else{
		$column = "0";
	}
	return $column;	
}

#Function to get user details from user id
function get_faculty_details($user_id){
	$sql = "SELECT * FROM `faculty_login_tabl` WHERE `fid` = '".$user_id."' ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	$column = "";
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

function navbar_faculty(){
	$user_details = get_faculty_details($_SESSION['fid']);
	echo '
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded navbar-fixed-top">            
            <a class="navbar-brand" href="index.php">Interactive Language Learning</a>
            <div class="pull-right" style="margin-left: 65%;">
                <ul class="nav navbar-nav" style="width: 100%;">
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle" href=# id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            echo $_SESSION['fid'];
                        echo '</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Sign-out</a>
                        </div>
                    </li>
                    <li class="profile-image">                        
                        <a class="nav-link" href="#">';
                                if($user_details['image']!=null){ 
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $user_details['image'] ).'" width="50" height="50">';
                                }else{
                                    echo '<img class="profile-image" src="pics/avatar.png">';
                                }
                        echo '
                        </a>
                        
                    </li>
                </ul>
            </div>
	</nav>';
}

function get_question_for_edit($k){
	$sql = "SELECT * FROM `questions` WHERE `q_id`=".$k." ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

function update_question($q_id,$question,$ans1,$ans2,$ans3,$ans4,$ans){
	$sql="UPDATE `questions` SET `question` = '$question', `ans1` = '$ans1', `ans2` = '$ans2', `ans3` = '$ans3', `ans4` = '$ans4', `ans` = '$ans' WHERE `q_id` = $q_id";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

function add_question($id,$q_id,$question,$ans1,$ans2,$ans3,$ans4,$ans){
	$sql="INSERT INTO `questions` (`question`,`ans1`,`ans2`,`ans3`,`ans4`,`ans`,`id`,`q_id`) VALUES ('$question', '$ans1', '$ans2', '$ans3', '$ans4', '$ans', $id, $q_id)";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}
function get_q_id($id){
	if(get_audio_questions($id)!=0){
		$curr_ques_count = count(get_questions($id));
	}else{
		$curr_ques_count = 0;
	}
	$next_question_id = $id.++$curr_ques_count;
	return $next_question_id;	
}

function modal_generator($title='delete',$content,$id){
	echo '
	<div class="modal fade" id="myModal_'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModal">Confirm your action.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  		<span aria-hidden="true">&times;</span>
					</button>
				</div>
			  	<div class="modal-body">
			  		<form method="post">
			  		Are you sure you want to '.$title.' the '.$content.'?
			  		<input type="hidden" name="modalQuestionID" value="'.$id.'">
			  	</div>
			  	<div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				    <button type="submit" class="btn btn-primary" name="modalSubmit">Save changes</button>
			  	</div>
			  		</form>
			</div>
		</div>
	</div>';	
}

function delete_question($q_id){
	$sql="DELETE FROM `questions` WHERE `q_id` = $q_id";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}	
}

function get_passage_for_edit($k){
	$sql = "SELECT * FROM `passage_tabl` WHERE `id`=".$k." ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

function update_passage($id,$passage){
	$sql="UPDATE `passage_tabl` SET `passage` = '$passage' WHERE `id` = $id";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

function add_passage($passage){
	$sql="INSERT INTO `passage_tabl`(`passage`) VALUES ('$passage')";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

function delete_passage($id){
	$sql="DELETE FROM `passage_tabl` WHERE `id` = $id";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}	
}

function get_all_audio(){
	$sql = "SELECT * FROM `audio` ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	$column = array();
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column[] = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

function add_audio($audio,$path="\\\cll\\\audio"){
	$sql="INSERT INTO `audio`(`name`,`path`) VALUES ('$audio','$path')";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

function add_audio_question($id,$q_id,$question,$ans1,$ans2,$ans3,$ans4,$ans){
	$sql="INSERT INTO `audio_questions` (`question`,`ans1`,`ans2`,`ans3`,`ans4`,`ans`,`id`,`q_id`) VALUES ('$question', '$ans1', '$ans2', '$ans3', '$ans4', '$ans', $id, $q_id)";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

function get_audio_q_id($id){
	if(get_audio_questions($id)!=0){
		$curr_ques_count = count(get_audio_questions($id));
	}else{
		$curr_ques_count = 0;
	}
	$next_question_id = $id.++$curr_ques_count;
	return $next_question_id;	
}

function get_audio_question_for_edit($k){
	$sql = "SELECT * FROM `audio_questions` WHERE `q_id`=".$k." ";
	$result = mysqli_query($_SESSION['conn'],$sql);
	if(mysqli_num_rows($result)>0){
		while($row = $result->fetch_assoc()){
			$column = $row;
		}
	}else{
		$column = '0';
	}
	return $column;
}

function update_audio_question($q_id,$question,$ans1,$ans2,$ans3,$ans4,$ans){
	$sql="UPDATE `audio_questions` SET `question` = '$question', `ans1` = '$ans1', `ans2` = '$ans2', `ans3` = '$ans3', `ans4` = '$ans4', `ans` = '$ans' WHERE `q_id` = $q_id";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}

function delete_audio_question($q_id){
	$sql="DELETE FROM `audio_questions` WHERE `q_id` = $q_id";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}	
}

function delete_audio($id){
	$sql="DELETE FROM `audio` WHERE `id` = $id";
	if ($_SESSION['conn']->query($sql) === TRUE) {
		return '1';
	} else {
		return $_SESSION['conn']->error;
	}
}
?>