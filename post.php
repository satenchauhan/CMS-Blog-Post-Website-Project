<!-- =======================TOP=========================== -->
<?php include('inc/top.php') ?>
<body>
<div id="container">
 <!--======================HEADER========================= -->
<?php include('inc/navbar.php') ?>
   <div class="container-fluid body-section">
 <?php
 
//$post_id = $_GET['post_id'];
  
    $query = "SELECT * FROM posts WHERE  status= 'publish' ORDER BY id  DESC";
    $run = mysqli_query($dbcon,$query);
    if(mysqli_num_rows($run) > 0){
      $row = mysqli_fetch_array($run);
        $id = $row['id'];
        $day = date('d');
        $month = date('M');
        $year = date('Y');
        $title = $row['title'];
        $author = $row['author'];
        $author_image = $row['author_image'];
        $image = $row['image'];
        $categories = $row['categories'];
        $tags = $row['tags'];
        $post_data = $row['post_data'];
        $views = $row['views'];
        $status = $row['status'];   

        }
        else{
          echo "No Post Available";
        }
  
      ?>
<!-- =================Jumbotron==============================z0. -->
     <div class="jumbotron container-fluid w-100">
        <div class="container">
          <div id="details" class="animated fadeInRight">
            <h1>Custom<span> Post</span></h1>
            <h5>This is my social network  site</h5> 
            </div>
          </div>
       </div>
      <section>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">              
              <!--==========================Contact form========================= -->
              <div class="post">
                <div class="row">
                 <?php
                 if(isset($_GET['post_id'])){
                  $post_id = $_GET['post_id'];

                  $views_qry = "UPDATE `posts` SET `views` = views + 1 WHERE `posts`.`id` = '$post_id'";
                  mysqli_query($dbcon,$views_qry);
                  
                  $query = "SELECT * FROM posts WHERE status = 'publish'";
                  $query.= "and id = $post_id";

                  $run = mysqli_query($dbcon,$query);
                  if(mysqli_num_rows($run) > 0){
                    $row = mysqli_fetch_array($run);
                    $id = $row['id'];
                    $day = date('d');
                    $month = date('M');
                    $year = date('Y');  
                    $title = $row['title'];
                    $author = $row['author'];
                    $author_image = $row['author_image'];
                    $image = $row['image'];
                    $categories = $row['categories'];
                    $tags = $row['tags'];
                    $post_data = $row['post_data'];
                    $views = $row['views'];
                    $status = $row['status'];   

                  }
                  else{
                    header('Location:index.php');
                  }
                }
                ?>
                <div class="col-md-2 post-date">
                  <div class="day"><?php echo $day; ?></div>
                  <div class="month"><?php echo ucfirst($month); ?></div>
                  <div class="year"> <?php echo $year; ?></div>
                </div>
                <div class="col-md-8 post-title">
                  <a href="post.php?post_id=<?php echo $id; ?>"><h3><?php echo ucfirst($title); ?></h3></h3></a>
                  <p>Written by : <span><?php echo ucfirst($author); ?></span></p>
                </div>
                <div class="col-md-2  profile-picture">
                  <img class="w-100" src="./dbpic/<?php echo $author_image; ?>" alt="Profile Picture">
                </div>  
              </div> 
              <a href="./dbpic/<?php echo $image; ?>"><img  class="w-100" src="./dbpic/<?php echo $image; ?>" alt="Post image cap"></a>
              <div class="card-body">
                <h4 class="card-title"><?php echo $title; ?> &nbsp; <small><?php echo $tags; ?></small></h4></a>
                <p class="card-text"><?php echo ucfirst($post_data); ?></p><br>
                <div class="bottom">
                  <span ><a href=""><i class="fa fa-folder"> <?php echo ucfirst($categories); ?> </i></a></span>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  <span><a href="#comment"><i class="fa fa-comment"></i>&nbsp;Comment</a></span>
                </div>
              </div>
              <div class="card-footer"><b>Posted on :&nbsp;</b><span class="text-primary"><?php echo "$day $month $year"; ?></span>&nbsp;&nbsp;
                <b>by :</b><a href="#">&nbsp;&nbsp;<?php echo $author; ?></a>
              </div>   
            </div><br>
            <div class="card my-4 related-post">
              <h3 class="card-header">Related Posts</h3><br>
              <div class="row">
                <?php
                $query ="SELECT * FROM posts WHERE status = 'publish'AND title LIKE '%$title%' LIMIT 3";
                $run = mysqli_query($dbcon,$query);
                while($row = mysqli_fetch_array($run)){
                  $id = $row['id'];
                  $title = $row['title'];
                  $image = $row['image'];
                  ?>
                  <div class="col-sm-4">
                    <a href="post.php?post_id=<?php echo $id; ?>"><img class="w-100" src="./dbpic/<?php echo $image; ?>" alt="slider 1">
                      <center><h6><?php echo $title; ?></h6></center>
                    </a>
                  </div>
                <?php } ?>             
              </div>
            </div><br>

            <div class="author">
              <h3 class="card-header">Author Post</h3><br>
              <div class="row">
                <div class="col-sm-4">
                  <img class="w-100" src="./dbpic/<?php echo $author_image; ?>" alt="Author Image">
                </div>
                <div class="col-sm-8">
                  <h5><?php echo ucfirst($author); ?></h5>
                  <p><?php echo $post_data; ?></p>
                </div>
              </div>
            </div><br>
            <?php
            if(isset($_GET['post_id'])){
              $post_id = $_GET['post_id'];
              $query = "SELECT * FROM comments WHERE status = 'approved' or status='replied' or  post_id ='$post_id' ORDER BY id DESC LIMIT 3";
              $run = mysqli_query($dbcon,$query);
              if (mysqli_num_rows($run) > 0) {
                ?>
                <div class="comment" id="comments">
                  <h3 class="card-header">Comments</h3><br>
                  <?php
                  while($row=mysqli_fetch_array($run)){
                   $c_id = $row['id'];
                   $c_name = $row['name'];
                   $c_username = $row['username'];
                   $c_image = $row['image'];
                   $c_comment = $row['comment'];
                   ?>
                   <div class="row">
                    <div class="col-sm-4">
                      <img class="w-50" src="dbpic/<?php echo $image; ?>" alt="Comment Image">
                    </div>
                    <div class="col-sm-8">
                      <h5><?php echo ucfirst($c_name); ?></h5>
                      <p><?php echo ucfirst($c_comment); ?></p>
                      <span class="float-right"><b>Comment by :</b>&nbsp;&nbsp;<a href=""><smal><?php echo ucfirst($c_username); ?></smal></a></span>
                    </div>  
                  </div><hr>
                <?php } ?>
              </div><br>
            <?php }  } ?>
            <?php
            
            $emsg =""; $error="";  $msg="";

            if(isset($_POST['submit'])){
              $comment_date = date('d-m-y H:i:s');
              $comment_name = mysqli_real_escape_string($dbcon,ucwords($_POST['name']));
              $comment_email = mysqli_real_escape_string($dbcon,$_POST['email']);
              $comment_country = mysqli_real_escape_string($dbcon,ucfirst($_POST['country']));
              $comment = mysqli_real_escape_string($dbcon,ucfirst($_POST['comment']));
              if(empty($comment_name) or empty($comment_email) or empty($comment_country) or empty($comment)){
                $error = "<div class='alert alert-danger w-100' style='color:red;'>All (*) Fielsd are Required</div>";

              }else if(!filter_var($comment_email, FILTER_VALIDATE_EMAIL)){
                 $emsg = "<span style='color:red;'>Please enter valid e-mail address !!</span>";
              }else{
                 
                $cs_query = "INSERT INTO comments (id, name, username, post_id, email, country, comment, status, image, date) VALUES (NULL, '$comment_name', 'Guest user','$post_id', '$comment_email', '$comment_country', '$comment', 'pending','$image','$comment_date')";
                if($run = mysqli_query($dbcon,$cs_query)){
                  //header("Location:post.php");
                       $comment_name ="";
                       $comment_email ="";
                       $comment_country ="";
                       $comment ="";
                  $msg ="<div class='alert alert-success w-100' style='color:green;'>Comment has been submitted ! Waiting for Approval</div>";

                }else{

                  $error ="<div class='alert alert-danger w-100' style='color:red;'>Comment has not submitted</div>";
                }
              }
            }
            ?>
            <div class="comment-box"  id="comment">
             <div class="row">
               <div class="col-sm-12">
                 <h3 class="card-header">Comment Here</h3><br>
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="name">Full Name*:</label>
                    <input type="text" id="name" value="<?php if(isset($comment_name)){echo ucfirst($comment_name);} ?>" class="form-control" name="name" placeholder="Enter Full Name">
                  </div>
                  <div class="form-group">
                   <label for="email">E-mail*:</label>
                   <input type="email" id="email" value="<?php if(isset($comment_email)){echo $comment_email;} ?>" class="form-control" name="email" placeholder=" Enter E-mail Address">
                   <?php echo  $emsg; ?>
                 </div>
                 <div class="form-group">
                  <label for="country">Country*:</label>
                  <input type="text" id="country" value="<?php if(isset($comment_country)){echo $comment_country;} ?>"  class="form-control" name="country" placeholder="Enter country">
                </div>
                <div class="form-group">
                  <label for="comment">Comment*:</label>
                  <textarea id="message" cols="30" rows="10" class="form-control" name="comment" placeholder="Write Your Message Here"><?php if(isset($comment)){echo $comment;} ?></textarea>
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary"><br><br>
                <center><?php echo $error; ?><?php echo $msg;?></center>
                 
              </form>
            </div>
          </div>
        </div><br><br>
      </div>
      <!--================== Sidebar-================== -->

      <?php include('inc/sidebar.php'); ?>

      <!-- ===========end of sidebar==================-->

    </div>
  </div>    
</section>
       </div>   
<!--==================-Footer=================-->
<?php include('inc/footer.php') ?>