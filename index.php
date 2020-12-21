<?php
$mysqli = new mysqli("localhost","admin","371268","3CB105");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>
