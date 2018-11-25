<?php require_once('inc/top.php');

if(!isset($_SESSION['username'])){
  header("Location:login.php");
}

$comment_query ="SELECT * FROM comments WHERE status = 'pending'";
$category_query = "SELECT * FROM categories";
$users_query = "SELECT * FROM users";
$posts_query = "SELECT * FROM  posts";

$comment_run = mysqli_query($dbcon, $comment_query);
$category_run = mysqli_query($dbcon, $category_query);
$users_run = mysqli_query($dbcon, $users_query);
$posts_run = mysqli_query($dbcon, $posts_query);

$allcomments = mysqli_num_rows($comment_run);
$allcategory = mysqli_num_rows($category_run);
$allusers = mysqli_num_rows($users_run);
$allposts = mysqli_num_rows($posts_run);


?>
<body>

<div id="container">
<!-- ================HEADER NAVBAR CONTENTS============= -->
  <?php include("inc/navbar.php"); ?>
        <div class="container-fluid body-section">
           <div class="row">
            <div class="col-md-3">
<!-- ==================SIDEBAR===================== -->
             <?php include("inc/sidebar.php"); ?>
             </div>
<!-- ====================PAGE CONTENTS============= -->
          <div class="col-md-9 dash">
            <?php if (isset($_GET['updated'])) { echo "<div class='alert alert-success' style='color:green;'>User has been updated !! </div>"; } ?>
              <h1><i class="fa fa-tachometer-alt"></i> Dashboard <small>Static Overview</small></h1><hr>
               <ol class="breadcrumb">
               <li class="breadcrumb-item active ft-size"><i class="fa fa-tachometer-alt static"></i> Dashboard</li>
             </ol>
            <div class="row tag-boxes">
              <div class="col-md-6 col-lg-3">
                 <div class="panel panel-custom">
                   <div class="panel-heading">
                    <div class="row">
                      <div class="col-md-3">
                      <i class="fa fa-comments fa-4x fa-n"></i>
                      </div>
                      <div class="col-md-9">
                        <div class="text-right size colr"><?php echo $allcomments; ?></div>
                        <div class="text-right colr">New Comments</div>
                      </div>  
                    </div>
                   </div>
                  </div>
                   <a href="comment.php">
                      <div class="panel-footer br-c">
                      <span class="pull-left"><i class="fa fa-arrow-circle-right ft-c"></i></span>
                      <span class="pull-right ft-c">View All Comments</span>
                       <div class="clearfix"></div>
                       </div>
                   </a> 
                 </div>
              <div class="col-md-6 col-lg-3">
                   <div class="panel panel-red">
                     <div class="panel-heading">
                      <div class="row">
                        <div class="col-md-3">
                         <i class="fa fa-file-alt fa-4x fa-n1"></i>
                        </div>
                        <div class="col-md-9">
                       <div class="text-right size red1"><?php echo $allcategory; ?></div>
                      <div class="text-right red2">All Posts</div>
                    </div> 
                   </div>
                  </div>
                 </div>
                  <a href="allposts.php">
                      <div class="panel-footer br-r">
                      <span class="pull-left"><i class="fa fa-arrow-circle-right ft-r"></i></span>
                      <span class="pull-right ft-r">View All Posts</span>
                      <div class="clearfix"></div>
                      </div>
                  </a> 
                </div>
                <div class="col-md-6 col-lg-3">
               <div class="panel panel-yellow">
                 <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-3">
                     <i class="fa fa-users fa-4x fa-n2"></i>
                    </div>
                    <div class="col-md-9">
                      <div class="text-right size txt"> <?php echo $allusers; ?></div>
                      <div class="text-right txt">All Users</div>
                    </div> 
                  </div>
                 </div>
               </div>
                 <a href="user.php">
                      <div class="panel-footer br-y">
                      <span class="pull-left "><i class="fa fa-arrow-circle-right ft-y"></i></span>
                      <span class="pull-right ft-y">View All Users</span>
                      <div class="clearfix"></div>
                   </div>
                 </a> 
                </div>
                <div class="col-md-6 col-lg-3">
               <div class="panel panel-green">
                 <div class="panel-heading">
                  <div class="row">
                    <div class="col-md-3">
                     <i class="fa fa-folder-open fa-4x fa-n3"></i>
                    </div>
                    <div class="col-md-9">
                      <div class="text-right size txt"> <?php echo $allcategory; ?></div>
                      <div class="text-right txt">All Categories</div>
                      </div> 
                      </div>
                     </div>
                    </div>
                      <a href="category.php">
                        <div class="panel-footer br-g">
                        <span class="pull-left"><i class="fa fa-arrow-circle-right ft-g"></i></span>
                        <span class="pull-right ft-g">View All Categories</span>
                        <div class="clearfix"></div>
                      </div>
                    </a> 
               </div>
             </div><hr>
          <?php
            $user_query = "SELECT * FROM users ORDER BY id DESC LIMIT 5";
            $user_run = mysqli_query($dbcon, $user_query);
            if(mysqli_num_rows($user_run) > 0){

            ?>
             <h3>New Users</h3>
             <table class="table table-hover table-bordered table-striped w-100">
                <thead>
                  <tr >
                    <th width="5%">Id</th>
                    <th width="5%">Full Name</th>
                    <th width="5%">Username</th>
                    <th width="5%">Image</th>
                    <th width="5%">Date</th>
                    <th width="5%">Role</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php  
                while($row = mysqli_fetch_array($user_run)){
                  $id = $row['id'];
                  $fname = $row['first_name'];
                  $lname = $row['last_name'];
                  $fullname = "$fname $lname";
                  $uname = $row['username'];
                  $image = $row['image'];
                  $date = $row['joined'];
                  $role = $row['role'];
               ?>
                <tr>
                  <td ><?php echo $id; ?></td>
                  <td><?php echo ucwords($fullname); ?></td>
                  <td><?php echo ucfirst($uname); ?></td>
                  <td><img src="../dbpic/<?php echo $image; ?>" width="80px;"></td>
                  <td><?php echo $date; ?></td>
                  <td><?php echo ucfirst($role); ?></td>
                </tr>
                <?php } ?>
                </tbody>
              </table>
              <a href="user.php" class="btn btn-custom">&nbsp;View All Users</a><hr>
              <?php } ?>
           <?php
            $post_query = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
            $post_run = mysqli_query($dbcon, $post_query);
            if(mysqli_num_rows($post_run) > 0){

            ?>
              <h3>New Posts</h3>
              <table class="table table-hover table-bordered table-striped table-custom">
                 <thead>
                 <tr>
                   <th>Sr #</th>
                   <th>Post Title</th>
                   <th>Author</th>
                   <th>Category</th>
                   <th>Image</th>
                   <th>Date</th>
                   <th>Views</th>
                 </tr>
                 </thead>
                 <tbody>
                <?php  
                while($row = mysqli_fetch_array($post_run)){

                 $id = $row['id'];
                 $title = $row['title'];
                 $author = $row['author'];
                 $cat = $row['categories'];
                 $image = $row['image'];
                 $date =  $row['date'];
                 $views = $row['views'];
                  
               ?>
                 <tr>
                   <td><?php echo $id; ?></td>
                   <td><?php echo ucfirst($title); ?></td>
                   <td><?php echo ucfirst($author); ?></td>
                   <td><?php echo ucfirst($cat); ?></td>
                   <td><img src="../dbpic/<?php echo $image; ?>" width="80px;"></td>
                   <td><?php echo $date; ?></td>
                   <td><i class="fa fa-eye static "></i>&nbsp;<?php echo $views; ?></td>
                 </tr>
                 <?php } ?>
                 </tbody>
                 </table>
                 <a href="allposts.php" class="btn btn-custom">View All Posts</a>
                <?php } ?>
             </div>
            </div>            
          </div>
<?php include('inc/footer.php'); ?>
           
 
