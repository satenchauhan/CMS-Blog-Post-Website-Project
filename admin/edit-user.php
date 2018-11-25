<!-- =========================TOP=================================== -->
<?php include('inc/top.php');

$error=""; $msg=""; $fmsg1=""; $lmsg1=""; $fmsg2=""; $lmsg2=""; $umsg=""; $umsg2=""; $umsg3=""; $emsg1="";   

if(!isset($_SESSION['username'])){
  header("Location:login.php");
}else if(isset($_SESSION['username']) && ($_SESSION['role']) == 'author'){
  header("Location:index.php");
}

if(isset($_GET['edit'])){
   $edit_id = $_GET['edit'];
   $query = "SELECT * FROM users WHERE id ='$edit_id'";
   $run = mysqli_query($dbcon,$query);
   if(mysqli_num_rows($run) > 0){
     $edit_row = mysqli_fetch_assoc($run);
     $edit_fname = $edit_row['first_name'];
     $edit_lname = $edit_row['last_name'];
     $edit_username = $edit_row['username'];
     $edit_email = $edit_row['email'];
     $edit_role = $edit_row['role'];
     $edit_image = $edit_row['image'];

   }else{
    header("Location:index.php");
   }

}else{
  header("Location: index.php");
}

?>
<body>
<div id="container">
<!-- ======================HEADER NAVBAR CONTENTS============= -->
  <?php //include("inc/navbar.php"); ?>
    <div class="container-fluid body-section">
      <div class="row">
        <div class="col-md-3">
<!-- =====================SIDEBAR========================== -->
        <?php //include("inc/sidebar.php"); ?>
      </div>
<!-- =================PAGE CONTENTS======================= -->
    <div class="col-md-9 dash">
       <h1><i style="color: #013243;" class="fa fa-edit"></i> Edit User<small style="font-size: 25px;"> Edit User Details</small></h1><hr>
       <ol class="breadcrumb">
        <li class="breadcrumb-item ft-size"><a href="#" class="txt"><i  class="fa fa-tachometer-alt static"></i> Dashboard</a></li>
        <li class="breadcrumb-item active ft-size"><i style="color: #013243;" class="fa fa-edit static"></i> Edit User</li>
      </ol>
    <?php

    if(isset($_POST['update'])){
              $fname = mysqli_real_escape_string($dbcon,ucfirst($_POST['first_name']));
              $lname = mysqli_real_escape_string($dbcon,ucfirst($_POST['last_name']));
              $uname = mysqli_real_escape_string($dbcon,strtolower($_POST['username']));
              $username = preg_replace('/\s+/','',$uname);
              $email = mysqli_real_escape_string($dbcon,strtolower($_POST['email']));
              $role = $_POST['role'];
              $image = $_FILES['image']['name'];
              $image_temp = $_FILES['image']['tmp_name'];
              $imageSize   =  $_FILES['image']['size'];

              if(empty($image)){
                $image = $edit_image;
              }

              if(empty($fname)){
                 $fmsg1 = "<span class='float-right' style='color:red;'>Please enter first name ! Required !!</span>";
              }else if(empty($lname)){
                 $lmsg1 = "<span class='float-right' style='color:red;'>Please enter last name ! Required !!</span>";
              }else if (!preg_match("/^[a-zA-Z\\s]+$/", $fname)) {
                 $error="<div  class='alert alert-danger' style='color:red;'>Numbers are not allowedd !!</div>";
                 $fmsg2 = "<span class='float-right' style='color:red;'>No numbers !<b style='color:green;'>&nbsp;only alphabets</b> !!</span>";
              }else if (!preg_match("/^[a-zA-Z\\s]+$/", $lname)) {
                 $error="<div class='alert alert-danger' style='color:red;'>Numbers are not allowed !!</div>";
                 $lmsg2 = "<span class='float-right'  style='color:red;'>No numbers !<b style='color:green;''>&nbsp;only alphabets</b> !!</span>";
              }else if(empty($uname)){
                 $umsg = "<span class='float-right' style='color:red;'>Please enter username ! Required !!</span>";
              }else if (strlen($uname) < 4 ) {
                 $error="<div class='alert alert-danger' style='color:red;'>The Username must be at least 4 characters !!</div>";
                 $umsg2 = "<span class='float-right' style='color:red;'>The Username must be at least 4 characters !!</span>";
              }else if (!preg_match("/^[a-zA-Z0-9_-]+/i", $username)) {
                 $error="<div class='alert alert-danger' style='color:red;'>The characters or symbols are not allowd !!</div>";
                 $umsg3 = "<span class='float-right' style='color:red;'>Please write valid characters !<b style='color:green;'>&nbsp;only alphabets and numbers</b> !!</span>";
              }else if (empty($email)) {
                 $email = $edit_email;
              }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                 $error="<div class='alert alert-danger' style='color:red;'>The E-mail address is invalid !!</div>";
                 $emsg1 = "<span class='float-right' style='color:red;'>Please enter valid e-mail address !!</span>";
              }else{

                  $update_query = "UPDATE users SET first_name='$fname', last_name='$lname', username='$uname', email='$email', role='$role', image='$image' WHERE id=$edit_id";
                  if(mysqli_query($dbcon,$update_query)){
                    header("Location:index.php?updated");
                    //$updated = "<div class='alert alert-success' style='color:green;'>User has been updated !! </div>";
                    
                    move_uploaded_file($image_temp,"../dbpic/$image"); 
                    $fname =""; $lname =""; $username =""; $email =""; 

                  }else{

                    $error = "<span class='alert alert-danger w-100' style='color:red;'>User has not been updated !</span>";
                  }  

              }

   }

?>

  <div class="row">
    <div class="col-md-8" >
     <center><span class="w-100"><?php  echo $error; ?><?php echo $msg; ?></span></center>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
             <label for="first_name"><b>First Name*:</b></label>
             <input type="text" id="first_name" class="form-control" name="first_name" value="<?php if(isset($fname)){ echo $fname; }else if(isset($edit_fname)){ echo $edit_fname; } ?>" placeholder="Enter First Name">
          <?php echo $fmsg1; ?><?php echo $fmsg2; ?>
          </div>
          <div class="form-group">
             <label for="last-name"><b>Last Name:*</b></label>
             <input type="text" id="last_name" class="form-control" name="last_name" value="<?php if(isset($lname)){ echo $lname; }else if(isset($edit_lname)){ echo $edit_lname; } ?>"placeholder="Enter Last Name">
          <?php echo $lmsg1; ?><?php echo $lmsg2; ?>
         </div>
         <div class="form-group ">
            <label for="username"><b>Username:*</b></label>
            <input type="text" id="username" class="form-control" name="username" value="<?php if(isset($username)){ echo $username; }else if(isset($edit_username)){ echo $edit_username; } ?>" placeholder="Enter Username">
          <?php echo $umsg; ?><?php echo $umsg2; ?><?php echo $umsg3; ?>
         </div>
         <div class="form-group">
            <label for="email"><b>E-mail *:</b></label>
            <input type="text" id="email" class="form-control" name="email" value="<?php if(isset($email)){ echo $email; }else if(isset($edit_email)){ echo $edit_email; } ?>" placeholder="Enter E-mail Address">
             <?php echo $emsg1;  ?>
         </div>
         <div class="form-group">
            <label for="role"><b>Role:*</b></label>
            <select name="role" id="role" class="form-control">
            <option value="author" <?php if($edit_role == 'author'){echo "selected";} ?> ><b>Author</b></option>
            <option value="admin" <?php if($edit_role == 'admin'){echo "selected";} ?>><b>Admin</b></option>
          </select>
         </div>
         <div class="form-group">
           <label for="image"><b>Profile Image:*</b></label>
           <input type="file" id="image" class="form-control" name="image">
         </div>
         <center><input type="submit" name="update" value="Update User" class="btn btn-custom"></center>
        </form>
    </div>
    <div class="col-md-4">
      <?php
       echo "<img src='../dbpic/$edit_image' width='100%'>";
      ?>
    </div>
   </div>
  </div>
 </div>
</div>
  <!-- ======================FOOTER==============================  -->
 <?php include('inc/footer.php'); ?>