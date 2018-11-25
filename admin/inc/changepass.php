<?php
if(isset($_GET['changeid'])){
    $change_id = $_GET['changeid'];
 }

$error=""; $pmsg1=""; $pmsg2=""; $cpmsg1=""; $cpmsg2="";

if (isset($_POST['changepass'])) {
	
	$password = mysqli_real_escape_string($dbcon,$_POST['pass']);
	$cpassword = mysqli_real_escape_string($dbcon,$_POST['cpass']);

	if (empty($password)) {
		$pmsg1 = "<span class='float-right' style='color:red;'>Please enter your new password !!</span>";
	}elseif (strlen($password) < 6) {
		$error = "<div class='alert alert-danger' style='color:red;'>Password can not be less then 6 characters</div>";
		$pmsg2 = "<span class='float-right' style='color:red;'>The password must contain atleast 6 characters !!</span>";
	}elseif (empty($cpassword)) {
		$cpmsg1 = "<span class='float-right' style='color:red;'>Please re-enter your confirm password !!</span>";
	}elseif ($password != $cpassword) {
		$error ="<div class='alert alert-danger' style='color:red;'>The confirm password does not match with new password !!</div>";
        $cpmsg2 = "<span class='float-right' style='color:red;'>The re-enter your confirm password !!</span>";
	}else{
		$hashed_pass = password_hash($password, PASSWORD_DEFAULT);
		$update_sql="UPDATE users SET password='$hashed_pass' WHERE id='$change_id'";
		$update_run = mysqli_query($dbcon,$update_sql);
		header("Location:profile.php?change");
		//$msg = "<div class='alert alert-' style='color:green;'>The password has been <b>Changed</b>!!Please click on <a href='logout.php'>Login Again</a></div>";
		$pass=""; $cpass="";
	}
}