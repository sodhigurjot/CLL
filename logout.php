<?php
include('library.php');
logout();
header("Location: register.php?logout=yes");
exit;
?>