<!-- ===============TOP===============-->
<?php require_once('inc/top.php');
if(!isset($_SESSION['username'])){
  header('Location: login.php');
}

  $session_username = $_SESSION['username'];
  $query = "SELECT * FROM users WHERE username='$session_username'";
  $run = mysqli_query($dbcon,$query);
  $result = mysqli_num_rows($run);
  $row = mysqli_fetch_array($run);

  $id = $row['id'];
  $fname = $row['first_name'];
  $lname = $row['last_name'];
  //$fullname = $fname." ".$lname;
  $username = $row['username'];
  $email = $row['email'];
  $role = $row['role'];
  $dob = $row['dob'];
  $image = $row['image'];
  $date = $row['joined'];

?>
<body>
<div id="container">
<!-- ================= NAVBAR CONTENTS=============-->
   <?php include("inc/navbar.php"); ?>
     <div class="container-fluid body-section">
       <div class="row">
        <div class="col-md-3">
        <?php include("inc/sidebar.php"); ?>
        </div>
<!-- =================PAGE CONTENTS================== -->
    <div class="col-md-9 dash">
    <h1><i style="color: #013243;" class="fa fa-user ft-c"></i> Profile <small style="font-size: 25px;"> Personal Details</small></h1><hr>
      <ol class="breadcrumb">
      <li class="breadcrumb-item ft-size"><a href="index.php" class="txt"><i class="fa fa-tachometer-alt static"></i> Dashboard</a></li>
      <li class="breadcrumb-item active ft-size"><i class="fa fa-user ft-c"></i> Profile</li>
      </ol>
    <?php if(isset($_GET['change'])){ echo "<div class='alert alert-success' style='color:green;'>The password has been <b>Changed</b> !! Please click on <a href='logout.php'>&nbsp;Login Again</a></div>"; } 
    ?>
    <div class="row">
    <div class="col-sm-12">
        <center><img src="../dbpic/<?php echo $image; ?>" style="width: 200px; box-shadow: 0px 0px 15px 1px rgba(61,57,61,0.97);" class="img-thumbnail" name="profile-image" id="profile-image"></center>
         <a href="changepass.php?changeid=<?php echo $id; ?>" class="btn btn-primary float-right">Change Password</a><br><br>
    
       <center><h3>Profile Details</h3></center><br>
       <table class="table table-bordered">
         <tr>
           <td width="20%"><b>First Name:</b></td>
           <td width="20%"><?php echo $fname; ?></td>
           <td width="20%"><b>Last Name:</b></td>
           <td width="20%"><?php echo $lname; ?></td>
         </tr>
         <tr>
           <td width="20%"><b>Username:</b></td>
           <td width="20%"><?php echo ucfirst($username); ?></td>
           <td width="20%"><b>E-mail:</b></td>
           <td width="20%"><?php echo $email; ?></td>
         </tr>
         <tr>
           <td width="20%"><b>Role:</b></td>
           <td width="20%"><?php echo ucfirst($role); ?></td>
           <td width="20%" ><b>Date of Birth</b><small> (YYYY-MM-DD)</small><b>:</b></td>
           <td width="20%"><?php echo $dob; ?></td>
         </tr>
         <tr>
           <td width="20%"><b>User ID:</b></td>
           <td width="20%"><?php echo $id; ?></td>
           <td width="20%"><b> Date & Time of Joined:</b></td>
           <td width="20%"><?php echo $date;?></td>
         </tr>
       </table>
     </div>  
   </div>              
  </div>
 </div>
</div>
  <!-- ==========================FOOTER==================================== -->
  <?php include('inc/footer.php'); ?>