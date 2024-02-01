<?php 


$con = mysqli_connect("localhost", "root", "", "lavender");

if (isset($_POST['submit'])){

		$name= $_POST['name'];
		$rating= $_POST['rate'];
		$review = $_POST['review'];
				

		$query = "INSERT INTO review (username, rating, review) 
	  VALUES('$name', '$rating', '$review')";
	  
	  mysqli_query($con, $query);

if (!$query) {
        echo "Connection faild" . mysqli_connect_error();
    } else {
        echo "<script>alert('Your review has been added!.')
        window.location.assign('index.html')</script>";
    }

}

mysqli_close($con);
?>