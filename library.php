<?php
session_start();
$_SESSION['conn'] = mysqli_connect('localhost:3306', 'root', 'root', 'cll');
if($_SESSION['conn']->connect_error){
    die('Error : ('. $_SESSION['conn']->connect_errno .') '. $_SESSION['conn']->connect_error);
}

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

function logout(){
	session_destroy();
}

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
}
?>