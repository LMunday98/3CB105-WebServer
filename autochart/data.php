<?php
header('Content-Type: application/json');

$conn = mysqli_connect("localhost","root","test","phpsamples");
$sqlQuery = "SELECT log_id,water_temeprature,time FROM Data ORDER BY data_id";
$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);
echo json_encode($data);
?>
