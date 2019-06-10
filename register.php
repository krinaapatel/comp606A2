<?php
	session_start();
	include_once("connection.php");
	
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$name=$_POST['name'];
	$password=$_POST['password'];
	$role=$_POST['role'];
	
	$sql = "INSERT into users (firstname, lastname, name, password, role) VALUES ('$firstname', '$lastname', '$name', '$password', '$role')";
	
	 if(mysqli_query($conn,$sql)) {
		 header("location:login.php?m=s");
	 } else {
		 header("location:signup.php?m=n");
	 }	
 
	 echo mysqli_error($conn);
?>