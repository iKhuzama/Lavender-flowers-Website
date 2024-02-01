<?php
// Replace these with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lavender";

// Check if the form has been submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the username and new password from the form

  $username = $_POST["username"];
  $new_password = $_POST["new_password"];

  // Create a connection to the database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check if the connection was successful
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare a query to update the user's password

  $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
  $stmt->bind_param("ss", $new_password, $username);
  $stmt->execute();

  // Check if any rows were affected by the update operation

  if ($stmt->affected_rows == 1) {

  echo "<script>alert('Your password changed, now try to login');
  window.location.assign('login.html');</script>";

  } else {

   echo "<script>alert('Wrong username or password');
  window.location.assign('changepass.html');</script>"; 

  }

  // Close the database connection
  $stmt->close();
  $conn->close();
}
?>