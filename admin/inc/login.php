<?php 

$error =""; $umsg1=""; $umsg2="";  $pmsg1=""; $pmsg2="";


  if(isset($_POST['login'])){
       $username = mysqli_real_escape_string($dbcon,$_POST['username']);
       $password = mysqli_real_escape_string($dbcon,$_POST['password']);

       $user_sql  = "SELECT username FROM users WHERE username='$username'";
	   $check_user = mysqli_query($dbcon,$user_sql);
	
       if (empty($username)) {
         $error ="<div class='alert alert-danger' style='color:red;'>All the fields are required !!</div>";
    	 $umsg1 ="<span style='color:red; float:right'>Please Enter Your Username !!!</span>";
       }else if(!mysqli_num_rows($check_user)){
         $error ="<div class='alert alert-danger' style='color:red;'>The username does not exists !!</div>";
         $umsg2 ="<span class='float-right' style='color:red;'>The username does not exists !!</span>";
       }else if (empty($password)) {
    	 $pmsg1 ="<span style='color:red; float:right'>Please enter your password !!!</span>";
       }else{
         $query ="SELECT * FROM users WHERE username='$username' || password='$password' ";
          $run = mysqli_query($dbcon,$query);
          $row = mysqli_fetch_array($run);
          $id = $row['id'];
          $db_fname = $row['first_name'];
          $db_lname = $row['last_name'];
          $db_fullname = $db_fname." ".$db_lname;
          $db_username = $row['username'];
          $db_role = $row['role'];
          $db_pass = $row['password'];
          $dehashed_pass = password_verify($password, $db_pass);
          if($username == $db_username && $dehashed_pass == $db_pass){
          header("Location:profile.php");
          $_SESSION['id'] = $id;
          $_SESSION['name'] = $db_fullname;
          $_SESSION['username'] = $db_username;
          $_SESSION['email']    = $db_email;
          $_SESSION['role'] = $db_role;
          $_SESSION['author_image'] = $db_author_image;
        //$_COOKIE['username'] = $db_username;
          /*if($checkbox =='on'){
          setcookie('username',$db_username,time()+50);
          }*/
      }else{
        $error ="<div class='alert alert-danger' style='color:red;'><span>The Password does not match !!!</span></div>";
        $pmsg2 = "<span style='color:red; float:right'>The password does not match !!!</span>";
      }  
    }





































    
	

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
		$hashed_pass = password_hash($cpass, PASSWORD_DEFAULT);
		$update_sql="UPDATE users SET password='$hashed_pass' WHERE email='$email' AND dob='$dob'";
		$update_run = mysqli_query($dbcon,$update_sql);
		$msg = "<div class='alert alert-' style='color:green;'>User has been <b>Updated</b>!!Please click on <a href='login.php'>Login Again</a></div>";
		$email=""; $dob=""; $pass=""; $cpass="";
	}
}
