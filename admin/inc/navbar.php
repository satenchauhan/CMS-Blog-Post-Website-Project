<!-- ========HEADER================-->
<?php
$session_role2 = $_SESSION['role'];
$session_username = $_SESSION['username'];
?>
  <nav class="navbar navbar-expand-lg min-color fixed-top">
    <div class="container">
       <a class="navbar-brand text-white" href="index.php">Saten Chauhan</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse min-color" id="navbarResponsive" style="margin-left: 100px;">
        <ul class="navbar-nav " style="margin-left: 15px;">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <li class="nav-item active">
          <a class="nav-link text-white" href="./index.php"><i class="fa fa-home"></i>&nbsp;Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link text-white" href="add-post.php"><i class="fa fa-plus-square"></i> Add Post</a></li>
    <?php if ($session_role2 == 'admin') { 

    ?>
      <li class="nav-item">
      <a class="nav-link text-white" href="add-user.php"><i class="fa fa-user-plus"></i> Add User</a>
  <?php } ?>
      </li>
      <li class="nav-item">
      <a class="nav-link text-white" href="profile.php"><i class="fa fa-user"></i> Profile</a>
      </li>
      <li class="nav-item">
      <a class="nav-link text-white" href="#">Welcome: <i class="fa fa-user"></i>&nbsp;<?php echo ucfirst($session_username);  ?></a>
      </li>&nbsp;&nbsp;
      <li class="nav-item">
      <a class="nav-link text-white" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
      </li>
    </ul>
  </div>
  </div>
</nav>

  