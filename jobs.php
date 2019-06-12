<?php include('connection.php');

		$sqljob = "SELECT * FROM jobs";
		$jobs = mysqli_query($db, $sqljob);

		//case check function

	function chekestimate($jddd){
		$db = attach();
		$myqry = "SELECT * FROM estimate where trader_id='".$_SESSION['idofc']."' and job_id='$jddd'";
		$myqryex = mysqli_query($db, $myqry);
		return mysqli_num_rows($myqryex);
	}
	//end


		?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>All Posted Jobs</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>

<div class="topnav col-sm-12">

<div class="col-sm-3" >


<?php  if (isset($_SESSION['username'])) {	?>
<a class="takeright" href="index.php">Dashboard</a>
<a class="takeright" href="jobs.php">Home</a>
 <?php } else { ?>
<a href="login.php">Login</a>
<a href="register.php">Signup</a>
 <a href="home.php">Home</a>
 <?php } ?>
 </div>
</div>


        <div class="content">
		<div class="col-sm-12">
			</div>

			<div class="col-sm-12">
	<h3 class="heading">
	Available Jobs
	</h3>
	</div>
	  <?php 		if (mysqli_num_rows($jobs) > 0) {
	  while($row = mysqli_fetch_assoc($jobs)){    ?>
                 <div class="col-sm-12 joblist">

											<div class="col-sm-12">
                                            <p>
                                                <label class="biglabel">Cost($):&nbsp;</label><?php echo $row['cost']; ?>
                                            </p>
											</div>
											<div class="col-sm-12">
                                            <p>
                                                <label class="biglabel">Location:&nbsp;</label> <?php echo $row['location']; ?>
                                            </p>
											</div>
                                            <div class="col-sm-12">
											<p>
                                                <label class="biglabel">Activation Date:</label><?php echo $row['start_date']; ?>
                                            </p>
											</div>
											<div class="col-sm-12">
                                            <p>
                                                <label class="biglabel">Expire Date:</label><?php echo $row['end_date']; ?>
                                            </p>
											</div>

											<div class="col-sm-12">
											<p>
                                                <label class="biglabel">Job Description:&nbsp;</label><?php echo $row['description']; ?>
                                            </p>
                                          </div>

										  <?php
										   if (isset($_SESSION['username'])) {
										  if($_SESSION['u_type'] == 'trademe') {

											  if(chekestimate($row['id']) == 1){
												  $disclass="disabled";
											  }else{
												  $disclass="";
											  }

											  ?>

										  <div class="col-sm-12 m10">
										 <a href="giveestimate.php?jid=<?php echo $row['id']; ?>&cid=<?php echo $row['customer_id']; ?>&tradeid=<?php echo $_SESSION['idofc']; ?>"> <button type="button" <?php echo $disclass; ?>  class="btn btn-success">Give Estimate</button> </a>
										  </div>
	  <?php } } ?>

                                        </div>
                                        <?php 	}		}else {	?>

                                               <div class="col-sm-12"> <p>No job found</p> </div>

                                            <?php	}?>






        </div>

    </body>

    </html>
