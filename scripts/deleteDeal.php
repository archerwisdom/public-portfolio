<?php
if(isset($_POST['Ck'])){
	if(count($_POST['Ck'])>0){
		require_once "config.php";
		require_once "db_con.php";
		
		foreach($_POST['Ck'] as $c_id){
			$r1 = query("DELETE FROM photos WHERE photo_id=(SELECT photo FROM deals WHERE id=".$c_id.")");
			$r2 = query("DELETE FROM deals WHERE id=".$c_id);
		}
	}
}

header("Location: ../deleteDeal.php");
?>