<?php
function establish_connection() {
  $ip = '192.168.0.185:3306';
  $usr = 'admin_remote';
  $pass = 'admin';
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
//CREATE USER 'remote'@'%' IDENTIFIED VIA mysql_native_password USING '***';GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'remote'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
 ?>
