<html>
<head lang="en">
    <meta charset="UTF-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
	<link type="text/css" rel="stylesheet" href="main.css">
    <title>Login</title>
</head>
<style>
.caret {
    display: none !important;
}


.login-panel {
    margin-top: 53px;
}

.mybody{
	padding: 0px !important;
}
</style>

<body class="mybody">
<div id="topheader" class="col-sm-12">

<div class="forsitelogo col-sm-3">
<a style="display: none;" href="home.php"><img class="imglogo" src="images/logo.png"/></a>
</div>

<div class="formenu col-sm-7">
<a href="home.php" class="mymenu">Home</a>
<?php if(!isset($_SESSION['email'])){ ?>
<a href="registration.php" class="mymenu">Create Account</a>
<a href="login.php" class="mymenu">Login</a>
<?php } ?>
</div>
<?php if(isset($_SESSION['email'])){ ?>
<div class="dropdown col-sm-2">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">My Account
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="welcome.php">Dashboard</a></li>
	  <?php if(isset($_SESSION['member_type']) && $_SESSION['member_type']=='member') {?>
      <li><a href="requierment.php">Create job</a></li>
	  <?php } ?>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
<?php } ?>
</div>