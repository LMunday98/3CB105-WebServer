<?php
function establish_connection() {
  $ip = '192.168.0.185:3306';
  $usr = 'remote';
  $pass = 'remote';
  $db = '3CB105';

  $conn = new mysqli($ip, $usr, $pass, $db);

  // Check connection
  if ($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  } else {
    return $conn;
  }
}
 ?>
