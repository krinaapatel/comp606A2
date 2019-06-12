<?php
		    //include('server.php');	
				// connect to database
	$db = mysqli_connect('localhost', 'jobsearch', '', 'jobsearch');		
			$job_id = $_GET['jid'];
			$sender = $_GET['sender'];
			$receiver = $_GET['receiver'];
			$message = $_POST['message'];
			
			$query = "INSERT INTO messages (job_id, sender, receiver, message, date_added) 
					  VALUES('$job_id', '$sender', '$receiver', '$message', NOW())";
			$result = mysqli_query($db, $query);	
			
			if($result){
				$msg = 'sent';	
			    echo json_encode($msg);
			}else{
				$msg = 'failed! something wrong';	
			    echo json_encode($msg);
			    
			}
		
		
?>