<?php
require_once 'config.php';
require_once 'db_con.php';

if(isset($_POST['title'])){
	$deal_id = $_POST['deal_id'];

	if(isset($_FILES['photo'])){
		$allowed_images = array("image/jpeg", "image/jpg", "image/bmp", "image/x-png", "image/pjpeg", "image/gif", "image/png");
		$MIME = $_FILES["photo"]["type"];
		if(is_uploaded_file($_FILES['photo']['tmp_name'])&&in_array($MIME, $allowed_images)){
			$image = file_get_contents($_FILES['photo']['tmp_name']);
		}
	}
	$productid = mysqli_real_escape_string($db, $_POST['productid']);
	$buybtn = mysqli_real_escape_string($db, $_POST['buybtn']);
	$title = mysqli_real_escape_string($db, $_POST['title']);
	$itemnname = mysqli_real_escape_string($db, $_POST['itemnname']);
	$normalprice = mysqli_real_escape_string($db, $_POST['normalprice']);
	$dealprice = mysqli_real_escape_string($db, $_POST['dealprice']);
	$dealstartdt = mysqli_real_escape_string($db, $_POST['dealstartdt']);
	$dealenddt = mysqli_real_escape_string($db, $_POST['dealenddt']);
	$restaurantname = mysqli_real_escape_string($db, $_POST['restaurantname']);
	$resultid = mysqli_fetch_array(mysqli_query($db, "SELECT id FROM myfoodrestaurant_booking_restaurants WHERE restaurant_title='$restaurantname'"));
	//print_r($restarantid);
	$restarantid = $resultid['id'];
	
	$location = mysqli_real_escape_string($db, $_POST['location']);
	$note = mysqli_real_escape_string($db, $_POST['note']);
	$term = mysqli_real_escape_string($db, $_POST['term']);
	$image = mysqli_real_escape_string($db, $image);
	if(is_uploaded_file($_FILES['photo']['tmp_name'])){
		if($res = mysqli_query($db, "SELECT MAX(photo_id) FROM photos")){
			$row = mysqli_fetch_assoc($res);
			$photo_id = $row['MAX(photo_id)']+1;
			$r2 = query("DELETE FROM photos WHERE photo_id=(SELECT photo FROM promotion WHERE promotion_id=".$deal_id.")");
			$r = query("INSERT INTO photos (photo_id, photo, photo_type) VALUES ({$photo_id}, '{$image}', '{$MIME}')");
		}
	}
		
		$result = query("UPDATE deals SET item_name='{$itemnname}', ".((!($photo_id==""))?"photo={$photo_id}, ":"")."title='{$title}',
		item_normal_price='{$normalprice}',
		item_discounted_price='{$dealprice}',
		start_deal_dt = '{$dealstartdt}',
		end_deal_dt = '{$dealenddt}',
		restaurant_name = '{$restaurantname}',
		restaurant_location = '{$location}',
		deal_note = '{$note}',
		restaurant_id = '{$restarantid}',
		productid = '{$productid}',
		buybtn = '{$buybtn}',
		deal_term = '{$term}' WHERE id=".$deal_id);
		mysqli_close($db);
		if($result)
			header("Location: ../updateDeal.php");
		else
			echo "Updating Deal failed.";
}
?>