<?php
	// add class file
	require "class.php";
	include("connection.php");
	$obj = new showresult;
		
	$requierment_id = $_GET['reqid'];
	$sendby = $_GET['senderby'];
	$receiveby = $_GET['receiverby'];
	$messagedata = $_POST['messagedata'];
	
	// inset message field into chat table
	$makquery = "INSERT INTO chat (requierment_id, sendby, receiveby, message, createdon) 
		  VALUES('$requierment_id', '$sendby', '$receiveby', '$messagedata', NOW())";			  
					  
	$allresult = mysqli_query($dbcon, $makquery);	
			
	if($allresult){
		$masg = $obj->sucess();	
	    echo json_encode($masg);
	}else{
		$masg = $obj->fail();	
	    echo json_encode($masg);
	}	
?>