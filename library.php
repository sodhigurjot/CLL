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
function calculate_passage_marks($passage,$ans1,$ans2,$ans3){
	$student_marks = get_marks();
	$ans = array();
	$ans[] = $ans1;
	$ans[] = $ans2;
	$ans[] = $ans3;
	print_r($ans);
	for($i=1;$i<=3;$i++){
		$j = $i;
		--$j;
		$sql = "SELECT `ans` FROM `questions` WHERE `q_id` = '".$passage.$i."' ";
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
function get_audio_details(){
	$sql = "SELECT * FROM `audio` ";
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
?>