<?php
    // include header.php file
    include('header.php');

    // start session
    session_start();

    // set error counter
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    
    error_reporting(E_ALL);

?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Create a Job</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="requierment.php">
                        <fieldset>
						    <div class="form-group">
                                <input required class="form-control" placeholder="$&nbsp;Enter Cost" name="job_budget" type="text" autofocus>
                            </div>
						
                            <div class="form-group">
                                <input required class="form-control" placeholder="Job Location" name="job_location" type="text" autofocus>
                            </div>
                                <input type="hidden" name="member_id" value="<?php echo $_SESSION['member_id']; ?>"/>
							<div class="form-group">
                                Start Date <input required class="form-control" type="date" name="date_jobstart" autofocus>
                            </div>

                            <div class="form-group">
                                End Date <input required class="form-control" type="date" name="date_jobend" autofocus>
                            </div>
                            <div class="input-group col-sm-12">
	                       		<label>Describe Job Requierments</label>
                                <textarea rows="4" cols="45" class="form-group" name="details" required>
                                </textarea>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Continue" name="addrequierment" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php

// include database connection file
include("connection.php");

// insert requiement fied
if(isset($_POST['addrequierment'])){
    $member_id = $_POST['member_id'];
    $budget = $_POST['job_budget'];
    $place_job = $_POST['job_location'];
	$date_s = $_POST['date_jobstart'];
	$date_e = $_POST['date_jobend'];
    $details = $_POST['details'];

    $add_requierment = "insert into requierments 
	   (member_id,budget,place_job,date_s,date_e,details,create_date) 
	   VALUE
	   ('$member_id','$budget','$place_job','$date_s','$date_e','$details',NOW())";
	
    if(mysqli_query($dbcon,$add_requierment)) {
        echo"<script>window.open('welcome.php','_self')</script>";
    }
}
include('footer.php');
?>