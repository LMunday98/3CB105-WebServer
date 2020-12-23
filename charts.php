<?php
include 'dbOps.php';
$ops = new Ops();
$ops->login();
$usr = $_SESSION['user_data'];

$data_array = $ops->get_chart_data_array("water_temperature", "time", "2020-12-22");
$graph_y = $data_array[1];
$graph_x = $data_array[0];
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

					<input id="clickMe" type="button" value="line" onclick="change_display('myChart1')" />
					<input id="clickMe" type="button" value="scatter" onclick="change_display('myChart2');" />

					<hr />

					<canvas id="myChart1" class="hideable" width="400px" height="400px"></canvas>
					<canvas id="myChart2" class="hideable" width="400px" height="400px"></canvas>

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


		create_chart_line('myChart1', 'Temperature v Time', <?php echo $graph_y ?>, <?php echo $graph_x ?>);
		create_chart_scatter('myChart2', 'Temperature v Time', <?php echo $graph_y ?>, <?php echo $graph_x ?>);
		hide_all();
		change_display('myChart1');

		function hide_all() {
			var divsToHide = document.getElementsByClassName("hideable"); //divsToHide is an array
	    for(var i = 0; i < divsToHide.length; i++){
	        divsToHide[i].style.display = "none"; // depending on what you're doing
	    }
		}

		function change_display(element_id) {
			hide_all();
		  var x = document.getElementById(element_id);
		  x.style.display = "block";
		}

			if ('addEventListener' in window) {
				window.addEventListener('load', function() {
					document.body.className = document.body.className.replace(/\bis-loading\b/, '');
				});
				document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
			}
		</script>
	</body>
</html>
