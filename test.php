<?php
include 'dbOps.php';
$ops = new Ops();
$ops->check_login();
$ops->echo_table("Users");
$ops->echo_table("Data");
?>
