<?php 
	// start session
	session_start();

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	// add header file
	include('header.php');

	// check session start or not
	if(!$_SESSION){
		session_start();
	}

	// check email in session
	if(!$_SESSION['email']){
	    header("Location: login.php");
	}
?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<div class="col-sm-12">
	<div class="col-sm-3 leftbar">
		<h3 class="makhead">Welcome
			<?php
				echo " ".$_SESSION['email'];
			?>
		</h3>
		<?php if(isset($_SESSION['member_type']) && $_SESSION['member_type']=='member') {?>
					<a href="requierment.php">
						<button type="button" class="btn btn-block btn-default">Create a new job</button>
					</a>
		<?php } ?>
	<a href="home.php">
		<button style="margin-top: 16px;" type="button" class="btn btn-block btn-default">Explore All Jobs</button>
	</a>
</div>

<div class="col-sm-1">
</div>
<?php
    // add connection file
	include("connection.php");

	$data_check_requierments = array();

	function executequery($result){	
		while($rowsf = mysqli_fetch_assoc($result)){
			$results[] = $rowsf;
		}	
		return $results;
	}
	
	function executequery_single($result){	
		while($rowsf = mysqli_fetch_assoc($result)){
			$results = $rowsf;
		}	
		return $results;
	}
	
	$myid = $_SESSION['member_id'];
	
	$reqsdata_for_trade = array();
	
	if(isset($_SESSION['member_type']) && $_SESSION['member_type']=='trader') {
		$check_bids = "select * from bids where tdr_id = $myid";	
		$run_bids = mysqli_query($dbcon,$check_bids);
	
		if(mysqli_num_rows($run_bids)){
			$data_bids = executequery($run_bids);
			
			foreach($data_bids as $values){
				$req_id = $values['requierment_id'];	
				$check_reqs = "select * from requierments where requierment_id = $req_id";	
				$run_check_reqs = mysqli_query($dbcon,$check_reqs);
					if(mysqli_num_rows($run_check_reqs)) {
						$data_reqs = executequery_single($run_check_reqs);
					}
				$reqsdata_for_trade[] = array(
									'bid_id'=>$values['bid_id'],
									'requierment_data'=> $data_reqs,
									'member_id'=>$values['member_id'],
									'tdr_id'=>$values['tdr_id'],
									'bidt_amount'=>$values['bidt_amount'],
									'bidl_amount'=>$values['bidl_amount'],
									'bidm_amount'=>$values['bidm_amount'],
									'time_arrival'=>$values['time_arrival'],
									'createdon'=>$values['createdon']
									);
			}
		}
	}

	//receiver side
	
    $check_requierments = "select * from requierments where member_id = $myid";

    $run = mysqli_query($dbcon,$check_requierments);

    if(mysqli_num_rows($run)) {
		$data_check_requierments_pre = executequery($run);
		foreach($data_check_requierments_pre as $vals){
			
			//match case
			$data_our_quotes = array();
			$req_id_mak = $vals['requierment_id'];	
			
			$check_mak_bids = "select * from bids where requierment_id = $req_id_mak";	

			$run_check_mak_bids = mysqli_query($dbcon,$check_mak_bids);
		
			if(mysqli_num_rows($run_check_mak_bids)) {
				$data_our_quotes = executequery($run_check_mak_bids);
			}	
			//end
				
			$data_check_requierments[] = array(
					'requierment_id'=>$vals['requierment_id'],
					'member_id'=>$vals['member_id'],
					'budget'=>$vals['budget'],
					'place_job'=>$vals['place_job'],
					'date_s'=>$vals['date_s'],
					'date_e'=>$vals['date_e'],
					'details'=>$vals['details'],
					'allquotes' => $data_our_quotes
					);
		}
    }
	//end if condition
?>
<div class="col-sm-8 rightplace">
  <h3 id="main_head_home">My Jobs</h3>

	<?php if($data_check_requierments) { 
		foreach($data_check_requierments as $data) { ?>  
  			<div class="card col-sm-5" >
   			 	<a class="almostdone" data-toggle="modal" data-target="#myModal<?php echo $data['requierment_id']; ?>">View Quotes</a>
  				<div class="modal fade" id="myModal<?php echo $data['requierment_id']; ?>" role="dialog">
    				<div class="modal-dialog">
     				 	<!-- content-->
      					<div class="modal-content">
        					<div class="modal-header">
          						<h4 class="modal-title" style="text-align: center;">Quations By Traders</h4>
        					</div>
        					<div class="modal-body">
 								<div class="showquotes">         
		  						<?php
		  							if($data['allquotes']){
			  							foreach($data['allquotes'] as $quotetoprint){
								?>
									<div class="below">
										<p>Total Amount: <?php echo $quotetoprint['bidt_amount']; ?></p>
										<p>Labour Cost: <?php echo $quotetoprint['bidl_amount']; ?></p>
										<p>Material Cost: <?php echo $quotetoprint['bidm_amount']; ?></p>
										<a href="chat.php?sendby=<?php echo $myid; ?>&receiveby=<?php echo $quotetoprint['tdr_id'];?>&requierment_id=<?php echo $quotetoprint['requierment_id'];?>"><button style="margin-bottom: 12px;" type="button" class="btn btn-success">Let's Chat</button></a>
									</div>
									<?php
			                    	}
		  							}else{
			  							echo "No quotes!";
		  							}?>
		  						</div>
					       </div>
        				   <div class="modal-footer">
          						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        				   </div>
      				    </div>
    				</div>
  				</div>
    			<img class="card-img-top" src="images/deafultjob.jpg" alt="Card image" style="width:100%">
    			<div class="card-body">
			      <p class="card-title"><label>Location:&nbsp;</label><?php echo $data['place_job'];?></p>
				  <p class="card-title"><label>Job Budget:&nbsp;$</label><?php echo $data['budget'];?></p>
				  <p class="card-title"><label>Job Start Date:&nbsp;</label><?php echo $data['date_s'];?></p>
				  <p class="card-title"><label>Job End Date:&nbsp;</label><?php echo $data['date_e'];?></p>
			      <p class="card-text selfing"><?php echo $data['details']; ?></p>
			    </div>
			  </div>
			<?php } } ?>