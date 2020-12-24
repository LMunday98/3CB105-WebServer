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

  function echo_graph_creation_function($chart_id, $chart_type, $chart_name, $y_label, $data_array) {
    echo "create_chart_" . $chart_type ."('" . $chart_id . "', '" . $chart_name . "', '" . $y_label . "', " . $data_array[1] . ", " . $data_array[0] . ");";
  }

  function get_chart_data_array($x, $y, $date) {
    $search = $this->create_search($x . "," . $y, "Data", " WHERE log_date='" . $date . "'");
    $results = $this->search_db($search);

    return $this->chart_results_to_array($results, $x, $y);
  }

  function chart_results_to_array($results, $x, $y) {
    //echo $x . " " . $y . "<br>";
    $x_array = array();
    $y_array = array();
    while ($row = mysqli_fetch_assoc($results)) {
      array_push($x_array, $row[$x]);
      array_push($y_array, $row[$y]);
      //echo $row[$x] . " " . $row[$y] . "<br>";
    }
    return array(json_encode($x_array), json_encode($y_array));
  }

  function echo_table($table, $datasearch) {
    echo "<table style='border: 1px solid black; width: 100%;'>";

    $search = $this->create_header_search($table);
    $result = $this->search_db($search);
    $this->create_header($result);

    $result = $this->search_db($datasearch);
    $this->create_row($result);

    echo "</table>";
  }

  function create_header($data) {
    while ($row = mysqli_fetch_assoc($data)) {
        foreach ($row as $field => $value) {
            if ($value == "password") {
              break;
            }
            echo "<th>" . $this->format_header_names($value) . "</th>";
        }
    }
    if ($this->get_username() == "Admin") {
      echo "<th></th><th></th>";
    }
    echo "</tr>";
  }

  function create_row($data) {
    while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>";
        foreach ($row as $field => $value) {
            echo "<td>" . $value . "</td>";
        }
        if ($this->get_username() == "Admin") {
          echo "<td>";
          $this->echo_button("Edit:" . $value, "", "Submit", "Edit", "");
          echo "</td>";

          echo "<td>";
          $this->echo_button("Delete:" . $value, "", "Submit", "Delete", "");
          echo "</td>";
        }
        echo "</tr>";
    }
  }

  function create_header_search($table) {
    $search = $this->create_search("`COLUMN_NAME` ", "`INFORMATION_SCHEMA`.`COLUMNS` ", " WHERE `TABLE_NAME`='" . $table ."'");
    return $search;
  }

  function format_header_names($field_name) {
    return str_replace("_"," ",$field_name);
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

  function get_username() {
    $usr = $_SESSION['user_data'];
    return $usr['user_name'];
  }

  function check_admin() {
    if ($this->get_username() == "Admin") {
      $this->check_login();
    } else {
      $this->direct_to_page("../index.php");
    }
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

  function echo_admin_logout_button() {
    $path = "window.location=`../assets/php/logout.php`";
    $this->echo_button("", "", "button", "Logout", $path);
  }

  function echo_logout_button() {
    $path = "window.location=`assets/php/logout.php`";
    $this->echo_button("", "", "button", "Logout", $path);
  }

  function echo_button($id, $name, $type, $value, $path) {
    echo "<input type='" . $type . "' value='" . $value . "' onclick='".$path."' id='" . $id . "' name='" . $name . "' />";
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

        if ($given_username == "Admin") {
          $this->direct_to_page("admin/admin_home.php");
        } else {
          $this->direct_to_page("home.php");
        }
      } else {
        $this->direct_to_page("index.php");
      }
    }
  }
}
?>
