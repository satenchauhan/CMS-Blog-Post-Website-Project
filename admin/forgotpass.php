<?php session_start();
 require_once('../inc/dbcon.php');
 require_once("./inc/forgotpass.php");
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
    <div id="container" class="form-signin animated fadeInLeft w-50" style="position: relative; right: 70px; margin-top: 10px;">
      <h1 class="btn-primary">Forgot Password </h1>
      <form method="POST" action="" enctype="multipart/form-data" class="form-signin">
        <center><?php echo $error; ?><?php echo $msg; ?></center>
        <ul>
          <li class="form-group">
            <label for="email">Email:</label>
            <center><input type="text" id="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Please Enter E-mail"></center>
            <?php echo $emsg1; ?><?php echo $emsg2; ?>
          </li>
          <li class="form-group">
            <label for="dob">Date of Birth:</label>
            <center><input  type="date" id="dob" name="dob" value="<?php echo $dob; ?>" class="form-control" placeholder="Enter Your Date of Birth"></center>
            <?php echo $dmsg1; ?><?php echo $dmsg2; ?>
          </li>
          <li class="form-group">
            <label for="pass">New Password:</label>
          <center><input type="password" id="pass" name="pass" value="<?php echo $pass; ?>" class="form-control" placeholder="Plese Enter New password"></center>
          <?php echo $pmsg1; ?><?php echo $pmsg2; ?>
          </li>
          <li class="form-group">
            <label for="cpass">Cofirm password:</label>
            <center><input type="password" id="cpass" name="cpass" value="<?php echo $cpass; ?>" class="form-control" placeholder="Please Re-Enter password"></center>
            <?php echo $cpmsg; ?> <?php echo $cpmsg1; ?>
          </li><br>
          <li class="form-group">
             <center><input type="submit" name="forgot" value="Reset Password" class="btn btn-primary">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <a href="../index.php" class="btn btn-primary text-white">Cancel</a>
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


































     