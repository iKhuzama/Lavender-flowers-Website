<?php
	
$con = mysqli_connect("localhost", "root", "", "lavender");

if (isset($_POST['submit'])){

		$name= $_POST['name'];
		$email= $_POST['Email'];
		$password = $_POST['Password'];
		$date = $_POST['date'];


      $result = mysqli_query($con, "SELECT * FROM users WHERE username='$name'");
	
  
if (mysqli_num_rows($result) > 0) {

echo "<script>alert('Username is already taken try another one')
        window.location.assign('signin.html')</script>";

} else {
		$query = "INSERT INTO users (username, password, email, date) 
	  VALUES('$name', '$password', '$email', '$date')";


	  
	  mysqli_query($con, $query);
}

if (!$query) {
       echo "Connection faild" . mysqli_connect_error();

    } else {
        echo "<script>alert('Your sing succeedd! now log in.')
        window.location.assign('login.html')</script>";
    }

}

mysqli_close($con);
?>
