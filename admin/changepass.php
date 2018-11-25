<?php
 require_once('../inc/dbcon.php');
 require_once("./inc/changepass.php");

 if(isset($_GET['changeid'])){
    $change_id = $_GET['changeid'];
 }

 ?>
<!doctype html>
<html lang="en-US"> 
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/animated.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="./css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Admin Login</title>
  </head>
  <body>

    <div id="container" class="form-signin animated fadeInLeft w-50" style="position: relative; right: 70px; margin-top: 40px;">
      <h1 class="btn-primary">Change Password </h1>
      <form method="POST" action="" enctype="multipart/form-data" class="form-signin">
        <center><?php echo $error; ?></center>
        <ul>
          <li class="form-group">
            <label for="pass">New Password:</label>
            <center><input type="password" id="pass" name="pass" class="form-control" placeholder="Enter Username"></center>
             <?php echo $pmsg1; ?><?php echo $pmsg2; ?>
          </li>
          <li class="form-group">
            <label for="cpass">Password:</label>
            <center><input type="password" id="cpass" name="cpass" class="form-control" placeholder="Enter password"></center>
            <?php echo $cpmsg1; ?><?php echo $cpmsg2; ?>
          </li><br>
          <li class="form-group">
           <center><button type="submit" name="changepass" class="btn btn-primary">Save Changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            <a href="profile.php" class="btn btn-primary text-white">Cancel</a>
          </center>
          </li>
        </ul>
       </form>
     </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  
   <script type="text/javascript" src="js/jquery.min.js"></script>
   <script type="text/javascript" src="js/bootstrap.min.js"></script>
   <script type="text/javascript" src="js/myscript.js"></script>
   <script type="text/javascript" src="js/popper.min.js"></script>
   
 </body>
 </html>


































     






















