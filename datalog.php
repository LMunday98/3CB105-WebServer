<?php
include 'assets/php/dbOps.php';

$ops = new Ops();
$ops->check_login();

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

	</head>
	<body class="is-loading">

    <div id="wrapper">

      <!-- Main -->
        <section id="main">
          <header>
            <h1>Data log</h1>
          </header>
          <hr />
          <input type="button" value="Home" onclick="window.location='home.php';" />
          <br><br>
          <?php $ops->echo_logout_button(); ?>
          <hr />

					<form action="" method="POST">
						<?php echo "<input type='date' id='datepicker' name='datepicker' value='" . $date . "' min='2020-12-23' max='" . date("Y-m-d") ."'>" ?>
						<br><br>
						<input id="submit" type="submit" value="submit" onclick="" />
					</form>

					<hr />

          <?php
          $ops->echo_table("Data");
           ?>

        </section>

      <!-- Footer -->
        <footer id="footer">
          <ul class="copyright">
            <li>3CB105</li><li>Fish Monitoring System</li><li>Luke Munday</li>
          </ul>
        </footer>

    </div>




			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>
