<?php
session_start();
include('header.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<div class="container col-sm-12">
  <h2 id="head_home">Find Latest Jobs</h2>
  
  <?php

	include("conection.php");

	$data_check_requierments = array();

	class main {
		
			public function executequery($result){	
			while($rowsf = mysqli_fetch_assoc($result)){
				$results[] = $rowsf;
			}	
			return $results;
		}
		
	}

	$myobject = new main;


    $check_requierments="select * from requierments";

    $run=mysqli_query($dbcon,$check_requierments);

    if(mysqli_num_rows($run))
    {
		$data_check_requierments = $myobject->executequery($run);
    }
	
?>
  
<?php if($data_check_requierments) { foreach($data_check_requierments as $data) {?>  
  <div class="card col-sm-3" >
    <img class="card-img-top" src="images/deafultjob.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <p class="card-title"><label>Location:&nbsp;</label><?php echo $data['place_job'];?></p>
	  <p class="card-title"><label>Job Budget:&nbsp;$</label><?php echo $data['budget'];?></p>
	  <p class="card-title"><label>Job Start Date:&nbsp;</label><?php echo $data['date_s'];?></p>
	  <p class="card-title"><label>Job End Date:&nbsp;</label><?php echo $data['date_e'];?></p>
      <p class="card-text selfing"><?php echo $data['details']; ?></p>
	  <?php if(isset($_SESSION['member_type']) && $_SESSION['member_type']=='trader') { 
	  $ntrdid = $data['requierment_id'];
	  $smid = $_SESSION['member_id'];
	$check_trade_record="select * from bids where requierment_id =$ntrdid and tdr_id =$smid";
    $run_trd_record=mysqli_query($dbcon,$check_trade_record);

    if(!mysqli_num_rows($run_trd_record))
    {
?>
<a class="btn btn-primary yobhi" onclick="changehidden(<?php echo $data['requierment_id']; ?>,<?php echo $data['member_id']; ?>);" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#myModal">Bid This Job</a>
	  
		
  <?php   }  }?>
   </div>
  </div>
<?php } } else {?>
<h3 style="text-align: center;">No Requierments Found!</h3>
<?php }?>
</div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="text-align: center;" class="modal-title">Bid This Job</h4>
        </div>
        <div class="modal-body">
 
   <div class="panel-body">
                    <form role="form" method="post" action="home.php">
                        <fieldset>
						
						    <div class="form-group col-sm-4">
                                <input class="form-control" required placeholder="Total Amount" name="bid_totalcost" type="text" autofocus>
                            </div>
						
                            <div class="form-group col-sm-4">
                                <input class="form-control" required placeholder="Labour Amount" name="bid_labouramount" type="text" autofocus>
                            </div>
							
							 <div class="form-group col-sm-4">
                                <input class="form-control" required placeholder="Material Amount" name="bid_materialamount" type="text" autofocus>
                            </div>
	  <input type="hidden" name="hrequierment_id" id="hrequierment_id" value=""/>
	  <input type="hidden" name="hmember_id" id="hmember_id" value=""/>
	  
	  <?php if(isset($_SESSION['member_id'])){ ?>
		   <input type="hidden" name="tdr_id" value="<?php echo $_SESSION['member_id']; ?>"/>
		  
	  <?php } ?>
	  
							<div class="form-group col-sm-6">
                                Expected Time Arrival <input class="form-control" type="date" name="timearrival" required/>
                            </div>
<div class="form-group col-sm-6 esbtn">
                            <input class="btn btn-success btn-block" type="submit" value="Continue" name="addquote" >
 </div>
                        </fieldset>
                    </form>

                </div>
 
 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<script>
function changehidden(hrequierment_id,hmember_id){
	hrequierment_id = $("#hrequierment_id").val(hrequierment_id);
	var hmember_id = $("#hmember_id").val(hmember_id); 
}
</script>

<?php 

include("conection.php");
if(isset($_POST['addquote']))
{
	
    $bidt_amount=$_POST['bid_totalcost'];
    $bidl_amount=$_POST['bid_labouramount'];
    $bidm_amount=$_POST['bid_materialamount'];
	$requierment_id=$_POST['hrequierment_id'];
	$member_id=$_POST['hmember_id'];
    $tdr_id=$_POST['tdr_id'];
	$time_arrival=$_POST['timearrival'];
	
    $add_bid="insert into bids 
	(bidt_amount,bidl_amount,bidm_amount,requierment_id,member_id,tdr_id,time_arrival,createdon) 
	VALUE
	('$bidt_amount','$bidl_amount','$bidm_amount','$requierment_id','$member_id','$tdr_id','$time_arrival',NOW())";
	
    if(mysqli_query($dbcon,$add_bid))
    {
		echo "<script>alert('Bid Placed Successfully!')</script>";
        echo"<script>window.open('welcome.php','_self')</script>";
    }

}

include('footer.php'); 

?>
