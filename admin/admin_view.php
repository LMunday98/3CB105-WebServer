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
					<input type="button" value="Back" onclick="window.location='admin_home.php';" />
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
						<?php

						if($_SERVER["REQUEST_METHOD"] == "POST") {
							$ops->edit_account($_POST);
						}

						 ?>
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
