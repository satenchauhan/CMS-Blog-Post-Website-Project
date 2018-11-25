<!-- =================TOP===================== -->
<?php include('inc/top.php');
if(!isset($_SESSION['username'])){
  header("Location:login.php");

}

/*else if(isset($_SESSION['username']) && ($_SESSION['role']) == 'author'){
  header("Location:index.php");
}*/


$session_username =$_SESSION['username'];

$error=""; $msg="";
//==delete
if(isset($_GET['del'])){
  $del_id = $_GET['del'];
   if($_SESSION['role'] == 'admin' ){
     $del_check_query = "SELECT * FROM posts WHERE id = $del_id";
     $del_check_run = mysqli_query($dbcon,$del_check_query);
   }
   else if($_SESSION['role'] == 'author'){
     $del_check_query = "SELECT * FROM posts WHERE id = $del_id and author = '$session_username'";
     $del_check_run = mysqli_query($dbcon,$del_check_query);
   }
   if(mysqli_num_rows($del_check_run) > 0){
     $del_query = "DELETE FROM `posts` WHERE `posts`.`id` = $del_id";
      if(mysqli_query($dbcon, $del_query)){
        $msg = "<span class='alert alert-success w-100' style='color:green;'>Post has been deleted</span>";
       }
       else{
        $error = "<span class='alert-danger w-100' style='color:red;'>Post has not been deleted</span>";
       }
   }
   else{
     header("Location: index.php");
   }
 }


//==Select Option
if(isset($_POST['checkboxes'])){
    foreach($_POST['checkboxes'] as $check_id){
     
      $select_option = $_POST['select_option'];

      if ($select_option == 'delete') {
         $del_query = "DELETE FROM posts WHERE id ='$check_id'";
         mysqli_query($dbcon,$del_query);
         $msg = "<span class='alert alert-success w-100'>Post has been deleted </span>";
      }elseif ($select_option == 'publish') {
         $query = "UPDATE posts SET status='publish' WHERE id ='$check_id'";
         mysqli_query($dbcon,$query);
         $msg = "<span class='alert alert-success w-100'>Post has been published </span>";
      }elseif ($select_option == 'draft') {
         $query = "UPDATE posts SET status='draft' WHERE id='$check_id'";
         mysqli_query($dbcon,$query);
         $msg = "<span class='alert alert-success w-100'>Post has been draft </span>";
      }else{
         $error = "<span class='alert alert-danger w-100' style='color:red;'>Post is not publish</span>";
      }
  }
}

?>
<body>
<div id="container">
<!-- ==============HEADER CONTENTS============ -->
<?php include("inc/navbar.php"); ?>
<div class="container-fluid body-section">
  <div class="row">
    <div class="col-md-3">
      <?php include("inc/sidebar.php"); ?>
      </div>
      <div class="col-md-9 dash">
        <h1><i style="color: #013243;" class="fas fa-file-alt"></i>&nbsp;Posts<small style="font-size: 25px;"> View All Posts</small></h1><hr>
      <ol class="breadcrumb">
        <li class="breadcrumb-item ft-size"><a href="index.php" class="txt"><i class="fa fa-tachometer-alt static"></i> Dashboard</a></li>
        <li class="breadcrumb-item active ft-size"><i class="fas fa-file-alt static"></i>&nbsp;Posts</li>
       </ol><hr>
         
  <?php
    if($_SESSION['role'] == 'admin') {
        $query ="SELECT * FROM posts ORDER BY id DESC";
        $run = mysqli_query($dbcon,$query);
     }elseif ($_SESSION['role'] == 'author') {
        $auth_query ="SELECT * FROM posts WHERE author='$session_username' ORDER BY id DESC";
        $run = mysqli_query($dbcon,$auth_query);
    }
    if (mysqli_num_rows($run) > 0) {
  ?>
    
     <form action="" method="POST">
      <div class="row">
       <div class="col-sm-8">
         <div class="row">
           <div class="col-sm-4">
             <div class="form-group">
              <select name="select_option" id="select_option" class="form-control">
              <option value="delete">Delete</option>
              <option value="publish">Publish</option>
              <option value="draft">Draft</option>
              </select>
             </div>
             </div>
             <div class="col-sm-8">
            <input type="submit" class="btn btn-success" name="" value="Apply"> <a href="add-post.php" class="btn btn-custom"> Add New</a>
          </div>
         </div>
        </div>
       </div>
    <?php  echo $msg; ?><?php  echo $error;  ?>
    <span>Click on Image to see full image size</span>
    <table class="table table-hover table-bordered table-striped table-custom">
    <thead align="center">
     <tr width="10%">
      <th><input type="checkbox" id="selectallboxes" name=""></th>
        <th>Id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Image</th>
        <th>Categories</th>
        <th>Views</th>
        <th>Status</th>
        <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>
        </thead>
         <tbody>
          <?php
            while($row=mysqli_fetch_array($run)){
             $id     = $row['id'];
             $title  = $row['title'];
             $author = $row['author'];
             $cate   = $row['categories'];
             $views  = $row['views'];
             $image  = $row['image'];
             $status = $row['status'];
             $date   = date('d-m-y');
          ?>
         <tr align="center">
           <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id; ?>"></td>
           <td><?php echo $id; ?></td>
           <td><?php echo ucwords($title); ?></td>
           <td><?php echo ucfirst($author); ?></td>
           <td><a href="../dbpic/<?php echo $image; ?>"><img src="../dbpic/<?php echo $image; ?>" width="50px"></a></td>
           <td><?php echo ucfirst($cate); ?></td>
           <td><?php echo $views; ?></td>
           <td style="color:<?php if($status =='publish'){echo 'green';}elseif($status=='draft'){echo 'red';} ?>"><?php echo ucfirst($status); ?></td>
           <td style="font-size: 14px;"><?php echo $date; ?></td>
           <td><a href="edit-post.php?edit=<?php echo $id; ?>"><i class="far fa-edit fa-edit btn btn-primary"></i></a></td>
           <td><a href="allposts.php?del=<?php echo $id; ?>"><i class="fas fa-times fa-del btn btn-danger"></i></a></td>                         
         </tr> 
         <?php } ?>
         </tbody>
       </table>
       <?php }
            else{
              echo "<center><h2>No Posts Available</h2></center>";
            }
       ?>
    </form>
  </div>
 </div>
</div>
<?php include('inc/footer.php'); ?>