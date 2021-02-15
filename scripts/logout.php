<?php
if (!isset($_SESSION)) {
session_start();
}

if(isset($_SESSION['_user_id_'])){
	session_destroy();
}
header("Location: ../login_main.php");
?>