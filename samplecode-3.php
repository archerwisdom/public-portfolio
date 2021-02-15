<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Header</title>
<script type="text/javascript">
function confirmSubmit(){
	return confirm("Please confirm");	
}
</script>
<link rel="stylesheet" type="text/css" href="mystyle.css" />
</head>

<body>
<center>

<img src="images/header.jpg" class="v1col" width="100%" align="middle" border="0"  bordercolor="#FFFFFF"/>
<br />

    <a href="index.php"><img src="images/home1.jpg" border="0"/></a>
    <a href="area.html"><img src="images/area1.jpg" border="0" /></a>
    <a href="food_type.php"><img src="images/cuisine_style1.jpg" border="0"/></a>
    <a href="advertise.html"><img src="images/advertise1.jpg" border="0"/></a>
    <!--<a href="contact_us.php"><img src="images/contact_us1.jpg" border="0"/></a>-->
    <a href="loginfirst.php"><img src="images/login1.jpg" border="0"/></a>

<?php
if(isset($_SESSION['_user_id_'])){
	echo "<a href='scripts/logout.php'><img src='images/Log Out.jpg' width='50' height='50'></a>";	
}
?>
</center>
</body>
</html>