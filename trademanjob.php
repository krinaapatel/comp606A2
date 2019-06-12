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

	<div class="header w30">
		<h2>Give Estimate</h2>
	</div>

	<form method="post" class="w30" action="trademanjob.php">

<input type="hidden" name="jid" value="<?php echo $_GET['jid']; ?>" />
<input type="hidden" name="cid" value="<?php echo $_GET['cid']; ?>" />
<input type="hidden" name="tradeid" value="<?php echo $_GET['tradeid']; ?>" />
</br>
		<div class="input-group col-sm-12">
			<label>Total Cost</label>
			<input required type="text" name="tcost" value="">
		</div>

		<div class="input-group col-sm-12">
			<label>Labor Cost</label>
			<input required type="text" name="lcost" value="">
		</div>


		<div class="input-group col-sm-12">
			<label>Material Cost</label>
			<input required type="text" name="mcost" value="">
		</div>


		<div class="input-group col-sm-12">
		    <label>Expiration Date</label>
		    <input required type="date" name="edate">
		</div>

		<div class="input-group col-sm-12">
			<button type="submit" class="btn col-sm-6 yebt" name="btn_estimate">Continue</button>
		</div>
	</form>

</body>
</html>
