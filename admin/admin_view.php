<?php
include '../assets/php/dbOps.php';
$ops = new Ops();
$ops->check_admin();
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
			<section id="main" style="width: 60%; max-width: 1024px;">
					<header>
						<h1>View user accounts</h1>
					</header>

					<hr />
					<input type="button" value="Home" onclick="window.location='admin_home.php';" />
					<br><br>
					<?php $ops->echo_admin_logout_button(); ?>
					<hr />

					<?php
					$table = "Users";
					$search = $ops->create_search("user_id,first_name,last_name,user_name", $table, "");

					// user table
					echo '<form method="post" action="" class="user_table">';
          	$ops->echo_table($table, $search);
					echo '</form>';

					// edit form
          ?>

					<div class="edit_section" style="display: none">
						<form method="post" action="">
						<?php

						if (isset($_POST["edit_submit"])) {
							$search = $ops->create_search("*", "Users", " WHERE user_name='" . $_POST['user_name'] . "'");
							if (!$ops->does_usr_exist($search)) {
								$ops->del_from_table("Users", "user_id", $_SESSION['edit_id']);
								$ops->create_account($_POST);
							} else {
									echo "<h2>User name is already taken! Please enter another.</h2>";
							}
						}


						if($_SERVER["REQUEST_METHOD"] == "POST") {
							$ops->edit_account($_POST);
						}

						 ?>

						<div class="field">
							<input type="password" name="password" id="password" placeholder="New Password" required/>
						</div>
						<div class="field">
							<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" oninput="check(this)" required/>
						</div>
						<ul class="actions">
							<li><input type="submit" name="edit_submit" id="submit" placeholder="submit" value=" Submit "/></li>
							<li><input type="button" value="Back" onclick="window.location='admin_view.php';" /></li>
						</ul>

					 </form>



					</div>

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
			<?php

			foreach($_POST as $id => $type) {
				if ($type == "Edit") {
					echo '<script type="text/javascript" src="../assets/js/admin_ops.js"></script>';
					echo "<script>edit_users(" . $id . ");</script>";
				}
				if ($type == "Delete") {
					$ops->del_from_table("Users", "user_id", $id);
				}
			}

			 ?>


	</body>

</html>
