<?php
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysqli_select_db($db, DB_NAME) or die("Error: ".mysqli_error($db));

function query($query_string){
	global $db;
	return mysqli_query($db, $query_string) or die("Error: ".mysqli_error($db));
}
?>