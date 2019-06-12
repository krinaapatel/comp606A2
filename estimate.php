<?php
	// include connection file
	include('connection.php');
	if (!isset($_SESSION)){
		session_start();
	}

	// session is not set
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	$jobs = '';


	//case check function
	function getjobdata($jid){
		 $db = attach();

		 $sqljobo = "SELECT * FROM jobs WHERE id = '$jid'";
		 $d_jobs = mysqli_query($db, $sqljobo);

		if (mysqli_num_rows($d_jobs) > 0) {

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

		}
		return $secondfase;

	}
	//end

	//case2
	function getmsgdata(){
		$thirdfase = array();

    	$db = attach();

		$jid = $_GET['jid'];

		$sqljobo = "SELECT * FROM messages WHERE job_id = '$jid'";
		$d_jobs = mysqli_query($db, $sqljobo);
		if (mysqli_num_rows($d_jobs) > 0) {

			 while($rowsf = mysqli_fetch_assoc($d_jobs)){

				$thirdfase[] = array(
					'id'=> $rowsf['id'],
					'job_id'=> $rowsf['job_id'],
					'sender'=> $rowsf['sender'],
					'receiver'=> $rowsf['receiver'],
					'message'=> $rowsf['message'],
					'date_added'=> $rowsf['date_added']
				);
			 }

		}
		return $thirdfase;
	}
	//end

	//case customer
	if (isset($_SESSION['idofc']) && $_SESSION['u_type'] != 'trademe') {
		$cid = $_SESSION['idofc'];
		$sqljob = "SELECT * FROM jobs WHERE customer_id = '$cid'";
		$jobs = mysqli_query($db, $sqljob);
	}

	//case trademan

	$datatoprint = array();

	if (isset($_SESSION['idofc']) && isset($_GET['jid'])) {
	$cid = $_SESSION['idofc'];
	$jid = $_GET['jid'];
	$sqljob = "SELECT * FROM estimate WHERE job_id = '$jid'";


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

// when user logout
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
        <div class="myheader" style="display: none;">
			<h2 class="nomarg">Dashboard</h2>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
		</div>
        <div class="content">

                    <!-- logged in user information -->
                    <?php  if (isset($_SESSION['username'])) : ?>
				<!-----listing for trademan ---->
							<?php if($datatoprint){ ?>
								<?php if(count($datatoprint > 0)){ ?>
							  <div class="col-sm-12">
<div class="oymain col-sm-12">
<?php foreach($datatoprint as $pre) { ?>


<div class="col-sm-12">
<p class="mah" align="center">Quoted Price</p>
<?php if($_SESSION['u_type'] != 'trademe'){
	$receiver_ids = $pre['trader_id'];
}else{
	$receiver_ids = $pre['job_posted_by'];
}?>
<input type="hidden" id="receiver" value="<?php echo $receiver_ids; ?>"/>

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

								<?php } ?>

						<?php }  ?>


				<!---end----->

				<!----message body---->
				<?php if($datatoprint) {?>
				<div class="col-sm-12 msgbody" id="out">

				<?php foreach(getmsgdata() as $data) { ?>

				<?php if($_SESSION['idofc']==$data['sender']){ ?>
				<div class="rightmsg col-sm-9">
				<p><?php echo $data['message']; ?></p>
				</div>
				<?php } else { ?>
				<div class="leftmsg col-sm-9">
				<p><?php echo $data['message']; ?></p>
				</div>
				<?php } ?>

				<?php } ?>


				</div>

				<div class="col-sm-12 inpt">
				<div class="col-sm-10">
				<input type="text" class="form-control alsomy" name="sendmsg" value=""/>
				</div>
				<button type="button" class="sendbtn col-sm-2 btn btn-success">Send</button>
				</div>
				<!------end------>
			<?php } else { ?>
			<h3 class="col-sm-12 heading">No Estimate Found</h3>
			<?php }?>
		</div>


                        <?php endif ?>
        </div>
    </body>
<?php
$jid = $_GET['jid'];
$sender = $_SESSION['idofc'];
?>
<script type="text/javascript">
$('.sendbtn').on('click', function (e) {
    var thismsg = $(".alsomy").val();
	var receiver = $("#receiver").val();
	var jid = '<?php echo $jid; ?>';
	var sender = '<?php echo $sender; ?>';
	if(thismsg.trim().length!=0){
	    $('.msgbody').append('<div class="rightmsg col-sm-9"><p>'+thismsg+'</p></div>');
    $(".alsomy").val('');
	}
//save data/messages
 $.ajax({
            type: "POST",
            data: {message:thismsg},
            url: "messagedata.php?sender="+sender+"&receiver="+receiver+"&jid="+jid+"",
            success: function(data){
				alert(data);
             },
            });
});

$(".alsomy").keyup(function(event) {
    if (event.keyCode === 13) {
        $(".sendbtn").click();
    }
});
</script>
    </html>
