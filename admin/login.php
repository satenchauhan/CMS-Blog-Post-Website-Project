<?php session_start();
 require_once('../inc/dbcon.php');
 require_once("./inc/login.php");
?>
<!doctype html>
<html lang="en-US"> 
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/animated.css">
    <link rel="icon" type="image/jpg" href="pic/logo1.jpg">
    <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="./css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Admin Login</title>
  </head>
  <body>
    <div id="container" class="form-signin animated fadeInLeft w-50" style="position: relative; right: 70px; margin-top: 40px;">
      <h1 class="btn-primary">Login Here </h1>
      <form method="POST" action="" enctype="multipart/form-data" class="form-signin">
        <center><?php echo $error; ?></center>
        <ul>
          <li class="form-group">
            <label for="username">Username:</label>
            <center><input type="text" id="username" name="username" class="form-control" placeholder="Enter Username"></center>
            <?php echo $umsg1; ?><?php echo $umsg2; ?>
          </li>
          <li class="form-group">
            <label for="password">password:</label>
            <center><input type="password" id="password" name="password" class="form-control" placeholder="Enter password"></center>
            <?php echo $pmsg1; ?>  <?php echo $pmsg2; ?>
          </li><br>
          <li class="form-group">
            <button type="submit" name="login" class="btn btn-primary">Login</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../index.php" class="btn btn-primary text-white">Cancel</a><br><br>
          <span style="margin-left: -30px;"><a href="forgotpass.php">Forgot Password ??</a><span>
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
