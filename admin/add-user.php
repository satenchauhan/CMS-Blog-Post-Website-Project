<!-- ===============TOP================== -->
<?php include('inc/top.php');
if(!isset($_SESSION['username'])){
  header("Location:login.php");
}else if(isset($_SESSION['username']) && $_SESSION['role'] == 'author'){
  header("Location:index.php");
}
$error=""; $msg=""; $fmsg1 =""; $lmsg1 =""; $fmsg2 =""; $lmsg2 =""; $umsg =""; $umsg1 =""; $umsg2 =""; $umsg3 =""; $umsg4=""; $emsg =""; 
$emsg1 ="";$emsg2 =""; $dmsg =""; $pmsg =""; $cmsg =""; $cmsg1 =""; $pmsg1 =""; $imsg ="";


?>

<body>
<div id="container">
<!-- ============HEADER NAVBAR CONTENTS============-->
  <?php include("inc/navbar.php"); ?>
        <div class="container-fluid body-section">
           <div class="row">
            <div class="col-md-3">
              <?php include("inc/sidebar.php"); ?>
            </div>
<!-- ==================PAGE CONTENTS================ -->
         <div class="col-md-9 dash">
            <h1><i style="color: #013243;" class="fa fa-user-plus"></i> Add User<small style="font-size: 25px;"> Add New User</small></h1><hr>
             <ol class="breadcrumb">
              <li class="breadcrumb-item ft-size"><a href="#" class="txt"><i  class="fa fa-tachometer-alt static"></i> Dashboard</a></li>
              <li class="breadcrumb-item active ft-size"><i style="color: #013243;" class="fa fa-user-plus static"></i> Add New User</li>
            </ol>
           <div class="row">
          <?php

           if(isset($_POST['submit'])){
              $fname = mysqli_real_escape_string($dbcon,ucfirst($_POST['first_name']));
              $lname = mysqli_real_escape_string($dbcon,ucfirst($_POST['last_name']));
              $uname = mysqli_real_escape_string($dbcon,strtolower($_POST['username']));
              $username = preg_replace('/\s+/','',$uname);
              $email = mysqli_real_escape_string($dbcon,strtolower($_POST['email']));
              $dob = $_POST['dob'];
              $u_date = date('d-m-y H:i:s'); 
              $password = mysqli_real_escape_string($dbcon,$_POST['password']);
              $cpassword = mysqli_real_escape_string($dbcon,$_POST['cpassword']);
              $role = $_POST['role'];
              $image = $_FILES['image']['name'];
              $image_temp = $_FILES['image']['tmp_name'];
              $imageSize   =  $_FILES['image']['size'];
             
              $email_query = "SELECT email FROM users WHERE  email= '$email'";
              $check_email = mysqli_query($dbcon,$email_query);
              
              $u_query = "SELECT username FROM users WHERE  username= '$uname'";
              $check_username = mysqli_query($dbcon,$u_query);

              if(empty($fname)){
                 $fmsg1 = "<span class='float-right' style='color:red;'>Please enter first name ! Required !!</span>";
              }else if(empty($lname)){
                 $lmsg1 = "<span class='float-right' style='color:red;'>Please enter last name ! Required !!</span>";
              }else if (!preg_match("/^[a-zA-Z]+$/", $fname)) {
                 $error="<div  class='alert alert-danger' style='color:red;'>Numbers are not allowedd !!</div>";
                 $fmsg2 = "<span class='float-right' style='color:red;'>No numbers !<b style='color:green;'>&nbsp;only alphabets</b> !!</span>";
              }else if (!preg_match("/^[a-zA-Z]+$/", $lname)) {
                 $error="<div class='alert alert-danger' style='color:red;'>Numbers are not allowed !!</div>";
                 $lmsg2 = "<span class='float-right'  style='color:red;'>No numbers !<b style='color:green;''>&nbsp;only alphabets</b> !!</span>";
              }else if(empty($uname)){
                 $umsg = "<span class='float-right' style='color:red;'>Please enter username ! Required !!</span>";
              }else if ($uname != $username) {
                 $error="<div class='alert alert-danger' style='color:red;'>Do not use space in username !!</div>";
                 $umsg1 = "<span class='float-right'  style='color:red;'>No space !!</span>";
              }else if (strlen($uname) < 4 ) {
                 $error="<div class='alert alert-danger' style='color:red;'>The Username must be at least 4 characters !!</div>";
                 $umsg2 = "<span class='float-right' style='color:red;'>The Username must be at least 4 characters !!</span>";
              }else if (!preg_match("/^[a-zA-Z0-9.]+$/", $uname)) {
                 $error="<div class='alert alert-danger' style='color:red;'>The characters or symbols are not allowd !!</div>";
                 $umsg3 = "<span class='float-right' style='color:red;'>Please write valid characters ! <b style='color:green;'>&nbsp;only alphabets and numbers</b> !!</span>";
              }else if(mysqli_num_rows($check_username) > 0 ){
                 $error="<div class='alert alert-danger' style='color:red;'>The Username  already exists !!</div>";
                 $umsg4 = "<span class='float-right' style='color:red;'>The username  already exists !!</span>";
              }else if(empty($email)){
                 $emsg = "<span class='float-right' style='color:red;'>Please enter e-mail address ! Required !!</span>";
              }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                 $error="<div class='alert alert-danger' style='color:red;'>The E-mail address is invalid !!</div>";
                 $emsg2 = "<span class='float-right' style='color:red;'>Please enter valid e-mail address !!</span>";
              }else if(mysqli_num_rows($check_email) > 0 ){
                 $error="<div class='alert alert-danger' style='color:red;'>The E-mail address already registered !!</div>";
                 $emsg3 = "<span class='float-right' style='color:red;'>The E-mail address already exists !!</span>";
              }else if(empty($dob)){
                 $dmsg = "<span class='float-right' style='color:red;'>Please enter your date of birth ! Required !!</span>";
              }else if (empty($password)) {
                 $error="<div class='alert alert-danger' style='color:red;'>Please enter your password ! Required !!</div>";
                 $pmsg = "<span class='float-right' style='color:red;'>Please enter your password !!</span>";
              }else if (empty($cpassword)) {
                 $error="<div class='alert alert-danger' style='color:red;'>Please check your confirm password ! Required !!!</div>";
                 $cmsg = "<span class='float-right' style='color:red;'>Please enter your confirm password !!</span>";
              }else if ($password != $cpassword) {
                 $error="<div class='alert alert-danger' style='color:red;'>The Password does not match !!</div>";
                 $cmsg1 = "<span class='float-right' style='color:red;'>The Password does not match !!</span>";
              }else if(strlen($password) < 5){
                 $pmsg1 = "<span class='float-right' style='color:red;'>Password must contain at least 5 characters</span>";
              }else if(empty($image)){
                 $imsg = "<span class='float-right' style='color:red;'>Please upload picture !!</span>";
              }else if ($imageSize > 2000000) {
                 $error = "<div class='alert alert-danger' style='color:red;'>The image  must be maximum 2MB ! Not more than 2MB !!</div>";
              }else{

                $str = "AbzxsdertyqwopukmnbvchgfhMAZX&MNLKPRTY1234567890#$&%$";
                $str = str_shuffle($str);
                $token = substr($str, 0, 10);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (id,first_name,last_name,username,email,dob, password,role,image,token,joined) VALUES (NULL,'$fname','$lname','$username','$email','$dob','$password','$role','$image','$token','$u_date')";
                $run = mysqli_query($dbcon,$query);
                //header("Location:login.php");
                $msg = "<span class='alert alert-success w-100' style='color:green;'>User has been submitted !</span>";
                move_uploaded_file($image_temp, "../dbpic/$image");
                $img_query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
                $img_run = mysqli_query($dbcon,$img_query);
                $image_row = mysqli_fetch_array($img_run);
                $user_image = $image_row['image'];
                  $fname = ""; $lname = ""; $uname = ""; $email = ""; $dob = "";
              }

           }

          ?>
          
            <div class="col-md-8" >
              <center><?php echo $error; ?> <?php echo $msg; ?></center><br>
   
             <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="first_name"><b>First Name *:</b></label>
                <input type="text" id="first_name" class="form-control" name="first_name" value="<?php if(isset($fname)){ echo $fname; } ?>" placeholder="Enter First Name">
                 <?php echo $fmsg1;  ?><?php echo $fmsg2;  ?>
               </div>
               <div class="form-group">
                <label for="last_name"><b>Last Name *:</b></label>
                <input type="text" id="last_name" class="form-control" name="last_name" value="<?php if(isset($lname)){ echo $lname; } ?>" placeholder="Enter Last Name">
                 <?php echo $lmsg1;  ?> <?php echo $lmsg2;  ?>
               </div>
               <div class="form-group ">
               <label for="username"><b>Username *:</b></label>
                <input type="text" id="username" class="form-control" name="username" value="<?php if(isset($uname)){ echo $uname; } ?>" placeholder="Enter Username">
                  <?php echo $umsg  ?><?php echo $umsg1  ?> <?php echo $umsg2  ?> <?php echo $umsg3  ?><?php echo $umsg4  ?>
               </div>
               <div class="form-group">
                <label for="email"><b>E-mail *:</b></label>
                <input type="email" id="email" class="form-control" name="email" value="<?php if(isset($email)){ echo $email; } ?>" placeholder="Enter E-mail Address">
                 <?php echo $emsg  ?><?php echo $emsg1  ?><?php echo $emsg2  ?>
               </div>
               <div class="form-group">
                 <label for="dob">Date of Birth *:</label>
                 <input type="date" id="dob" class="form-control" value="<?php if(isset($dob)){ echo $dob; } ?>" name="dob">
                  <?php echo $dmsg  ?>
               </div>
               <div class="form-group">
                 <label for="role"><b>Role :</b></label>
                 <select name="role" id="role" class="form-control">
                   <option value="author"><b>Author</b></option>
                   <option value="admin"><b>Admin</b></option>
                 </select>
                </div> 
                <div class="form-group">
                   <label for="password"><b>Password *:</b></label>
                   <input type="password" id="password" class="form-control" name="password" placeholder="Please Enter Password">
                    <?php echo $pmsg  ?><?php echo $pmsg1  ?> 
                </div>
                <div class="form-group">
                   <label for="cpassword"><b>Password *:</b></label>
                   <input type="password" id="cpassword" class="form-control" name="cpassword" placeholder="Please Re-Enter Confirm Password">
                    <?php echo $cmsg  ?><?php echo $cmsg1  ?>
                </div>
                <div class="form-group">
                 <label for="image"><b>Profile Image :</b></label>
                 <input type="file" id="image" class="form-control" name="image">
                  <?php echo $imsg  ?>
                </div>
                <center><input type="submit" name="submit" value="Add User" class="btn btn-custom float-left">
                <button class="btn btn-custom"><a href="index.php" style="color: white">Cancel</a></button></center>
              </form>
             </div>
             <div class="col-md-4">
              <?php
              if(isset($user_image)){
                echo "<img src='../dbpic/$user_image' width='100%'>";
              }
              ?>
             </div>
            </div>
           </div>
         </div>
        </div>
<?php include("inc/footer.php"); ?>