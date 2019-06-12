<?php include('connection.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>SafeTrade company</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<!-- start top navigation menu code  -->
<div class="topnav">
	<div class="col-sm-3">
		<a href="jobs.php"><img class="myimg" src="https://a0.awsstatic.com/libra-css/images/logos/aws_logo_smile_1200x630.png"/></a>
	</div>
	<div class="col-sm-9">
		<?php  if (isset($_SESSION['username'])) {	?>
							<a class="takeright" href="index.php">Dashboard</a>
							<a class="takeright" href="jobs.php">Home</a>
	 <?php } else { ?>
		 					<a class="takeright" href="login.php">Login</a>
							<a class="takeright" href="register.php">Register</a>
	 						<a class="takeright" href="jobs.php">Home</a>
	 <?php } ?>
	</div>
</div>

<!-- start top navigation menu code  -->
<div class="header w30">
		<h2>Post Job</h2>
</div>

<form method="post" class="w30" action="customerjob.php">
		<!-- include show error file  -->
		<?php include('errors.php'); ?>
		</br>
		<div class="input-group col-sm-12">
			<label>Location</label>
			<input required type="text" name="location" value="">
		</div>
		<div class="input-group col-sm-12">
			<label>Cost</label>
			<input required type="text" name="cost" value="">
		</div>
		<div class="input-group col-sm-12">
		    <label>Job Activation Date</label>
		    <input required type="date" name="adate">
		</div>
		<div class="input-group col-sm-12">
		    <label>Job Complete Date</label>
		    <input required type="date" name="cdate">
		</div>

		<input type="hidden" name="customer_id" value="<?php echo $_SESSION['idofc']; ?>">

		<div class="input-group col-sm-12">
			<label>Job Description</label>
			<textarea rows="4" cols="40" class="col-sm-12" name="comment" required></textarea>
		</div>
		<div class="input-group col-sm-12">
			<button type="submit" class="btn col-sm-6 yebt" name="btn_cjob">Continue</button>
		</div>
	</form>
</body>
</html>
