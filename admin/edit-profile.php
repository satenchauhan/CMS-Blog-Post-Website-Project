<!-- ===========TOP============================ -->
<?php include('inc/top.php'); 
if(!isset($_SESSION['username'])){
  header("Location:index.php");
}

$session_username = $_SESSION['username'];
if(isset($_GET['edit'])){
   $edit_id = $_GET['edit'];
   $query = "SELECT * FROM users WHERE id ='$edit_id'";
   $run = mysqli_query($dbcon,$query);
   if(mysqli_num_rows($run) > 0){
    $edit_row = mysqli_fetch_assoc($run);
    $edit_username = $edit_row['username'];
    if($edit_username == $session_username){
      $edit_fname = $edit_row['first_name'];
      $edit_lname = $edit_row['last_name'];
      $edit_email = $edit_row['email'];
      $edit_details = $edit_row['details'];
      $edit_image = $edit_row['image'];
    }else{
      header("Location:index.php");
    }

   }else{
     header("Location:index.php");
   }

  }else{
    header("Location: index.php");
 }

?>
<body>
<div id="container">
<!-- ==============HEADER CONTENTS==============-->
  <?php include("inc/navbar.php"); ?>
      <div class="container-fluid body-section">
        <div class="row">
          <div class="col-md-3">
<!-- ==================SIDEBAR================== -->
            <?php include("inc/sidebar.php"); ?>
          </div>
<!-- =============PAGE CONTENTS================= -->
        <div class="col-md-9 dash">
          <h1><i style="color: #013243;" class="fa fa-user"></i> Edit Profile<small style="font-size: 25px;"> Edit Profile Details</small></h1><hr>
          <ol class="breadcrumb">
          <li class="breadcrumb-item ft-size"><a href="#" class="txt"><i  class="fa fa-tachometer-alt static"></i> Dashboard</a></li>
          <li class="breadcrumb-item active ft-size"><i style="color: #013243;" class="fa fa-user static"></i> Edit Profile</li>
          </ol>
  <?php

    if(isset($_POST['update'])){
      $fname = mysqli_real_escape_string($dbcon,ucfirst($_POST['first_name']));
      $lname = mysqli_real_escape_string($dbcon,ucfirst($_POST['last_name']));
      $username = mysqli_real_escape_string($dbcon,$_POST['username']);
      $email = $_POST['email'];
      $details = $_POST['details'];
      $image = $_FILES['image']['name'];
      $image_temp = $_FILES['image']['tmp_name'];
         
      if(empty($image)){
       $image = $edit_image;}
            
      if(empty($fname) || empty($lname) || empty($username) || empty($email) || empty($details)){

       $error = "<span class='alert alert-info w-100' style='color:red;'>All (*) Fields are Required ! !</span>";

      }else{ 
        $update_query = "UPDATE users SET first_name='$fname', last_name='$lname', username='$username', email='$email', image='$image', details = '$details' WHERE id ='$edit_id'";
       
        if($run= mysqli_query($dbcon,$update_query)){
         //header("location:login.php");
          $msg = "<span class='alert alert-info w-100' style='color:green;'>Profile Has Been Updated !! To See Profile Please Click on <a href='login.php'>&nbsp;Login</a></span>";
          move_uploaded_file($image_temp,"../dbpic/$image");

        }else{

          $error = "<span class='alert alert-danger w-100' style='color:red;'>Profile Has not Been Updated !</span>";
         }    

      }

  }

?>

  <div class="row">
    <div class="col-md-8" >
     <center><span class="w-100"><?php if(isset($error)){ echo $error;}else if(isset($msg)){ echo $msg;} ?></span></center>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
      <label for="first_name"><b>First Name*:</b></label>
      <input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo $edit_fname; ?>" placeholder="Enter First Name">
      </div>
      <div class="form-group">
      <label for="last-name"><b>Last Name:*</b></label>
      <input type="text" id="last_name" class="form-control" name="last_name" value="<?php echo $edit_lname; ?>" placeholder="Enter Last Name">
     </div>
     <div class="form-group ">
     <label for="username"><b>Username:*</b></label>
      <input type="text" id="username" class="form-control" name="username" value="<?php echo $edit_username; ?>" placeholder="Enter Username">
     </div>
     <div class="form-group">
      <label for="email"><b>E-mail:*</b></label>
      <input type="email" id="email" class="form-control" name="email" value="<?php echo $edit_email; ?>" placeholder=" Enter E-mail Address">
     </div>
    <!--  <div class="form-group">
      <label for="password"><b>Password:*</b></label>
      <input type="password" id="password" class="form-control" name="password" placeholder=" Enter Password">
     </div> -->
     <div class="form-group">
      <label for="details"><b>Details</b></label>
      <textarea name="details" id="details" cols="30" rows="10" class="form-control"><?php echo $edit_details; ?></textarea>
      </div>
      <div class="form-group">
      <label for="image"><b>Profile Image:*</b></label>
      <input type="file" id="image" class="form-control" name="image" >
      </div>
     <center><input type="submit" name="update" value="Update Profile" class="btn btn-primary"></center>
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
  <!-- ==========================FOOTER======================= -->
  <?php include('inc/footer.php'); ?>