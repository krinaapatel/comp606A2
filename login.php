<?php
	session_start();
	include_once("connection.php");
	$conn = new mysqli("localhost","root","","safetrade");
	$msg = "";
	if(isset($_POST['login'])){
		$name = $_POST['name'];
		$password = $_POST['password'];
		$userType = $_POST['userType'];
		
		$sql = "select * from users where name=? and password=? and role=?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sss",$name, $password, $userType);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		
		session_regenerate_id();
		$_SESSION['name'] = $row['name'];
		$_SESSION['role'] = $row['role'];
		session_write_close();
		
		if($result->num_rows==1 && $_SESSION['role']=="customer"){
			header("location:customer.php");
		}
		else if($result->num_rows==1 && $_SESSION['role']=="tradesman"){
			header("location:tradesman.php");
		}
		else{
			$msg = "Username or password is incorrect!"; 
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="author" content="html">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1, shrink-to-fit=no"> 
		<title>
			Job Search	
		</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	</head>
	<body class = "bg-dark">
		<div class = "container">
			<div class="row-justify-content center">
				<div class="col-lg-5 bg-light mt-5 px-0">
					<h3 class="text-center text-light bg-danger p-3">Login Here</h3>
					
					<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="p-4">
						<div class="form-group">
							<input type="text" name="name" class="form-control form-control-lg" placeholder="username" required /></div>
						<div class="form-group">
							<input type="password" name="password" class="form-control form-control-lg" placeholder="password" required />
						</div>
						<div class="form-group lead">
							<label for="userType">Select Role:</label>
							<input type="radio" name="userType" value="customer" class="custom-radio" required > &nbsp;Customer | 
							<input type="radio" name="userType" value="tradesman" class="custom-radio" required > &nbsp;Tradesman |  
 						</div>
						<div class="form-group">
							<input type="submit" name="login" class="btn btn-danger btn-block" />
						</div>
						<div class="form-group">
							<a href="signup.php" class="btn btn-info btn-block">SignUp</a>
						</div>
						
						<h5class="text-danger text-center"><?= $msg; ?></h5>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>