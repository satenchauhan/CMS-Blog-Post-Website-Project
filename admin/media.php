<!-- ================TOP======================= -->
<?php include('inc/top.php');
 $error=""; $msg="";
 
?>
<body>
<div id="container">
<!-- ==============HEADER CONTENTS================== -->
  <?php include("inc/navbar.php"); ?>
      <div class="container-fluid body-section">
         <div class="row">
          <div class="col-md-3">
<!-- ===================SIDEBAR===================== -->
             <?php include("inc/sidebar.php"); ?>
			  </div>
<!-- =========PAGE CONTENTS======================= -->
<div class="col-md-9 dash">
    <h1><i style="color: #013243;" class="fa fa-database static size"></i> Media<small style="font-size: 25px;"> Add or View Files</small></h1><hr>
    <ol class="breadcrumb">
       <li class="breadcrumb-item ft-size"><a href="index.php" class="txt"><i class="fa fa-tachometer-alt static"></i> Dashboard</a></li>
       <li class="breadcrumb-item active ft-size"><i class="fa fa-database static"></i> Media</li>
    </ol><hr>


  <?php
   if (isset($_POST['submit'])) {
     if(count($_FILES['media']['name']) > 0){
        for($i = 0; $i < count($_FILES['media']['name']); $i++){

          $image = $_FILES['media']['name'][$i];
          $tmp_name = $_FILES['media']['tmp_name'][$i];

          $query = "INSERT INTO media (image) VALUES ('$image')";

          if(mysqli_query($dbcon,$query)) {
             move_uploaded_file($tmp_name, "media/$image");
             $msg = "<span class='alert alert-success w-100' style='color:green;'>The files or Image has been added</span>"; 
          }
        }
      }
    }

  ?>


      <div class="row">
       <?php echo $msg; ?><?php echo $error;?>
        <div class="col-sm-4 col-sm-8">
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="file" name="media[]" required multiple>
          <input type="submit" name="submit" class="btn btn-custom btn-sm" value="Add Media">
          </form><hr
        </div>
      </div>

 
    <div class="row">
    <?php

     $image_query = "SELECT * FROM media ORDER BY id DESC";
     $qry_run = mysqli_query($dbcon,$image_query);
     if(mysqli_num_rows($qry_run) > 0){

       while($row =mysqli_fetch_array($qry_run)){

        $image = $row['image'];
    ?>
      <div class="col-lg-2 col-md-3 col-sm-3 col-sm-6 thumb" style="margin-top: 10px;">
         <a href="media/<?php echo $image; ?>" class="thumbnail">
            <img src="media/<?php echo $image; ?>" width="100%" >
         </a>
       </div>
       <?php }

          }
        else{

          $error = "<span class='alert alert-danger w-100' style='color:red;'>The files or image are not added</span>";
          }
        ?>
      </div>
    </div>
  </div>
</div>

<?php include('inc/footer.php'); ?>