<?php
include '../assets/php/dbOps.php';
$ops = new Ops();
$ops->check_admin();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['password'] == $_POST['confirm_password']) {
		$ops->create_account($_POST);
	}
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>FMS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="icon" href="../images/icon.svg">
	</head>
	<body class="is-loading">

    <div id="wrapper">

      <!-- Main -->
			<section id="main"   style="width: 60%; max-width: 800px;">
					<header>
						<h1>Create an account</h1>
					</header>
					<hr />
					<input type="button" value="Back" onclick="window.location='admin_home.php';" />
					<br><br>
					<?php $ops->echo_admin_logout_button(); ?>
					<hr />

					<form method="post" action="">
						<div class="field">
							<input type="text" name="first_name" id="first_name" placeholder="Forename" required/>
						</div>
							<div class="field">
								<input type="text" name="last_name" id="last_name" placeholder="Surname" required/>
							</div>
						<div class="field">
							<input type="text" name="username" id="user_name" placeholder="Username" required/>
						</div>
						<div class="field">
							<input type="password" name="password" id="password" placeholder="Password" required/>
						</div>
						<div class="field">
							<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" oninput="check(this)" required/>
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


		<script language='javascript' type='text/javascript'>
			function check(input) {
					if (input.value != document.getElementById('password').value) {
							input.setCustomValidity('Password Must be Matching.');
					} else {
							// input is valid -- reset the error message
							input.setCustomValidity('');
					}
			}
		</script>

			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>
