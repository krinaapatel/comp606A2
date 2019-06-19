<?php
	// session start
	session_start();

	// add dabase connection and header file
	include("connection.php");
	include('header.php');
	// display error	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if(!$_SESSION){
		session_start();
	}

	if(!$_SESSION['email']){
	    header("Location: login.php");
	}

	// function for fetch messsage by id
	function executequery($result){	
		while($rowsf = mysqli_fetch_assoc($result)){
			$results[] = $rowsf;
		}	
		return $results;
	}
	$senderby = $_GET['sendby'];
	$receiverby = $_GET['receiveby'];
	$reqid = $_GET['requierment_id'];
	$data_messages = array();
	
	$check_chatmessage = "select * from chat where requierment_id = $reqid";
	$run_chat = mysqli_query($dbcon,$check_chatmessage);

	if(mysqli_num_rows($run_chat)){
		$data_messages = executequery($run_chat);
	}

?>

<div class="container col-sm-12">

	<div class="col-sm-6 windcat col-md-offset-3">
		<?php 
			if($data_messages){
				foreach($data_messages as $messagedata){ 
					if($messagedata['receiveby'] == $receiverby) { ?>	
						<p class="my col-sm-7"><?php echo $messagedata['message']; ?></p>
					<?php } else {?>
						<p class="yours col-sm-7"><?php echo $messagedata['message']; ?></p>	
				<?php } ?>
			<?php }
		} ?>
	</div>
	<input type="text" id="msgtype" class="msgtype col-sm-4 col-md-offset-3"/>
	<button type="button" onclick="submitmsg();" id="sendmasg" class="sendbtn btn btn-info col-sm-1">Send</button>
</div>

<!--When we clcick on submit button to send message -->
<script type="text/javascript">
	function submitmsg(){
		var msgtosend = $("#msgtype").val();
		$('.windcat').append('<p class="my col-sm-7">'+msgtosend+'</p>');
		$("#msgtype").val('');
		var senderby = '<?php echo $senderby; ?>';
		var receiverby = '<?php echo $receiverby; ?>';
		var reqid = '<?php echo $reqid; ?>';
		
		$.ajax({
	            type: "POST",
	            data: {messagedata:msgtosend},
	            url: "save.php?senderby="+senderby+"&receiverby="+receiverby+"&reqid="+reqid+"",
	            success: function(data){
					alert(data);
	             },
	            });	
	}
	$(".msgtype").keyup(function(event) {
    	if (event.keyCode === 13) {
        	$("#sendmasg").click();
    	}
	});
</script>

<?php
	include('footer.php');
?>