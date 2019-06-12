<?php
	include('connection.php');
	if (!isset($_SESSION)){
	session_start();
	}


	if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
	}
	$jobs = '';


	//case check function

	function getjobdata($jid){
		 $db = attach();

		 $sqljobo = "SELECT * FROM jobs WHERE id='$jid'";
		 $d_jobs = mysqli_query($db, $sqljobo);

		 while($rowsf = mysqli_fetch_assoc($d_jobs)){

			$secondfase[] = array(
				'id'=> $rowsf['id'],
				'customer_id'=> $rowsf['customer_id'],
				'location'=> $rowsf['location'],
				'cost'=> $rowsf['cost'],
				'start_date'=> $rowsf['start_date'],
				'end_date'=> $rowsf['end_date'],
				'description'=> $rowsf['description']
			);
		 }
		return $secondfase;

	}
	//end


	//case customer
	if (isset($_SESSION['idofc']) && $_SESSION['u_type'] != 'trademe') {
	$cid = $_SESSION['idofc'];
	$sqljob = "SELECT * FROM jobs WHERE customer_id='$cid'";
	$jobs = mysqli_query($db, $sqljob);
	}





	//case trademan

	$datatoprint = array();

	if (isset($_SESSION['idofc']) && $_SESSION['u_type'] == 'trademe') {
	$cid = $_SESSION['idofc'];
	$sqljob = "SELECT * FROM estimate WHERE trader_id='$cid'";
	$jobs = mysqli_query($db, $sqljob);

	if (mysqli_num_rows($jobs) > 0) {

	 while($row = mysqli_fetch_assoc($jobs)){

	 $datatoprint[] = array(
	 'id' => $row['id'],
	 'job_id' => $row['job_id'],
	 'job_posted_by' => $row['job_posted_by'],
	 'trader_id' => $row['trader_id'],
	 'cost_total' => $row['cost_total'],
	 'cost_labour' => $row['cost_labour'],
	 'cost_material' => $row['cost_material'],
	 'expiration_date' => $row['expiration_date'],
	 'jobdata' => getjobdata($row['job_id'])

	 );

	 }

	 }

	}

	if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");

	}?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>

<div class="topnav col-sm-12">

<div class="col-sm-6">

<?php  if (isset($_SESSION['username'])) {	?>
<a href="index.php">Dashboard</a>
<a href="home.php">Home</a>
<a href="postjob.php">Post New Job</a>


 <?php } else { ?>
<a  href="login.php">Login</a>
<a  href="register.php">Register</a>
 <a  href="jobs.php">Home</a>
 <?php } ?>
 </div>
</div>

        <div class="header" style="display: none;">


			<h2>Dashboard</h2>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			</div>
        <div class="content">
            <!-- notification message -->
            <!----<?php if (isset($_SESSION['success'])) : ?>
                <div class="error success">
                    <h3>
					<?php
					echo $_SESSION['success'];
					unset($_SESSION['success']);
					?>
					</h3>
				</div>
                <?php endif ?>--->
                    <!-- logged in user information -->
                    <?php  if (isset($_SESSION['username'])) : ?>

					<div class="col-sm-12 teeth">

                        <div class="col-sm-5 firsto">
						<?php if($_SESSION['u_type'] != 'trademe') {?>
						<a href="postjob.php"><button type="button" class="btn btn-success">Post New Job</button></a>
						<?php } ?>
						</div>
                        <div class="col-sm-7 ro">
						<p class="col-sm-6">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
						<p class="col-sm-6 takeright"> <a href="index.php?logout='1'" style="color: white; float: right; border: 1px solid #fff;background:#df5143; padding: 5px;border-radius:4px;">Logout</a> </p></div>

						</div>





		<div class="col-sm-12">
                            <h4 class="heading">My Jobs</h4>
		</div>
							<!-----listing for customer job ---->
							<?php if(empty($datatoprint)) {?>
							  <div class="col-sm-12 bjoblist">
								  <?php 		if (mysqli_num_rows($jobs) > 0) {
	  while($row = mysqli_fetch_assoc($jobs)){    ?>
                 <div class="col-sm-12 joblist">

											<div class="col-sm-3">
                                            <p>
                                                <label class="biglabel">Cost:&nbsp;</label><?php echo $row['cost']; ?>
                                            </p>
											</div>
											<div class="col-sm-3">
                                            <p>
                                                <label class="biglabel">Location:&nbsp;</label> <?php echo $row['location']; ?>
                                            </p>
											</div>
                                            <div class="col-sm-3">
											<p>
                                                <label class="biglabel">Job Activation Date:</label><?php echo $row['start_date']; ?>
                                            </p>
											</div>
											<div class="col-sm-3">
                                            <p>
                                                <label class="biglabel">Job Expire Date:</label><?php echo $row['end_date']; ?>
                                            </p>
											</div>

											<div class="col-sm-12">
											<p>
                                                <label class="biglabel">Job Description:&nbsp;</label><?php echo $row['description']; ?>
                                            </p>
                                          </div>

<div class="col-sm-12 m10">
	<a href="estimate.php?jid=<?php echo $row['id']; ?>"> <button type="button" class="btn btn-success">View Estimate</button> </a>
</div>

                                        </div>
                                        <?php 	}		}else {	?>

                                               <div class="col-sm-12"> <p>No job found</p> </div>

                                            <?php	}?>
							     </div>
						<?php } ?>
				<!---end----->


				<!-----listing for trademan ---->
							<?php if($datatoprint){ ?>
								<?php if(count($datatoprint > 0)){ ?>
							  <div class="col-sm-12 bjoblist">
<div class="oymain col-sm-12">
<?php foreach($datatoprint as $pre) { ?>


<div class="col-sm-12">
<p class="mah col-sm-6" align="center">Quoted Price</p>
<div class="col-sm-6">
<a href="estimate.php?jid=<?php echo $pre['job_id']; ?>"><button type="button" class="chatbtnh btn btn-success">Chat with client</button></a>
</div>
<p class="col-sm-6 nopad">
  <label class="biglabel">Total Cost:&nbsp;</label><?php echo $pre['cost_total']; ?>
</p>
<p class="col-sm-6 nopad">
  <label class="biglabel">Labour Cost:&nbsp;</label><?php echo $pre['cost_labour']; ?>
</p>
<p class="col-sm-6 nopad">
  <label class="biglabel">Material Cost:&nbsp;</label><?php echo $pre['cost_material']; ?>
</p>
<p class="col-sm-6 nopad">
  <label class="biglabel">Exp. Date:&nbsp;</label><?php echo $pre['expiration_date']; ?>
</p>
</div>



<?php foreach($pre['jobdata'] as $row){ ?>

                 <div class="col-sm-12 joblist">
                   <p class="mah" align="center">Job Details</p>
											<div class="col-sm-6 nopad">
                                            <p>
                                                <label class="biglabel">Cost($):&nbsp;</label><?php echo $row['cost']; ?>
                                            </p>
											</div>
											<div class="col-sm-6 nopad">
                                            <p>
                                                <label class="biglabel">Location:&nbsp;</label> <?php echo $row['location']; ?>
                                            </p>
											</div>
                                            <div class="col-sm-6 nopad">
											<p>
                                                <label class="biglabel">Activation Date:</label><?php echo $row['start_date']; ?>
                                            </p>
											</div>
											<div class="col-sm-6 nopad">
                                            <p>
                                                <label class="biglabel">Exp. Date:</label><?php echo $row['end_date']; ?>
                                            </p>
											</div>

											<div class="col-sm-12 nopad">
											<p>
                                                <label class="biglabel">Job Description:&nbsp;</label><?php echo $row['description']; ?>
                                            </p>
                                          </div>

                                        </div>

<?php } } ?>



							     </div>

								<?php } else { ?>
								 <div class="col-sm-12"> <p>No job found</p> </div>
								<?php }  ?>

						<?php }  ?>


				<!---end----->
		</div>


                        <?php endif ?>
        </div>
    </body>

    </html>
