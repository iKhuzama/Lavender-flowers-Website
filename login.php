<?php

$con = mysqli_connect("localhost", "root", "", "lavender");

$username_eror = $password_eror = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username_eror) && empty($password_eror)) {

        $sql = "SELECT * FROM users where username='$username'";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $svd_passowrd = $row['password'];

            if ($password === $svd_passowrd) {
                $_SESSION['username'] = $username;
                $_SESSION['loggedin'] = true;
                header('Location: index.html');

            } elseif ($password != $svd_passowrd) {
                $password_eror = "your password is wrong";
                echo "<script>alert('incorrect password');
                window.location.assign('login.html');</script>";
            }
        } else {
            $username_eror = "your username is wrong";

            echo "<script>alert('incorrect username');
            window.location.assign('login.html');</script>";
        }
    }

    $conn->close();
}


?>
