
<?php
	$conn = mysqli_connect("localhost","root","","safetrade");
	if (!$conn){
		die("connectin fail:".mysqli_connect_error());
	}
?>