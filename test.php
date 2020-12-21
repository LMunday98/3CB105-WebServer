<?php
include 'dbOps.php';

$ops = new Ops();
$ops->check_login();

$search = $ops->create_search("*", "Users", "");
$result = $ops->search_db($search);
$ops->echo_table($result);

$search = $ops->create_search("*", "Data", "");
$result = $ops->search_db($search);
$ops->echo_table($result);
?>
