<?php
//database connecttion here
session_start();

include("conn.php");



// Check if the form has been submitted(login post)
if(isset($_POST["loginBtn"])) {


  // Get the username and password from the form data
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Connect to the database
//   $conn = mysqli_connect("localhost", "username", "password", "database");

  // Check if the username and password match a user in the database
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)>0) {
    $row = mysqli_fetch_assoc($result);
    if ($row["username"]===$username && $row["password"]===$password && $row["user_type"]==="admin"){
      $_SESSION["username"] = $username;
      header("Location: dashboard_admin.php");
      exit();}
    else{
         // If the credentials are correct, log the user in and redirect to a dashboard page
      $_SESSION["username"] = $username;
      header("Location: index.php");
      exit();
      }
  } 
  else {
    header("Location: login_page1.php?error=User id or passwword is invalid");
    exit();    
    echo "Invalid username or password.";
  }
}

?>