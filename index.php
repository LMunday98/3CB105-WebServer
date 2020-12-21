<?php
include 'config.php';

function echoTable($table) {
  $result = queryTable($table);
  echo "<br>";
  echo "<table border='1'>";
  while ($row = mysqli_fetch_assoc($result)) { // Important line !!! Check summary get row on array ..
      echo "<tr>";
      foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
          echo "<td>" . $value . "</td>"; // I just did not use "htmlspecialchars()" function.
      }
      echo "</tr>";
  }
  echo "</table>";
}

function queryTable($table) {
  $conn = getConnection();
  $sql = "SELECT * FROM " . $table;
  $result = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function
  return $result;
}

echoTable("Users");
?>
