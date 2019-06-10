<?php

  define('db_host', 'localhost');
  define('db_user', 'root');
  define('db_pass', '');
  define('db_name', 'SafeTrade');
	   
  $host = db_host;
  $user = db_user;
  $pass = db_pass;
  $dbname = db_name;
  $conn;
  $error;
 
 function connect(){
	$this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
	if(!$this->conn){
		$this->error = "Fatal Error: Can't connect to database".$this->conn->connect_error;
		return false;
	}
}
?>
