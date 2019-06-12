<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php

// count error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// save all error in log
error_reporting(E_ALL);

session_start();

  // variable declaration
  $username = "";
  $email    = "";
  $errors = array();
  $_SESSION['success'] = "";

  function attach(){
    // connect to database
    return mysqli_connect('localhost', 'root', '', 'safetrade');
  }

  // connect to database
  $db = mysqli_connect('localhost', 'root', '', 'safetrade');

  // REGISTER USER
  if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    $usertype = mysqli_real_escape_string($db, $_POST['usertype']);


    // form validation: ensure that the form is correctly filled
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }

    if ($password_1 != $password_2) {
      array_push($errors, "The two passwords do not match");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
      $password = md5($password_1);//encrypt the password before saving in the database
      $query = "INSERT INTO users (username, email, password, user_type)
            VALUES('$username', '$email', '$password', '$usertype')";
      mysqli_query($db, $query);

      $querynew = "SELECT * FROM users WHERE username='$username'";
      $results = mysqli_query($db, $querynew);
      $alldata = mysqli_fetch_array($results);

      $_SESSION['username'] = $username;
      $_SESSION['idofc'] = $alldata['id'];
      $_SESSION['u_type'] = $alldata['user_type'];
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    }
    else{
      header('location:login.php');
    }

  }
  // ...

  // LOGIN USER
  if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
      array_push($errors, "Username is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $results = mysqli_query($db, $query);
      $alldata = mysqli_fetch_array($results);

      if (mysqli_num_rows($results) == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['idofc'] = $alldata['id'];
        $_SESSION['u_type'] = $alldata['user_type'];
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
      }else {
        array_push($errors, "Wrong username/password combination");
      }
    }
  }

  //customer job create
  if(isset($_POST['btn_cjob'])){

    $customer_id = $_POST['customer_id'];
    $location = $_POST['location'];
    $cost = $_POST['cost'];
    $adate = $_POST['adate'];
    $cdate = $_POST['cdate'];
    $comment = $_POST['comment'];

      $query = "INSERT INTO jobs (customer_id, location, cost, start_date, end_date, description)
            VALUES('$customer_id', '$location', '$cost', '$adate', '$cdate', '$comment')";
      mysqli_query($db, $query);

      $_SESSION['success'] = "Your job is successfully posted";
      header('location: index.php');
  }

  //estimate create
  if(isset($_POST['btn_estimate'])){

    $job_posted_by = $_POST['cid'];
    $job_id = $_POST['jid'];
    $trader_id = $_POST['tradeid'];
    $cost_total = $_POST['tcost'];
    $cost_labour = $_POST['lcost'];
    $cost_material = $_POST['mcost'];
    $expiration_date = $_POST['edate'];

    $query = "INSERT INTO estimate (job_posted_by, job_id, trader_id, cost_total, cost_labour, cost_material, expiration_date)
            VALUES('$job_posted_by', '$job_id', '$trader_id', '$cost_total', '$cost_labour', '$cost_material', '$expiration_date')";
    mysqli_query($db, $query);

    $_SESSION['success'] = "Estimation successfully added";
    header('location: index.php');
  }

?>