<!-- ==================TOP=================== -->
<?php include('inc/top.php');
if(!isset($_SESSION['username'])){
  header("Location:login.php");

}else if(isset($_SESSION['username']) && ($_SESSION['role']) == 'author'){
  header("Location:index.php");
}

?>

<?php
if(isset($_GET['del'])){
  $del_id = $_GET['del'];
  $del_query = "DELETE FROM  users WHERE id ='$del_id'";
  $del_run = mysqli_query($dbcon, $del_query);
  if(isset($_SESSION['username']) && $_SESSION['role'] == 'admin'){
    if(mysqli_query($dbcon,$del_query)){
    $msg = "<span class='alert alert-success w-100'>User Has Been Deleted </span>";

    }else{
      $error = "<span class='alert alert-danger w-100' style='color:red;'>User Not Deleted </span>";
    }
  }
}


  if(isset($_POST['checkboxes'])){
      
      foreach($_POST['checkboxes'] as $checkbox_id){

          $bulk_option = $_POST['bulk-options'];

          if($bulk_option == 'delete'){ 
            $query = "DELETE FROM  users WHERE id ='$checkbox_id'";
            mysqli_query($dbcon,$query);
            $msg = "<span class='alert alert-success w-100'>User Has Been Deleted </span>";
          }elseif ($bulk_option == 'author'){
            $query = "UPDATE users SET role = 'author' WHERE id = '$checkbox_id'";
            mysqli_query($dbcon,$query);
            
          }elseif ($bulk_option == 'admin') {
            $query = "UPDATE users SET role = 'admin' WHERE id = '$checkbox_id'";
            mysqli_query($dbcon,$query);


          }else{
            $error = "<span class='alert alert-danger w-100' style='color:red;'>User Not Deleted </span>";
          }

        }
  }
  ?>
<body>
<div id="container">
<!-- ===============HEADER NAVBAR CONTENTS=================== -->
  <?php include("inc/navbar.php"); ?>

        <div class="container-fluid body-section">
           <div class="row">
            <div class="col-md-3">
<!-- ====================SIDEBAR============================= -->
             <?php include("inc/sidebar.php"); ?>
          </div>
<!-- ========================PAGE CONTENTS================== -->
<div class="col-md-9 dash">
<!-- dashhead -->
  <h1><i style="color: #013243;" class="fa fa-users"></i>  Users<small style="font-size: 25px;">  View All Users</small></h1><hr>
  <ol class="breadcrumb">
     <li class="breadcrumb-item ft-size"><a href="#" class="txt"><i class="fa fa-tachometer-alt static" ></i> Dashboard</a></li>
     <li class="breadcrumb-item active ft-size"><i class="fa fa-users static"></i> Users</li>
  </ol>

  <?php
  $query = "SELECT * FROM users ORDER BY id DESC LIMIT 10";
  $run = mysqli_query($dbcon,$query);
  if(mysqli_num_rows($run)> 0){
  ?>
     <form action="" method="post">
       <div class="row">
         <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                <select name="bulk-options" id="" class="form-control">
                <option value="delete" name="delete">Delete</option>
                <option value="author" name="author">Change to Author</option>
                <option value="admin" name="admin">Change to Admin</option>
                </select>
                </div>
                </div>
                <div class="col-sm-8">
                  <input type="submit" class="btn btn-success" name="" value="Apply">
                  &nbsp;&nbsp;
                  <a href="add-user.php" class="btn btn-custom"> Add New User</a>
                </div><br><br><br>
               </div> 
             </div>
           </div>
           <?php if(isset($msg)){ echo $msg;}elseif (isset($error)){ echo $error; } ?>
            <table class="table table-hover table-bordered table-striped table-custom">
            <thead>
            <tr>
              <th><input type="checkbox" id="selectallboxes" name=""></th>
              <th>Sr #</th>
              <th>Name</th>
              <th>Username</th>
              <th>Image</th>
              <th>Email</th>
              <th>Date of Birth</th>
              <th>Role</th>
              <th>Edit</th>
              <th>Delete</th>    
            </tr>
            </thead>
            <tbody>
          <?php
            while($row=mysqli_fetch_array($run)){
             $id = $row['id'];
             $fname = ucfirst($row['first_name']);
             $lname = ucfirst($row['last_name']);
             $fullname = $fname." ".$lname;
             $uname = $row['username'];
             $email = $row['email'];
             $role = $row['role'];
             $img = $row['image'];
             $dob = $row['dob'];
             $date = $row['joined'];
          ?>
             <tr>
               <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id; ?>"></td>
               <td><?php echo $id; ?></td>
               <td><?php echo $fullname; ?></td>
               <td><?php echo $uname; ?></td>
               <td><img src="../dbpic/<?php echo $img; ?>" width="50px"></td>
               <td><?php echo $email; ?></td>
               <td><?php echo $dob; ?></td>
               <td><?php echo ucfirst($role); ?></td>
               <!-- <td><?php //echo $date; ?></td> -->
               <td><a href="edit-user.php?edit=<?php echo $id; ?>"><i class="far fa-edit fa-edit btn btn-primary"></i></a></td>
               <td align="center"><a href="user.php?del=<?php echo $id; ?>"<i class="fas fa-times fa-del btn btn-danger"></i></a></td>                  
             </tr>
                <?php } ?>                  
           </tbody>
        </table>
      <?php }
           else{
            echo "<center><h2>No Users Available Now</h2></center>";
          }
      ?>

  </form>
 </div>
</div>
</div>

<?php include('inc/footer.php'); ?>
