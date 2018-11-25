<!-- ===================TOP================= -->
<?php include('inc/top.php');

 $msg=""; $error=""; $umsg=""; $uerror=""; $dmsg=""; $derror=""; 

if(!isset($_SESSION['username'])){
  header("Location:login.php");
}else if (isset($_SESSION['username']) && ($_SESSION['role']) == 'author') {
  header("Location:index.php");
}

//==Update function

if(isset($_GET['edit'])){
  $edit_id = $_GET['edit'];

}

//==Delete function
if(isset($_GET['del'])){
   $del_id = $_GET['del'];
   if(isset($_SESSION['username']) && ($_SESSION['role']) == 'admin') {
       $query = "DELETE FROM categories WHERE id='$del_id'";
       if(mysqli_query($dbcon,$query)){;
         $dmsg ="<span class='alert alert-success w-100' style='color:green;'>Category has been deleted</span>";

       }else{

        $derror = "<span class='alert alert-danger w-100' style='color:red;'>Category Has Not Been deleted</span>";
      }

    } 
}

//==Insert Function
if(isset($_POST['submit'])){
  $cat_name = mysqli_real_escape_string($dbcon,ucfirst($_POST['cat_name']));

  $query = "SELECT category FROM categories WHERE category='$cat_name'";
  $run = mysqli_query($dbcon,$query);

    if (empty($cat_name)) {

      $error = "<span class='alert alert-danger w-100' style='color:red;'>Please Enter Category Name </span>";

    }else {
      if(mysqli_num_rows($run) > 0){

        $error = "<span class='alert alert-danger w-100' style='color:red;'>Category Already Exists </span>";

      }else{  

       $insert_query = "INSERT INTO categories(category) VALUES ('$cat_name')";

       if(mysqli_query($dbcon,$insert_query)){

       $msg ="<span class='alert alert-success w-100' style='color:green;'>Category has Been Added</span>";

       }else{
        $error ="<span class='alert alert-danger w-100' style='color:red;'>Category Has Not Been Added</span>";
       }

     }
  } 

} 

//==Update
if(isset($_POST['update'])){
  $cat_name = mysqli_real_escape_string($dbcon,ucfirst($_POST['cat_name']));
  
    if (empty($cat_name)) {
      $uerror = "<span class='alert alert-danger w-100' style='color:red;'>Please Enter Category Name </span>";
    }else{

        $query = "SELECT * FROM categories WHERE category='$cat_name'";
        $run = mysqli_query($dbcon,$query);

       if(mysqli_num_rows($run) > 0){
          $uerror = "<span class='alert alert-danger w-100' style='color:red;'>Category Already Exists </span>";

       }else{

          $update_query = "UPDATE categories SET category= '$cat_name' WHERE id='$edit_id'";
       if(mysqli_query($dbcon, $update_query)){
          $umsg ="<span class='alert alert-success w-100' style='color:green;'>Category Has Been Updated</span>";
       }else{
          $uerror = "<span class='alert alert-danger w-100' style='color:red;'>Category Has Not Been Updated</span>";
      }
    }
  }
 
}

?>
<body>
<div id="container">
<!-- ================================================HEADER NAVBAR CONTENTS==================================================== -->
  <?php include("inc/navbar.php"); ?>
        <div class="container-fluid body-section">
           <div class="row">
            <div class="col-md-3">
              <?php include("inc/sidebar.php"); ?>
            </div>
<!-- ================================================PAGE CONTENTS==================================================== -->
<div class="col-md-9 dash">
  <h1><i style="color: #013243;" class="fa fa-folder-open"></i> Categories <small style="font-size: 25px;">Different Categories</small></h1><hr>
   <ol class="breadcrumb">
     <li class="breadcrumb-item active ft-size"><a href="index.html" class="txt"><i class="fa fa-tachometer-alt static"></i>&nbsp;Dashboard</a></li>
     <li class="breadcrumb-item active ft-size"><i class="fa fa-folder-open static"></i> Categories</li>
   </ol>
    <div class="row">
     <div class="col-md-4">
       <center><?php echo $error; ?><?php echo $msg; ?></center>
        <form action="" method="post">
        <div class="form-group">
          <label for="cat_name">Category Name:</label>
          <input type="text" name="cat_name" placeholder="Category Name" class="form-control">
        </div>
      <input type="submit" name="submit" class="btn btn-custom" value="Add">
      </form>
      <hr><br>
      <center><?php echo $uerror; ?><?php echo $umsg; ?></center>
      <?php
      if (isset($_GET['edit'])) {
        $edit_id = $_GET['edit'];

        $query = "SELECT * FROM categories WHERE id='$edit_id'";
        $run = mysqli_query($dbcon,$query);
        if (mysqli_num_rows($run) > 0) {
          $row= mysqli_fetch_array($run);
          $edit_cat = $row['category'];
        
        ?>
   
      <form action="" method="post">
        <div class="form-group">
          <label for="cat_name">Update Category Name:</label>
           <input type="text" name="cat_name" value="<?php echo $edit_cat; ?>"  placeholder="Category Name" class="form-control">
         </div>
         <input type="submit" name="update" class="btn btn-custom" value="Update Category">
       </form>
       <?php 
             }
          }
      ?>
     </div>

     <div class="col-md-8">
    <?php
     $query = "SELECT * FROM categories ORDER BY id ASC";
     $run = mysqli_query($dbcon,$query);
     if($data = mysqli_num_rows($run) >0 ){

    ?>

    <center><?php echo $derror; ?><?php echo $dmsg; ?></center>
    <table class="table table-hover table-bordered table-striped table-custom">
        <thead>
         <tr>
            <th>Sr #</th>
            <th>Category Name </th>
            <th>Posts</th>
            <th>Edit</th>
            <th>Delete</th>
         </tr>
        </thead>
       <tbody>
      <?php
        while($row=mysqli_fetch_array($run)){
          $category_id = $row['id'];
          $category = $row['category'];

        ?>
         <tr>
           <td><?php echo $category_id; ?></td>
           <td><?php echo ucfirst($category); ?></td>
           <td>Post 1</td>
           <td><a href="category.php?edit=<?php echo $category_id; ?>"><i class="far fa-edit btn btn-primary"></i></a></td>
           <td><a href="category.php?del=<?php echo $category_id; ?>"><i class="fas fa-times btn btn-danger"></i></a></td>
         </tr>
          <?php } ?>
        </tbody>
       </table>
       <?php
          }else{

          $msg ="<span class='alert alert-success w-100' style='color:green;'>No Category Available</span>"; 
         }
       
        ?>
      </div>
     </div>
   </div> 
  </div>
</div>                 
<!-- ==================FOOTER===================================== -->
  <?php include('inc/footer.php'); ?>
 

