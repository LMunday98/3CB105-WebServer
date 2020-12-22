<?php
include 'dbOps.php';

$ops = new Ops();
$ops->check_login();

$usr = $_SESSION['user_data'];
echo "Hello, " . $usr['first_name'] . " " . $usr['last_name'] . "!<br>";

$search = $ops->create_search("*", "Users", "");
$result = $ops->search_db($search);
$ops->echo_table($result);

$search = $ops->create_search("*", "Data", "");
$result = $ops->search_db($search);
$ops->echo_table($result);
?>

<br>
<a href='home.php'>home</a>
<br>
<br>
<a href='logout.php'>logout</a>
