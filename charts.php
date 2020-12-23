<?php
include 'dbOps.php';
$ops = new Ops();
$ops->check_login();
$usr = $_SESSION['user_data'];

$date = date("Y-m-d");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$date = $_POST['datepicker'];
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>FMS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<link rel="icon" href="images/icon.svg">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>





	</head>
	<body class="is-loading">

    <div id="wrapper">

      <!-- Main -->
        <section id="main"  style="width: 60%;">
          <header>
            <h1>Charts</h1>
          </header>
          <hr />

          <input type="button" value="Home" onclick="window.location='home.php';" />
          <br><br>
          <input type="button" value="Logout" onclick="window.location='logout.php';" />

          <hr />

					<form action="" method="POST">
						<?php echo "<input type='date' id='datepicker' name='datepicker' value='" . $date . "' min='2020-12-22' max='" . date("Y-m-d") ."'>" ?>
						<br><br>
						<input id="submit" type="submit" value="submit" onclick="" />
					</form>

					<hr />

					<input id="clickMe" type="button" value="Temperature" onclick="change_display('temperature_chart')" />
					<input id="clickMe" type="button" value="Water Level" onclick="change_display('waterlvl_chart');" />
					<input id="clickMe" type="button" value="RPI Usage" onclick="change_display('rpi_usage_chart');" />
					<input id="clickMe" type="button" value="RPI Temperature" onclick="change_display('rpi_temp_chart');" />

					<hr />

					<div>
						<canvas id="temperature_chart" class="hideable" width="400px" height="400px"></canvas>
						<canvas id="waterlvl_chart" class="hideable" width="400px" height="400px"></canvas>
						<canvas id="rpi_usage_chart" class="hideable" width="400px" height="400px"></canvas>
						<canvas id="rpi_temp_chart" class="hideable" width="400px" height="400px"></canvas>
					</div>

        </section>

      <!-- Footer -->
        <footer id="footer">
          <ul class="copyright">
            <li>3CB105</li><li>Fish Monitoring System</li><li>Luke Munday</li>
          </ul>
        </footer>

    </div>

		<script type="text/javascript" src="assets/js/chart_mapping.js"></script>

		<script>

			<?php
			$ops->echo_graph_creation_function('temperature_chart', 'scatter', 'Temperature v Time', 'Temperature (°C)', $ops->get_chart_data_array("water_temperature", "log_time", $date));
			$ops->echo_graph_creation_function('waterlvl_chart', 'scatter', 'Water Level v Time', 'Temperature (°C)', $ops->get_chart_data_array("water_level_max", "log_time", $date));
			$ops->echo_graph_creation_function('rpi_usage_chart', 'scatter', 'Raspberry Pi Usage (RPI) v Time', 'Usage (%)', $ops->get_chart_data_array("rpi_cpu", "log_time", $date));
			$ops->echo_graph_creation_function('rpi_temp_chart', 'scatter', 'Raspberry Pi Temperature (RPI) v Time', 'Temperature (°C)', $ops->get_chart_data_array("rpi_temp", "log_time", $date));
		  ?>

			hide_all();
			change_display('temperature_chart');

			if ('addEventListener' in window) {
				window.addEventListener('load', function() {
					document.body.className = document.body.className.replace(/\bis-loading\b/, '');
				});
				document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
			}
		</script>
	</body>
</html>
