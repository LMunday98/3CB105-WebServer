<?php
header('Content-Type: application/json');


include 'dbOps.php';
$ops = new Ops();
$search = $ops->create_search("data_id,water_temeprature,time", "Data", " ORDER BY data_id");
$result = $ops->search_db($search);

$ops->echo_table("Data");

/*
$sqlQuery = "SELECT log_id,water_temeprature,time FROM Data ORDER BY log_id";
$result = mysqli_query($conn,$sqlQuery);



$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);
*/
echo json_encode($result);
?>
