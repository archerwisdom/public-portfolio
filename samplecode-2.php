<?php
if (!isset($_SESSION)) {
session_start();
}
require_once "scripts/config.php";
require_once "scripts/db_con.php";
include_once("scripts/mdf_functions.php");
require "scripts/area.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="">
    	<meta name="author" content="">
		<link rel="shortcut icon" href="https://www.mydiscountedfood.my/themetemp/favicon.ico" type="image/x-icon">
		<link rel="icon" href="https://www.mydiscountedfood.my/themetemp/favicon.ico" type="image/x-icon">
    	<title>Area - MyDiscountedFood </title>

    <!-- Bootstrap Core CSS -->
    <link href="themecss/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="themecss/food-homepage.css" rel="stylesheet">

    </head>

    <body>

	<?php include "header.php";  ?>
	
    <?php include "top_navigation.php"; ?>

        <center><?php include "hitcount_area.php"; ?></center>
                                    
        <div class="container">

<?php

$query_s = $db->query("SELECT state_name FROM states WHERE country_id = 150 ORDER BY state_name DESC");
$rows_states = array();
while ($row_s = $query_s->fetch_assoc())
{
//  print_r($row_s);
    array_push($rows_states, $row_s['state_name']);
}

//var_dump("FETCH ALL:",$rows_states);
//print_r($rows_states);


//Get all city data
$query = $db->query("SELECT adv.company_id, adv.company_name, st.state_name, ct.city_name FROM advertise AS adv 
                      LEFT JOIN states AS st ON adv.state_id = st.state_id 
                      LEFT JOIN cities AS ct ON adv.city_id=ct.city_id 
                      WHERE adv.status=1");

//Count total number of rows
$rowCount = $query->num_rows;

$list_company = array();
while($row = $query->fetch_assoc()){ 

  //$list_company[] = $row;
  array_push($list_company, $row);
    /*print_r($row);
    echo "<hr>";*/
}
/*print_r("LIST:");
print_r($list_company);
*/
$filter_companybystate = array();
//print_r("STATES:");
foreach ($list_company as $key => $company_info) {
  # code...
  
  if(in_array($company_info['state_name'], $rows_states)){
  /*  print_r("Yes:". $company_info['state_name']);
    print_r($company_info['city_name']);
  */  
    $filter_companybystate[$company_info['state_name']][] = $company_info['city_name'];
    //array_push($filter_companybystate[$company_info['state_name']], "TEST");
   // $a = array_fill_keys($$filter_companybystate[$company_info['state_name']], $company_info['city_name']);
  }

}

/*print_r("FINISH:");
print_r($filter_companybystate);*/
?>

<!-- Populate States -->
<div class="panel-group" id="accordion_states">
<?php
//populate the cities according to state
foreach ($rows_states as $row => $state_name) {
?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion_states" href="#collapse<?php echo $row; ?>">
        <?php echo ($state_name); echo '  <span class="badge">'.sizeof($filter_companybystate[$state_name]).'</span>'; ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $row; ?>" class="panel-collapse collapse">
      <div class="panel-body">
<?php
    if(array_key_exists($state_name, $filter_companybystate)){

      $listofcities = array_count_values($filter_companybystate[$state_name]);

      //populate the cities
      foreach ($listofcities as $key_city => $value_city) {
        //echo '<button class="btn btn-primary" type="button">Messages <span class="badge">4</span></button>';
        echo '<a class="btn btn-success" style="margin: 0px 5px;" href="#" role="button">'.$key_city.'&nbsp <span class="badge">'.$value_city.'</span></a>';
      }

    }else{
      echo "Coming Soon";
    }
?>

      </div>
    </div>
  </div>

<?php
}
//END populate the cities according to state
?> 
</div>
<!--End Populate States -->

    </div> <!-- /container -->

<?php include "footer.php"; ?>
    
    <!-- jQuery Version 1.11.0 -->
    <script src="themejs/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="themejs/bootstrap.min.js"></script>

</body>
</html>