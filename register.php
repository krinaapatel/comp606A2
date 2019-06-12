<?php include('connection.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Job Search</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="topnav">

<div class="col-sm-3">

<?php  if (isset($_SESSION['username'])) {	?>
<a href="index.php">Dashboard</a>
<a href="jobs.php">Home</a>
 <?php } else { ?>
<a href="login.php">Login</a>
<a  href="register.php">Register</a>
 <a  href="jobs.php">Home</a>
 <?php } ?>
 </div>
</div>

	<div class="header w30">
		<h2 class="mlhead">Create Account</h2>
	</div>

	<form method="post" class="w30" style="height: auto;" action="register.php">

		<?php include('errors.php'); ?>
</br>
		<div class="input-group col-sm-12">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group col-sm-12">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group col-sm-12">
			<label>Register as</label>
			 <select name="usertype">
			 	<option value="select">Select User Type</option>
                  <option value="customer">Customer</option>
                  <option value="trademe">Trademen</option>
            </select>
		</div>
		<div class="input-group col-sm-12">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group col-sm-12">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group col-sm-12">
			<button type="submit" class="btn col-sm-6 yebt" name="reg_user">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
		</br>
	</form>
</body>

</html>
