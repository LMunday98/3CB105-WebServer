<?php
include 'dbOps.php';
$ops = new Ops();
$ops->login();
$usr = $_SESSION['user_data'];

$temperature_data_array = $ops->get_chart_data_array("water_temperature", "log_time", "2020-12-23");
$temperature_graph_y = $temperature_data_array[1];
$temperature_graph_x = $temperature_data_array[0];

$waterlvl_data_array = $ops->get_chart_data_array("water_level_max", "log_time", "2020-12-23");
$waterlvl_graph_y = $waterlvl_data_array[1];
$waterlvl_graph_x = $waterlvl_data_array[0];
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

					<hr />

					<canvas id="temperature_chart" class="hideable" width="400px" height="400px"></canvas>
					<canvas id="waterlvl_chart" class="hideable" width="400px" height="400px"></canvas>

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


			create_chart_scatter('temperature_chart', 'Temperature v Time', <?php echo $temperature_graph_y ?>, <?php echo $temperature_graph_x ?>);
			create_chart_scatter('waterlvl_chart', 'Water Level v Time', <?php echo $waterlvl_graph_y ?>, <?php echo $waterlvl_graph_x ?>);
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
