<?php
if(empty($_SESSION['sid']) || $_SESSION['sid']!=''){
	header("Location: index.php");
	exit;	
}
echo "<a href=\"logout.php\">Logout</a>";
?>