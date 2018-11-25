<!-- ====================TOP========================== -->
<?php include('inc/top.php');

$error=""; $msg=""; $msg1=""; $msg2=""; $msg3=""; $msg4=""; $title=""; $post_data=""; $tags="";



$session_username = $_SESSION['username'];

$session_image = $_SESSION['author_image'];


?>
<body>
<div id="container">
<!-- ================HEADER NAVBAR CONTENTS================ -->
  <?php include("inc/navbar.php"); ?>
        <div class="container-fluid body-section">
           <div class="row">
            <div class="col-md-3">
             <?php include("inc/sidebar.php"); ?>
  			   </div>
<!-- ===============PAGE CONTENTS=================== -->
<div class="col-md-9 dash">
<h1><i style="color: #013243;" class="fa fa-plus-square"></i> Add Post<small style="font-size: 25px;"> Add New Post</small></h1><hr>
 <ol class="breadcrumb">
   <li class="breadcrumb-item ft-size"><a href="index.php" class="txt"><i class="fa fa-tachometer-alt static"></i> Dashboard</a></li>
   <li class="breadcrumb-item active ft-size"><i class="fa fa-plus-square static"></i> Add Post</li>
 </ol>
<?php

if(isset($_POST['submit'])){
        $post_date = date('d-m-y H:i:s');
        $title = mysqli_real_escape_string($dbcon,ucwords($_POST['title']));
        $post_data = mysqli_real_escape_string($dbcon,ucfirst($_POST['post_data']));
        $cate = $_POST['categories'];
        $tags = mysqli_real_escape_string($dbcon,ucwords($_POST['tags'])); 
        $status = $_POST['status'];
        $post_image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $imageSize   =  $_FILES['image']['size'];

        if(empty($title)){
           $msg1 ="<span class='float-right' style='color:red;'>Please enter title name ! Required !!</span>";
        }else if(empty($post_data)){
           $msg3 ="<span class='float-right' style='color:red;'>Please write some infomation ! Required !!</span>";
        }elseif(empty($post_image)){
           $error ="<div class='alert alert-danger' style='color:red;'>Please upload image ! Required !!</div>";
        }elseif ($imageSize > 2000000) {
           $error = "<div class='alert alert-danger' style='color:red;'>You image is too bid size !!</div>";
        }elseif(empty($tags)){
           $error ="<div class='alert alert-danger' style='color:red;'>Please enter tags name ! Required !!</div>";
        }else{
          $insert_query ="INSERT INTO posts (title, author, author_image, image, categories,tags,post_data,views,status,date ) VALUES ('$title','$session_username','$session_image','$post_image','$cate','$tags','$post_data','0','$status','$post_date')";
          if($run =mysqli_query($dbcon,$insert_query)){
              move_uploaded_file( $tmp_name, "../dbpic/$post_image");
              $msg = "<div class='alert alert-success' style='color:green;'>Post has been added !!</div>";
                          $title = ""; 
                          $post_data ="";
                          $cate ="";
                          $tags ="";
                          $status ="";
                       

          }else{
              $error="<div class='alert alert-success' style='color:green;'>Post is not submitted !!</div>";
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
        <textarea name="post_data" id="textarea" rows="10" class="form-control"  placeholder="Please Type Here "><?php echo $post_data; ?></textarea>
        <?php echo $msg3; ?> <?php echo $msg4; ?>
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
      <input type="submit" name="submit" class="btn btn-custom" value="Submit Post">
    </form>  
  </div>   
  </div>
  </div>
  </div>
  </div>
  <?php include('inc/footer.php'); ?>