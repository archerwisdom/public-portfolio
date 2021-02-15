<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
include_once("scripts/mdf_functions.php");
?>

<?php
require_once "scripts/config.php";
require_once "scripts/db_con.php";

$restarants_users = mysqli_query($db, "SELECT * FROM myfoodrestaurant_booking_restaurants");
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
    	<title>Add Deal</title>

    <!-- Bootstrap Core CSS -->
    <link href="themecss/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="themecss/food-homepage.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    
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
    <nav class="navbar navbar-custom" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
			<select class="form-control location-selector" onchange="location = this.options[this.selectedIndex].value;">
				<option value="-1">Select Cuisine</option>
				<option value="restaurant_buffet.php">Buffet Restaurants</option>
				<option value="restaurant_chinese.php">Chinese Restaurants</option>
				<option value="restaurant_western.php">Western Restaurants</option>
				<option value="restaurant_indian.php">Indian Restaurants</option>
                <option value="restaurant_japanese.php">Japanese Restaurants</option>
                <option value="restaurant_taiwanese.php">Taiwanese Restaurant</option>
                <!--<option value="restaurant_steamboat.php">Steamboat Restaurants</option>-->
                <option value="restaurant_healthfood.php">Health Food Restaurants</option>
			</select>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php include_once("new_theme_header.php"); ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
        <div class="container">
<?php
$page_accessible = check_accesspage($_SESSION[_user_id_], basename(__FILE__));
if(!$page_accessible){

    display_login_request();

}else{
?>         
            <div class="row">
                <div class="shop_holder">
                    <h2 class="PageHeader1">Add Deal</h2>
                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 " >

                        <div class="col-md-12 col-sm-12 ">
                            <div class="">
                                <div class="shop_holder">
                                    <div class="row">
                                        <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-12 col-lg-10 col-lg-offset-1">
                                            <a href="manageDeals.php" class="btn btn-info">Manage Deals</a> <br><br>
                                        </div>
                                    </div>
                                    <div class="col-md-12  col-sm-12  col-xs-12 ">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12  col-sm-12 col-xs-12">
                                                    <form class="form-horizontal" role="form" action="scripts/addDeal.php" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group">
                                                            <label for="title" class="col-sm-3 control-label">Deal Title</label>
                                                            <div class="col-sm-9">
                                                               <input type="text" class="form-control" name="title" placeholder="Deal Title">
                                                            </div>
                                                        </div>
														 <div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> Item Name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="itemname" placeholder="Item Name" >
                                                            </div>
                                                        </div>
														<div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> Normal Price</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="normalprice" placeholder="Normal price of Item" >
                                                            </div>
                                                        </div>
														<div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> Deal Price</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="dealprice" placeholder="Deal price of Item" >
                                                            </div>
                                                        </div>
														<div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> Start Date</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="dealstartdt" id="startdt" placeholder="" >
                                                            </div>
                                                        </div>
														<div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> End Date</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="dealenddt" id="enddt" placeholder="" >
                                                            </div>
                                                        </div>
														 <div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> Restaurant Name</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="restaurantname">
																	<?php while ($row_restaurants = mysqli_fetch_array($restarants_users, MYSQLI_ASSOC)): ?>
																		<option value="<?php echo $row_restaurants['restaurant_title']; ?>"><?php echo $row_restaurants['restaurant_title']; ?></option>
																			
																	   
																	<?php endwhile; ?>
																<!--
																	<option value="one">One</option>
																	<option value="two">Two</option>
																	<option value="three">Three</option>
																	<option value="four">Four</option>
																	<option value="five">Five</option>
																	
																-->
																</select>
                                                            </div>
                                                        </div>
														<div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> Reataurant Location </label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="location" placeholder="Location" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> Deal Note</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control" name="note" placeholder="Deal Note" rows=5></textarea>
                                                            </div>
                                                        </div>
														<div class="form-group">
                                                            <label for="content" class="col-sm-3 control-label"> Deal Term</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control" name="term" placeholder="Deal Term" rows=5></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="photo" class="col-sm-3 control-label"> Food Photo</label>
                                                            <div class="col-sm-9">
                                                                <input type="file" name="photo" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-offset-2 col-sm-10">
                                                                <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
                                                                <button type="submit" class="btn btn-primary">Reset</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
}
?>             
        </div> <!-- /container -->

<div class="container container-full">
        <!-- Footer -->
        <footer>
            <div class="row row-footer">
				 <div class="col-md-3">
					<div class="contactus-container">
						<p>Want to Advertise with us?</p>
						<span>For more information : </span>
						<div class="email-tel">
							<p>Tel   : 012-4929063 Alex (Penang)</p>
							<p>Email : support@mydiscountedfood.my </p>
						</div>
					</div>
				 </div>
				 
				  <div class="col-md-5 icons-service">
					<div class="icons-container">
						<ul class="list-inline" id="fruits">
						<li><img src="images/bstdeal.png" width="70%"/></li>
						<li><img src="images/chef_icon_text.png" width="70%"/></li>
						<li><img src="images/scooter_new.png" width="80%"/></li>
					</ul>
					</div>
				 </div>
				 
                <div class="col-md-3 followus-container">
					
					<div class="followus-container ">
                    <p>Share with friends</p>
					<ul class="list-inline" id="fruits">
						<li><a href="http://www.facebook.com"><img src="images/fbicon.png" width="70%"/></a></li>
						<li><a href="https://twitter.com"><img src="images/twicon.png" width="70%"/></a></li>
						<li><a href="mailto:support@mydiscountedfood.my"><img src="images/emailicon.png" width="70%"/></li>
					</ul>
					</div>
                </div>
				
            </div>
			
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="themejs/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="themejs/bootstrap.min.js"></script>

    </body>
</html>