<?php

include 'dbOps.php';

$ops = new Ops();
$ops->check_login();

?>

<a href='logout.php'>logout</a>
