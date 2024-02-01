<?php
// Replace these with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lavender";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the username and password from the form
  $input_username = $_POST["username"];
  $input_password = $_POST["password"];

  // Create a connection to the database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check if the connection was successful
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare a query to check if the given username and password match a record in the database

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $input_username, $input_password);
  $stmt->execute();
  $result = $stmt->get_result();

 $stmt2 = $conn->prepare("DELETE FROM users WHERE username = ?");
  $stmt2->bind_param("s", $input_username);
  $stmt2->execute();

  // Check if any rows were affected by the delete operation

  if ($stmt2->affected_rows == 1) {
    echo "<script>alert('Your account deleted');
     window.location.assign('login.html');</script>";

  } else {
    echo "<script>alert('wrong password or username');
    window.location.assign('deleteaccount.html');</script>";
  }

  // Close the database connection
  $stmt->close();
  $stmt2->close();
  $conn->close();
}
?>