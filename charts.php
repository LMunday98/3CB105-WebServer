<?php
include 'dbOps.php';
$ops = new Ops();
$ops->login();
$usr = $_SESSION['user_data'];
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
        <section id="main">
          <header>
            <h1>Charts</h1>
          </header>
          <hr />
          <input type="button" value="Home" onclick="window.location='home.php';" />
          <br><br>
          <input type="button" value="Logout" onclick="window.location='logout.php';" />
          <hr />

					<input type="date" id="datepicker" name="datepicker" value="2018-07-22" min="2018-01-01" max="2018-12-31"><br><br>
					<input id="clickMe" type="button" value="Temperature" onclick="change_display('temperature_chart')" />
					<input id="clickMe" type="button" value="Water Level" onclick="change_display('waterlvl_chart');" />
					<input id="clickMe" type="button" value="RPI Readings" onclick="change_display('rpi_chart');" />

					<hr />

					<canvas id="temperature_chart" class="hideable" width="400px" height="400px"></canvas>
					<canvas id="waterlvl_chart" class="hideable" width="400px" height="400px"></canvas>
					<canvas id="rpi_chart" class="hideable" width="400px" height="400px"></canvas>

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
			$date = "2020-12-23";
			$ops->echo_graph_creation_function('temperature_chart', 'scatter', 'Temperature v Time', $ops->get_chart_data_array("water_temperature", "log_time", $date));
			//$ops->echo_graph_creation_function('waterlvl_chart', 'scatter', 'Water Level v Time', $ops->get_chart_data_array("water_level_max", "log_time", $date));
			//$ops->echo_graph_creation_function('rpi_chart', 'scatter', 'Raspberry Pi Readings (RPI) v Time', $ops->get_chart_data_array("rpi_temp", "log_time", $date));
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
