<?php
include 'assets/php/dbOps.php';
$ops = new Ops();
$ops->login();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>FMS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<link rel="icon" href="images/icon.svg">
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class=""><img src="images/icon.svg" alt="" style="width: 122px;"/></span>
							<h1>Fish Monitoring<br>System</h1>
						</header>
						<hr />
						<h2>User Login:</h2>
						<form method="post" action="">
							<div class="field">
								<input type="text" name="username" id="username" placeholder="Username" />
							</div>
							<div class="field">
								<input type="password" name="password" id="password" placeholder="Password" />
							</div>
							<ul class="actions">
								<!--<li><a href="#" class="button">Login</a></li>-->
								<li><input type="submit" name="submit" id="submit" placeholder="submit" value=" Submit "/></li>
							</ul>
						</form>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>3CB105</li><li>Fish Monitoring System</li><li>Luke Munday</li>
						</ul>
					</footer>

			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>
