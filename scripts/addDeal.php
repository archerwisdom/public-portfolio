<?php
require_once 'config.php';
require_once 'db_con.php';

if(isset($_POST['title'])){
	if(isset($_FILES['photo'])){
		$allowed_images = array("image/jpeg", "image/jpg", "image/bmp", "image/x-png", "image/pjpeg", "image/gif", "image/png");
		$MIME = $_FILES["photo"]["type"];
		if(is_uploaded_file($_FILES['photo']['tmp_name'])&&in_array($MIME, $allowed_images)){
			$image = file_get_contents($_FILES['photo']['tmp_name']);
		}
	}
	//$date = mysqli_real_escape_string($db, $_POST['date']);
	$productid = mysqli_real_escape_string($db, $_POST['productid']);
	$buybtn = mysqli_real_escape_string($db, $_POST['buybtn']);
	$title = mysqli_real_escape_string($db, $_POST['title']);
	$itemname = mysqli_real_escape_string($db, $_POST['itemname']);
	$normalprice = mysqli_real_escape_string($db, $_POST['normalprice']);
	$discountedprice = mysqli_real_escape_string($db, $_POST['dealprice']);
	$startdate = mysqli_real_escape_string($db, $_POST['dealstartdt']);
	$enddate = mysqli_real_escape_string($db, $_POST['dealenddt']);
	$restaurantname = mysqli_real_escape_string($db, $_POST['restaurantname']);
	
	$resultid = mysqli_fetch_array(mysqli_query($db, "SELECT id FROM myfoodrestaurant_booking_restaurants WHERE restaurant_title='$restaurantname'"));
	//print_r($restarantid);
	$restarantid = $resultid['id'];
	
	
	$location = mysqli_real_escape_string($db, $_POST['location']);
	$note = mysqli_real_escape_string($db, $_POST['note']);
	$term = mysqli_real_escape_string($db, $_POST['term']);
	$image = mysqli_real_escape_string($db, $image);
	
	if($res = mysqli_query($db, "SELECT MAX(photo_id) FROM photos")){
		$row = mysqli_fetch_assoc($res);
		$photo_id = $row['MAX(photo_id)']+1;
		
		$r = query("INSERT INTO photos (photo_id, photo, photo_type) VALUES ({$photo_id}, '{$image}', '{$MIME}')");
		$result = query("INSERT INTO deals (title, item_name,item_normal_price,item_discounted_price,start_deal_dt,end_deal_dt, restaurant_name, restaurant_location,deal_note,deal_term,photo,restaurant_id,productid,buybtn) VALUES ('$title', '$itemname','$normalprice','$discountedprice','$startdate','$enddate','$restaurantname', '$location','$note','$term','$photo_id','$restarantid','$productid','$buybtn')");
		mysqli_close($db);
		if($result && $r)
			header("Location: ../updateDeal.php");
		else
			echo "Adding Deal failed.";
	}else
		echo "Adding Deal failed.";
}
?>