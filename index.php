<?php


include("dbOps.php");
$ops = new Ops();
$conn = $ops->get_conn();
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form

  $myusername = mysqli_real_escape_string($db,$_POST['username']);
  $mypassword = mysqli_real_escape_string($db,$_POST['password']);

  $sql = "SELECT user_id FROM Users WHERE user_name = '$myusername' and password = '$mypassword'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $active = $row['active'];

  $count = mysqli_num_rows($result);

  // If result matched $myusername and $mypassword, table row must be 1 row

  if($count == 1) {
     session_register("myusername");
     $_SESSION['login_user'] = $myusername;

     header("location: welcome.php");
  }else {
     $error = "Your Login Name or Password is invalid";
  }
}



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
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class="avatar"><img src="images/avatar.jpg" alt="" /></span>
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
								<li><input type="submit" name="submit" id="submit" placeholder="submit" /></li>
							</ul>
						</form>
						<hr />
						<footer>
							<ul class="icons">
								<li><a href="#" class="fa-twitter">Twitter</a></li>
								<li><a href="#" class="fa-instagram">Instagram</a></li>
								<li><a href="#" class="fa-facebook">Facebook</a></li>
							</ul>
						</footer>
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li>3CB105 - Fish Monitoring System</li><li>Luke Munday</li>
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
