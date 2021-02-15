<?php

header('Location: login_main.php');

ob_start();
if (!isset($_SESSION)) {
    session_start();
}

?>

<?php
if (isset($_POST['username'])) {
    require_once 'scripts/config.php';
    require_once 'scripts/db_con.php';

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $result = mysqli_query($db, "SELECT user_name FROM users WHERE password='" . $password . "' AND user_name='" . $username . "'");
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['_user_id_'] = base64_encode($username);
            header('Location: login.php');
        } else {
            echo "<p style='color: red;'>Username or Password Incorrect!!</p>";
        }
    } else {
        echo "<p style='color: red;'>Could not connect to server. Try again!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="">
    	<meta name="author" content="">
		<link rel="shortcut icon" href="https://www.mydiscountedfood.my/favicon.ico" type="image/x-icon">
		<link rel="icon" href="https://www.mydiscountedfood.my/favicon.ico" type="image/x-icon">
    	<title></title>

    <!-- Bootstrap Core CSS -->
    <link href="themecss/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="themecss/food-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

    <body>

        <div class="page-header header-banner">
	   <div class="logo-container">
			<img src="images/logo-name.png" />
	   </div>
	</div>

    <!-- Navigation -->
    <?php include "top_navigation.php"; ?>
        
         <div class="container" style="min-height:230px;">
            <div class="row">
                <div class="shop_holder">
                    <h2 class="PageHeader1">Login</h2>
                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 " >
                        <div class="col-md-12 col-sm-12 ">
                            <div class="">
                                <div class="shop_holder">
                                    <div class="col-md-12  col-sm-12  col-xs-12 ">
                                        <div class="row">
                                            <center><img src="images/login-hotdeals.png" width="20%"></center>
                                            <div class="row">
                                                <?php if (isset($_SESSION['_user_id_'])): ?>
                                                    <div class="col-md-12  col-sm-12 col-xs-12">
                                                        <form class="form-horizontal" role="form">
                                                            <center>
                                                                <h4 style="color:#333; font-family:Cambria; font-size:20px; word-spacing:10px;"><i>Click to add your advertisements here</i></h4>
                                                                <div class="form-group">
                                                                    <div class="col-sm-offset-2 col-sm-8">
                                                                        <a href="addAdvertise.php" class="btn btn-primary">Add Advertisement</a>
                                                                    </div>
                                                                </div>
                                                            </center>
                                                        </form>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="col-md-12  col-sm-12 col-xs-12">
                                                        <form class="form-horizontal" role="form" method="post">
                                                            <div class="form-group">
                                                                <label for="useName" class="col-sm-3 control-label">Username</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password" class="col-sm-3 control-label">Password</label>
                                                                <div class="col-sm-8">
                                                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-5 col-sm-8">
                                                                    <button type="submit" class="btn btn-primary" value='Login'>Submit</button>
                                                                    <button type="submit" class="btn btn-primary">Reset</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /container -->

    <!-- Footer -->
    <?php include "footer.php"; ?>
 

    <!-- jQuery Version 1.11.0 -->
    <script src="themejs/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="themejs/bootstrap.min.js"></script>


    </body>
</html>