<?php
include 'config.php';

class Ops {

  private $connection;

  function __construct() {
    session_start();
    $this->connection = establish_connection();
  }
  function get_conn() {
    return $this->connection;
  }

  function echo_table($data) {
    $headers = False;
    echo "<br>";
    echo "<table style='border: 1px solid black;'>";
    echo "<tr>";
    foreach (mysqli_fetch_assoc($data) as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
        echo "<th>" . $field . "</th>"; // I just did not use "htmlspecialchars()" function.
    }
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($data)) { // Important line !!! Check summary get row on array ..
        echo "<tr>";
        foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
            echo "<td>" . $value . "</td>"; // I just did not use "htmlspecialchars()" function.
        }
        echo "</tr>";
    }
    echo "</table>";
  }

  function create_search($spec, $table, $cond) {
    return array("specifier" => $spec, "table" => $table, "cond" => $cond);
  }

  function search_db($search_params) {
    $conn = $this->get_conn();
    $sql = "SELECT " . $search_params["specifier"] ." FROM " . $search_params["table"] . $search_params["cond"];
    $result = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function
    return $result;
  }

  function is_index_page() {
    $currentpage = $_SERVER['REQUEST_URI'];
    if($currentpage=="/" || $currentpage=="/index.php" || $currentpage=="/index" || $currentpage=="" ) { return True; }
  }

  function check_login() {
    if ((!$this->is_index_page()) && (!isset($_SESSION['logged_in']))) {
        $this->direct_to_page("index.php");
    }
  }

  function format_str($str) {
    return mysqli_real_escape_string($this->connection,$str);
  }

  function does_usr_exist($search) {
    $result = $this->search_db($search);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count == 1) { return True; } else { return False; }
  }

  function direct_to_page($url) {
    header("location: " . $url . "");
  }

  function login() {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $given_username = $this->format_str($_POST['username']);
      $given_password = $this->format_str($_POST['password']);
      $search = $this->create_search("*", "Users", " WHERE user_name='" . $given_username . "' and password='" . $given_password . "'");

      if($this->does_usr_exist($search)) {
        $result = $this->search_db($search);
        $_SESSION['logged_in'] = True;
        $_SESSION['user_data'] = mysqli_fetch_assoc($result);

        $this->direct_to_page("home.php");
      } else {
        $this->direct_to_page("index.php");
      }
    }
  }
}
?>
