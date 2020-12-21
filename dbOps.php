<?php
include 'config.php';

class Ops {

  private $connection;

  function __construct() {
    $this->connection = establish_connection();
  }
  function get_conn() {
    return $this->connection;
  }

    function echoTable($table) {
      $result = $this->queryTable($table);
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
      $conn = $this->get_conn();
      $sql = "SELECT * FROM " . $table;
      $result = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function
      return $result;
    }
}
?>
