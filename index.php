<!-- =======================TOP======================== -->
<?php include('inc/top.php') ?>
<body>
  <?php
// ===================Pagination Function==============
      $number_of_posts = 8;

      if(isset($_GET['page_no'])){

         $page_id = $_GET['page_no'];
      }
      else{

        $page_id = 1;
      }
// ===============Pagination Function by category=========
      if(isset($_GET['cat'])){

        $cat_id = $_GET['cat'];
        $cat_query = "SELECT * FROM categories WHERE id = '$cat_id'";
        $run = mysqli_query($dbcon,$cat_query);
        $row = mysqli_fetch_array($run);
        $cat_name = $row['category'];

      }
// =====================Pagination Function===============
      if(isset($_POST['search'])){
        $search = $_POST['search-title'];
        $p_query = "SELECT * FROM posts WHERE status = 'publish'";
        $p_query .= "and tags LIKE '%$search%'";
    
        $run = mysqli_query($dbcon,$p_query);
        $all_posts = mysqli_num_rows($run);
        $total_pages = ceil($all_posts/$number_of_posts);
        $post_start_point = ($page_id - 1) * $number_of_posts;
      }
      else{
         $p_query = "SELECT * FROM posts WHERE status = 'publish'";
       if(isset($cat_name)){
        $p_query .= "and categories = '$cat_name'";
        }
        $run = mysqli_query($dbcon,$p_query);
        $all_posts = mysqli_num_rows($run);
        $total_pages = ceil($all_posts/$number_of_posts);
        $post_start_point = ($page_id - 1) * $number_of_posts;

      }  
// =================Close  Pagination Function===============
  ?>
<div id="container">
 <!--====================HEADER=========================== -->
<?php include('inc/navbar.php') ?>
   <div class="container-fluid body-section">
<!-- =================Jumbotron====================z0. -->
      <<div class="jumbotron container-fluid w-100">
        <div class="container">
          <div  class="animated fadeInRight">
            <h1>Saten Chauhan CMS Blog Post </span></h1>
            <h5>This is  CMS Blog Post site</h5> 
            </div>
          </div>
       </div>
		  <section>
<!-- Image Slider-->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8">
<?php  
  $slider_query ="SELECT * FROM posts WHERE status='publish' ORDER BY id DESC LIMIT 3";
  $slider_run = mysqli_query($dbcon,$slider_query);
  if(mysqli_num_rows($slider_run) > 0){
      $count = mysqli_num_rows($slider_run);

?>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <?php 
           $x = 0;
         while($row = mysqli_fetch_array($slider_run)){
           $slider_id = $row['id'];
           $slider_image = $row['image'];
           $x = $x + 1;
            if($x == 1){

              echo "<div class='carousel-item active'>";
             }
             else{

              echo "<div class='carousel-item'>";

             }
          ?>
            <a href="post.php?post_id=<?php echo $slider_id; ?>"><img class="d-block w-100" src="./dbpic/<?php echo $slider_image; ?>" alt="First slide"></a>
            </div>
        <?php
              }
            }
          ?>
        </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
           </a>
           <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
           </a>
         </div><br>            
<!-- ======================posts one =====================================-->
 <?php
      if(isset($_POST['search'])){
        $search = $_POST['search-title'];
        $query = "SELECT * FROM posts WHERE status = 'publish'";
        $query .= " and tags LIKE '%$search%'";
        $query .= "ORDER BY id DESC LIMIT $post_start_point,$number_of_posts";

      }else{
         $query = "SELECT * FROM posts WHERE status = 'publish'";
         if(isset($cat_name)){
         $query .= " and categories = '$cat_name'";
         }
         $query .= "ORDER BY id DESC LIMIT $post_start_point,$number_of_posts";
       }
      $run = mysqli_query($dbcon,$query);
      if(mysqli_num_rows($run) > 0){
        while($row = mysqli_fetch_array($run)){
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
      ?> 
<div class="post">
 <div class="row">
   <div class="col-md-2 post-date ">
      <div class="day"><?php echo $day; ?></div>
       <div class="month"><?php echo $month; ?></div>
       <div class="year"> <?php echo $year; ?></div>
         </div>
          <div class="col-md-8 post-title">
           <a href="post.php?post_id=<?php echo $id; ?>"><h3><?php echo ucfirst($title); ?></h3></a>
          <p>Written by : <span><a href="#"><?php echo ucfirst($author); ?></a></span></p>
          </div>
          <div class="col-md-2  profile-picture">
          <img class="w-100" src="./dbpic/<?php echo $author_image; ?>" alt="Profile Picture">
          </div>  
          </div> 
         <a href="post.php?post_id=<?php echo $id; ?>"><img  class="w-100" src="./dbpic/<?php echo $image; ?>" alt="Post image cap"></a>
         <div class="card-body">
          <a href="post.php?post_id=<?php echo $id; ?>"><h4 class="card-title"><?php echo $title; ?> &nbsp; <small><?php echo $tags; ?></small></h4></a>
          <p class="card-text"><?php echo substr($post_data,0,300)."........"; ?></p>
          <a href="post.php?post_id=<?php echo $id; ?>" class="btn btn-primary pull-right">Read More &rarr;</a><br><br>
          <div class="bottom">
          <span ><a href="index.php?cat=<?php echo $id; ?>"><i class="fa fa-folder">&nbsp;<?php echo ucfirst($categories); ?> </i></a></span>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span><a href="post.php?post_id=<?php echo $id; ?>"><i class="fa fa-comment"></i>&nbsp;Comment</a></span>
          </div>
        </div>
       <div class="card-footer text-muted"><b>Posted on :&nbsp;</b><span class="text-primary"><?php echo "$day $month $year"; ?></span>&nbsp;&nbsp; <b>by :</b><a href="#">&nbsp;&nbsp;<?php echo $author; ?></a></div>  
      </div><br>
    <?php
        }

      }
    else{
          echo "<center><h3>No Post Available</h3></center>";
      }
  ?>              
  <!-- ===================Pagination==========================-->
    <div class="container">
      <ul class="pagination float-right" >
       <?php
         if($page_id !=1){
           $previous = $page_id-1;
           echo "<li class='page-item'><a class='page-link' href='index.php?page_no=".$previous."' tabindex='-1'> Previous</a></li>";
          }

         for($x = 1; $x <= $total_pages; $x++){
           echo "<li class='page-item ".($page_id == $x ? 'active':'')."'><a class='page-link' href='index.php?page_no=".$x."&".(isset($cat_name)?"cat=$cat_id":"")."'>".$x."</a></li>";
          }
         
        if($page_id != $total_pages){
          $next = $page_id+1;
           echo "<li class='page-item'><a class='page-link' href='index.php?page_no=".$next."' tabindex='-1'>Next</a></li>";
         }
        ?>

      </ul>
    </div>
  </div>

         
<!--====================== Sidebar-========================= -->

             <?php include('inc/sidebar.php'); ?>

<!-- ===========end of sidebar===============================-->

       
      </div>
     </div>
    </section>
  </div>
<?php include('inc/footer.php') ?>
        