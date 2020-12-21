<?php
include 'config.php';

class Ops {

  private $connection;

  function __construct() {
    $this->connection = establish_connection();
    $this->check_login();
  }
  function get_conn() {
    return $this->connection;
  }

    function echo_table($table) {
      $result = $this->query_table($table);
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

    function query_table($table) {
      $conn = $this->get_conn();
      $sql = "SELECT * FROM " . $table;
      $result = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function
      return $result;
    }

    function check_login() {

      session_start();
      if($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = $this->connection;
        $myusername = mysqli_real_escape_string($db,$_POST['username']);
        $mypassword = mysqli_real_escape_string($db,$_POST['password']);

        $sql = "SELECT user_id FROM Users WHERE user_name = '$myusername' and password = '$mypassword'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if($count == 1) {
           $_SESSION['login_user'] = $myusername;

           header("location: test.php");
        }else {
          header("location: index.php");
           echo "fail";
        }
      }


    }
}
?>
