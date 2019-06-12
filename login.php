<?php include('connection.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Job Search</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
.footer{
	position: fixed;
}
</style>
<body>
<div class="topnav">


<div class="col-sm-7">

<?php  if (isset($_SESSION['username'])) {	?>
<a class="" href="index.php">Dashboard</a>
<a class="takeright" href="jobs.php">Home</a>
 <?php } else { ?>
<a class="takeright" href="login.php">Login</a>
<a class="takeright" href="register.php">Signup</a>
 <a class="takeright" href="home.php">Home</a>
 <?php } ?>
 </div>

</div>
	<div class="header w30">
		<h2>Login</h2>
	</div>

	<form method="post" class="w30" style="height: auto;" action="login.php">

		<?php include('errors.php'); ?>
</br>
		<div class="input-group col-sm-12">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group col-sm-12">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group col-sm-12">
			<button type="submit" class="btn yebt col-sm-6" name="login_user">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
		</br>
	</form>


</body>
</html>
