<?php

$conn = mysqli_connect("localhost", "root", "", "lavender");

// Check if the form has been submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the username and new password from the form

  $username = $_POST["username"];
  $old_password = $_POST["oldpass"];
  $new_password = $_POST["newpass"];

 $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $old_password);
  $stmt->execute();
  $result = $stmt->get_result();

  // If a matching record was found, update the password
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $update_stmt->bind_param("ss", $new_password, $username);
    $update_stmt->execute();

   echo "<script>alert('Your password changed, now try to login');
  window.location.assign('login.html');</script>";
  } else {

   echo "<script>alert('Wrong username or password');
  window.location.assign('changepass.html');</script>";

  }

  // Close the database connection
  $stmt->close();
  $update_stmt->close();
  $conn->close();
}
?>