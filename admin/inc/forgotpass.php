<?php 

$error=""; $msg=""; $emsg1=""; $emsg2=""; $emsg3="";  $dmsg1=""; $dmsg2=""; $pmsg1=""; $pmsg2=""; $cpmsg=""; $cpmsg1=""; $email=""; $dob=""; $pass=""; $cpass="";

if(isset($_POST['forgot'])){

	$email = mysqli_real_escape_string($dbcon, $_POST['email']);
	$dob   = mysqli_real_escape_string($dbcon, $_POST['dob']);
	$pass  = mysqli_real_escape_string($dbcon, $_POST['pass']);
	$cpass = mysqli_real_escape_string($dbcon, $_POST['cpass']);

	$email_qry  = "SELECT email FROM users WHERE email='$email'";
	$check_email = mysqli_query($dbcon,$email_qry);
	
	$dob_qry   = "SELECT dob FROM users WHERE dob='$dob'";
	$check_dob = mysqli_query($dbcon,$dob_qry);
	

	if (empty($email)) {
		$emsg1 = "<span class='float-right' style='color:red;'>Please enter your E-mail address ! Required !!</span>";
	}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$error ="<div class='alert alert-danger' style='color:red;'>The E-mail address is invalid !!</div>";
        $emsg2 = "<span class='float-right' style='color:red;'>Please enter valid e-mail address !!</span>";
	}elseif (!mysqli_num_rows($check_email) > 0) {
		$error="<div class='alert alert-danger' style='color:red;'>The E-mail address does not match !!</div>";
        $emsg3 = "<span class='float-right' style='color:red;'>The E-mail address does not exists !!</span>";
	}else if (empty($dob)) {
		$dmsg1 = "<span class='float-right' style='color:red;'>Please enter your date of birth ! Required !!</span>";
	}else if (!mysqli_num_rows($check_dob) > 0) {
		$error="<div class='alert alert-danger' style='color:red;'>The  date of birth does not match !!</div>";
        $dmsg2 = "<span class='float-right' style='color:red;'>The date of birth  does not exists !!</span>";
	}elseif (empty($pass)) {
		$pmsg1 = "<span class='float-right' style='color:red;'>Please enter your new password !!</span>";
	}elseif (strlen($pass) < 6) {
		$error = "<div class='alert alert-danger' style='color:red;'>Password can not be less then 6 characters</div>";
		$pmsg2 = "<span class='float-right' style='color:red;'>The password must contain atleast 6 characters !!</span>";
	}elseif (empty($cpass)) {
		$cpmsg = "<span class='float-right' style='color:red;'>Please re-enter your confirm password !!</span>";
	}elseif ($pass != $cpass) {
		$error ="<div class='alert alert-danger' style='color:red;'>The confirm password does not match with new password !!</div>";
        $cpmsg1 = "<span class='float-right' style='color:red;'>The re-enter your confirm password !!</span>";
	}else{
		$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
		$update_sql="UPDATE users SET password='$hashed_pass' WHERE email='$email' AND dob='$dob'";
		$update_run = mysqli_query($dbcon,$update_sql);
		$msg = "<div class='alert alert-' style='color:green;'>User has been <b>Updated</b>!!Please click on <a href='login.php'>Login Again</a></div>";
		$email=""; $dob=""; $pass=""; $cpass="";
	}
}
