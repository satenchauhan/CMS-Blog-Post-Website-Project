
<!-- ================TOP======================= -->
<?php require_once('inc/top.php');
if(!isset($_SESSION['username'])){
  header('Location: login.php');
}

$error=""; $msg=""; $msg1=""; $msg2=""; $msg3=""; $msg4=""; $title=""; $post_data=""; $tags="";

 $session_username = $_SESSION['username'];
 $session_role = $_SESSION['role'];
 $session_author_image = $_SESSION['author_image'];

 if(isset($_GET['edit'])){
    $edit_id = $_GET['edit'];
    if($session_role == 'admin'){
       $edit_query = "SELECT * FROM posts WHERE id = '$edit_id'";
       $edit_run = mysqli_query($dbcon, $edit_query);
     }
    else if($session_role == 'author'){
       $edit_query = "SELECT * FROM posts WHERE id = $edit_id and author ='$session_role'";
       $edit_run = mysqli_query($dbcon, $edit_query);
       } 
    if(mysqli_num_rows($edit_run) > 0){
       $edit_row = mysqli_fetch_array($edit_run);
       $title = $edit_row['title'];
       $post_data = $edit_row['post_data'];
       $tags = $edit_row['tags'];
       $image = $edit_row['image'];
       $status = $edit_row['status'];
       $cate = $edit_row['categories'];
   }
  
else {

  header('Location: index.php');
 }

}

?>
<body>
<div id="container">
<!-- ===========HEADER NAVBAR CONTENTS=========== -->
  <?php include("inc/navbar.php"); ?>
        <div class="container-fluid body-section">
           <div class="row">
            <div class="col-md-3">
             < <?php include("inc/sidebar.php"); ?>
            </div>
<!-- ===============PAGE CONTENTS================ -->
<div class="col-md-9 dash">
 <h2><i class="fa fa-edit size" style="color: #013243;"></i> Edit Post<small> Edit Post Details</small></h2><hr>
 <ol class="breadcrumb">
    <li class="breadcrumb-item ft-size"><a href="index.php"><i class="fa fa-tachometer-alt static"></i> Dashboard</a></li>
    <li class="breadcrumb-item active ft-size"><i class="fa fa-edit" style="color: #013243;"></i> Edit Post</li>
 </ol> 
<?php
if(isset($_POST['submit'])){
    $post_date = date('d-m-y H:i:s');
    $title = mysqli_real_escape_string($dbcon,ucfirst($_POST['title']));
    $post_data = mysqli_real_escape_string($dbcon,ucfirst($_POST['post_data']));
    $cate = $_POST['categories'];
    $tags = mysqli_real_escape_string($dbcon,ucfirst($_POST['tags'])); 
    $status = $_POST['status'];
    $post_image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $imageSize   =  $_FILES['image']['size'];

    if(empty($post_image)){

        $post_image = $image; 
    }


        if(empty($title)){
           $msg1 ="<span class='float-right' style='color:red;'>Please enter title name ! Required !!</span>";
        }else if(empty($post_data)){
           $msg3 ="<span class='float-right' style='color:red;'>Please write some infomation ! Required !!</span>";
        }elseif ($imageSize > 2000000) {
           $error = "<div class='alert alert-danger' style='color:red;'>You image is too bid size !!</div>";
        }elseif(empty($tags)){
           $error ="<div class='alert alert-danger' style='color:red;'>Please enter tags name ! Required !!</div>";
        }else{
          $update_query = "UPDATE posts  SET title ='$title', image ='$post_image', categories ='$cate', tags ='$tags', post_data ='$post_data', status ='$status', date='$post_date' WHERE id = '$edit_id'";
          if($run =mysqli_query($dbcon,$update_query)){
              move_uploaded_file( $tmp_name, "../dbpic/$post_image");
              $msg = "<div class='alert alert-success' style='color:green;'>Post has been updated!!</div>";
              //header("Location:allposts.php");
                  $title = ""; 
                  $post_data ="";
                  $cate ="";
                  $tags ="";
                  $status ="";
          }else{
              $error="<div class='alert alert-success' style='color:green;'>Post is not updated !!</div>";
          }
      }
  }
?>

<div class="row">
  <div class="col-sm-12">
     <center><?php echo $msg; ?><?php echo $error;?></center>
    <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title"><b>Title</b></label>
        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Post Title here" class="form-control" value="">
        <?php echo $msg1; ?><?php echo $msg2; ?>  
      </div>
      <div class="form-group">
        <a href="media.php" class="btn btn-custom">Add Media</a>
      </div>
      <div class="form-group">
        <label for="post_data"><b>Witer Here :</b></label>
         <?php echo $msg3; ?>
        <textarea name="post_data" id="textarea" rows="10" class="form-control"  placeholder="Please Type Here "><?php echo $post_data; ?></textarea>
       
       </div>
      <div class="row">
          <div class="col-sm-6">
           <div class="form-group">
            <label for="file"><b>Post Image :</b></b></label><br>
            <input type="file" name="image">  
          </div>
      </div><br>
      <div class="col-sm-6">
         <div class="form-group">
          <label for="categories"><b>Categories :</label>
          <select class="form-control" name="categories" id="categories">
<!-- ==================Categoris function on post page=========== -->
       <?php
        $cate_sql = "SELECT * FROM categories ORDER BY id DESC"; 
        $run = mysqli_query($dbcon,$cate_sql);
        if (mysqli_num_rows($run) > 0) {

          while($row = mysqli_fetch_array($run)){
              $cate_id = $row['id'];
              $cat_name = $row['category'];

  
            echo "<option value='".$cat_name."' ".((isset($cate) and $cate == $cat_name)?"selected":"").">".ucfirst($cat_name);"</option>";
  
         }
           
        }else{

          echo "<center><h4>No Category<h/4></center>";
        }
        ?>
          </select>
        </div>
      
      </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
           <div class="form-group">
            <label for="tags"><b>Tags :</b></label><br>
            <input type="text" name="tags" class="form-control" value="<?php echo $tags; ?>" placeholder="Please enter tags name ">
            </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
           <label for="status"><b>Status :</b></label>
            <select class="form-control" name="status" id="status">
            <option value="publish" <?php if(isset($status) and $status = 'publish'){ echo "selected";} ?>>Publish</option>
              <option value="draft" <?php if(isset($status) and $status = 'draft'){ echo "selected";} ?>>Draft</option>
            </select>
          </div>
        </div>
      </div>
     <input type="submit" name="submit" class="btn btn-custom" value="Update Post">
      </form>  
     </div>   
    </div>
   </div>
  </div>
</div>
   <!-- =====================FOOTER================================ -->
      <?php include('inc/footer.php'); ?>