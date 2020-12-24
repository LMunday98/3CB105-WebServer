<?php
include 'assets/php/dbOps.php';
$ops = new Ops();
$ops->check_login();

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
	</head>
	<body class="is-loading">

    <div id="wrapper">

      <!-- Main -->
        <section id="main">
          <header>
            <h1>Home screen</h1>
            <?php echo "<h3>Welcome, " . $usr['first_name'] . " " . $usr['last_name'] . "!</h3>"; ?>
          </header>
          <hr />
          <input type="button" value="Charts" onclick="window.location='charts.php';" />
          <br><br>
          <input type="button" value="Data Log" onclick="window.location='datalog.php';" />
          <br><br>
          <?php $ops->echo_logout_button(); ?>
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
