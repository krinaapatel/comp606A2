<?php
include('header.php');
session_start();

?>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="login.php">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            </div>


                                <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php

include("connection.php");

if(isset($_POST['login']))
{
    $user_email=$_POST['email'];
    $user_pass=$_POST['pass'];

    $check_user="select * from member WHERE user_email='$user_email'AND user_pass='$user_pass'";

    $run=mysqli_query($dbcon,$check_user);


    if(mysqli_num_rows($run))
    {
		$data_member = mysqli_fetch_assoc($run);
		$_SESSION['member_id'] = $data_member['id'];
		$_SESSION['member_username'] = $data_member['user_name'];
		$_SESSION['member_type'] = $data_member['member_type'];
        $_SESSION['email']=$user_email;

echo "<script>window.open('welcome.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Email or password is incorrect!')</script>";
    }
}
include('footer.php');
?>
