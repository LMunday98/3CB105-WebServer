<?php
define('DB_SERVER', '192.168.0.185:3306');
   define('DB_USERNAME', 'remote');
   define('DB_PASSWORD', 'remote');
   define('DB_DATABASE', '3CB105');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT user_id FROM Users WHERE user_name = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         $_SESSION['login_user'] = $myusername;

         //header("location: welcome.php");
         echo "logged in";
      }else {
         echo "fail";
      }
   }
?>
<html>


<form action = "" method = "post">
   <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
   <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
   <input type = "submit" value = " Submit "/><br />
</form>

   </body>
