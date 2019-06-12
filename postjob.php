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
<a class="takeright" href="index.php">Dashboard</a>
<a class="takeright" href="jobs.php">Home</a>
 <?php } else { ?>
<a class="takeright" href="login.php">Login</a>
<a class="takeright" href="register.php">Register</a>
 <a class="takeright" href="jobs.php">Home</a>
 <?php } ?>
 </div>
</div>

	<div class="header w30">
		<h2>Post Job</h2>
	</div>

	<form method="post" class="w30" action="customerjob.php">

		<?php include('errors.php'); ?>
</br>
		<div class="input-group col-sm-12">
			<label>Location</label>
			<input required type="text" name="location" value="">
		</div>
		<div class="input-group col-sm-12">
			<label>Cost</label>
			<span class="input-group-text"  id="inputGroupPrepend3">$</span>
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
<textarea rows="4" cols="40" class="col-sm-12" name="comment" required>
</textarea>
</div>

		<div class="input-group col-sm-12">
			<button type="submit" class="btn col-sm-6 yebt" name="btn_cjob">Continue</button>
		</div>
	</form>
</body>
</html>
