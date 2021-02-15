<!DOCTYPE html>
<?php
    ob_start();

    if (!isset($_SESSION)) {
        session_start();
    }

    require_once "scripts/config.php";
    require_once "scripts/db_con.php";

    $promotions = mysqli_query($db, "SELECT * FROM promotion ORDER BY RAND() LIMIT 1");
    $restaurants = mysqli_query($db, "SELECT * FROM featured ORDER BY RAND() LIMIT 1");
    $deals = mysqli_query($db, "SELECT * FROM deals ORDER BY RAND() LIMIT 9");
    $news = mysqli_query($db, "SELECT * FROM news");
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="shortcut icon" href="https://www.mydiscountedfood.my/favicon.ico" type="image/x-icon">
	<link rel="icon" href="https://www.mydiscountedfood.my/favicon.ico" type="image/x-icon">
    <title>Home - MyDiscountedFood </title>

    <!-- Bootstrap Core CSS -->
    <link href="themecss/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="themecss/food-homepage.css" rel="stylesheet">
	<link href="css/jquery.bxslider.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



</head>

<body>

	<?php include "header.php";  ?>

     <!-- Navigation -->
    <?php include "top_navigation.php"; ?>
    
    <!-- Page Content -->
    $cuisine_arr = array("Buffet" => "restaurant_buffet", 
                        "Chinese" => "restaurant_chinese", 
                        "Western" => "restaurant_western", 
                        "Malay" => "restaurant_malay", 
                        "Indian" => "restaurant_indian", 
                        "Japanese" => "restaurant_japanese", 
                        "Korean"  => "restaurant_korean", 
                        "Italian"  => "restaurant_italian", 
                        "Taiwanese" => "restaurant_taiwanese", 
                        "Thai"  => "restaurant_thai", 
                        "Seafood"  => "restaurant_seafood", 
                        "Steamboat" => "restaurant_steamboat", 
                        "Health Food"  => "restaurant_healthfood", 
                        "Leisure" => "restaurant_leisure",
                        "Local" => "restaurant_local",
                        "Nyonya" => "restaurant_nyonya" , 
                        "Vegetarian" => "restaurant_vegetarian");

    $restaurant_arr = array("Cafe" => "restaurant_cafe" , 
                            "Dessert" => "restaurant_desserts", 
                            "Ice Cream" => "restaurant_icecream",
                            );   

    $other_deals = array("Local Products" => "shops_localproducts", 
                        "Local Favourites" => "shops_localfavourites",
                         "Cake & Pastry" => "shops_cakepastry",
                         "Healthy Bread" => "shops_healthybread",
                         "Organic Food" => "shops_organicfood")


    <div class="container page-container">

        <div class="row">

            <div class="col-md-3">
				<div class="row side-list-divs" id="">
					<p class="lead list-header">Select Cuisine</p>
					<div class="list-group">
						<?php                       

                        foreach($cuisine_arr as $cuisine => $cfile) {
                            echo `<a class="list-group-item" href="../{$cfile}.php">{$cuisine} Cuisine</a>`;
                        }

                        foreach($restaurant_arr as $restaurant => $rfile) {
                            echo `<a class="list-group-item" href="../{$rfile}.php">{$restaurant} Restaurant</a>`;
                        }

                        ?>
					</div>
					<p class="lead list-header">Other Deals</p>
					<div class="list-group">
                    <?php
                        foreach($other_deals as $deal => $dfile) {
                            echo `<a href="../{$dfile}.php" class="list-group-item">{$deal} Shops</a>`;
                        }
                    ?>
					</div>
					
					<p class="lead list-header">Promotions</p>
					<div class="container-fluid">
						<div class="row">
                            <?php while ($row_promotion = mysqli_fetch_array($promotions, MYSQLI_ASSOC)): ?>
                                
                                    <div class="thumbnail promotion">
                                        <a href="<?php echo $row_promotion['link']; ?>"><img src='../scripts/image.php?id=<?php echo $row_promotion['photo']; ?>' class="img-responsive center-block " /> </a>
                                        <span><?php echo $row_promotion['title'] ?></span>
                                    </div>
                                        
                            <?php endwhile; ?>
						</div>
					</div>
				</div>
            </div>
			
            <div class="col-md-9">
                <div class="row">
					<?php while ($row_deal = mysqli_fetch_array($deals, MYSQLI_ASSOC)): ?>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                                <a href="dealDetail.php?id=<?php echo $row_deal['id']; ?>">
                                <div class="crop-container">
                                    <img src='../scripts/image.php?id=<?php echo $row_deal['photo']; ?>' /> 
                                </div>
                                </a>
                                <div class="caption" >
                                    <h4><a href="dealDetail.php?id=<?php echo $row_deal['id']; ?>"><?php echo substr($row_deal['restaurant_name'],0,35); ?>..</a></h4>
                                    <p><?php echo $row_deal['deal_note']; ?></p>
                                </div>
                                
                                <div class="ratings">
                                        <div style="color: #000;font-weight:bold;">Deal Price : <?php echo $row_deal['item_discounted_price']; ?><!--MYR--></div>
                                        
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->


    <?php include "footer.php"; ?>

    <!-- jQuery Version 1.11.0 -->
    <script src="themejs/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="themejs/bootstrap.min.js"></script>

</body>
</html>
