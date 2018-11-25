          <div class="col-md-4 sidebar">
            <div class="widgets">
              <div class="card my-4">
                <h5 class="card-header">Search</h5>
                  <div class="card-body">
                    <form action="index.php" method="post">
                      <div class="input-group">
                        <input type="text" name="search-title" class="form-control" placeholder="Search for...">
                          <span class="input-group-btn">
                          <input type="submit" name="search" class="btn btn-primary" value="Go">  
                        </span>
                       </div> <!-- input group -->
                     </form>
                    </div>
                  </div>  
                 </div><!-- wEidgets close -->
            <div class="widgets">
            <div class="card my-4">
            <h3 class="card-header">Popular Post</h3>
             <div class="card-body">
              <div class="row">
               <div class="popular">
 <?php
      $query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY views DESC LIMIT 4";
      $run = mysqli_query($dbcon,$query);
      if(mysqli_num_rows($run) > 0){
        while($row = mysqli_fetch_array($run)){
          $id = $row['id'];
          $title = $row['title'];
          $image = $row['image'];
          $day = date('d');
          $month = date('M');
          $year = date('Y');                                 
        ?>
        <div class="row">
          <div class="col-sm-4" >
            <a href="post.php?post_id=<?php echo $id; ?>"><img src="./dbpic/<?php echo $image; ?>" alt="image1"></a>
          </div>
          <div class="col-sm-8 details" style="margin-top: -7px;">
             <a href="post.php?post_id=<?php echo $id; ?>"><h5><?php echo ucfirst($title); ?></h5></a>
             <p style="color:#24A7CF;;"><i class="fa fa-clock-o"></i>&nbsp;<?php echo "$day $month $year"; ?></p> 
          </div>
        </div><hr>
      <?php }
      }
      else{
        echo "<h3>No Post Available</h3>";
      }
      ?>                                 
      </div>
     </div>
    </div>
   </div>
  </div> <!-- widgets close -->

  <div class="widgets">
    <div class="card my-4">
        <h3 class="card-header">Recent Post</h3>
         <div class="card-body">
          <div class="row">
           <div class="popular">
        <?php
          $query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 4";
          $run = mysqli_query($dbcon,$query);
          if(mysqli_num_rows($run) > 0){
            while($row = mysqli_fetch_array($run)){
              $id = $row['id'];
              $title = $row['title'];
              $image = $row['image'];
              $day = date('d');
              $month = date('M');
              $year = date('Y'); 
                                   
        ?>         
         <div class="row">
          <div class="col-sm-4" >
            <a href="post.php?post_id=<?php echo $id; ?>"><img src="./dbpic/<?php echo $image; ?>" alt="image1"></a>
          </div>
          <div class="col-sm-8 details" style="margin-top: -7px;">
             <a href="post.php?post_id=<?php echo $id; ?>"><h5><?php echo ucfirst($title); ?></h5></a>
             <p style="color:#24A7CF;"><i class="fa fa-clock-o"></i>&nbsp;<?php echo "$day $month $year"; ?></p> 
          </div>
         </div><hr>
      <?php }
      }
      else{
        echo "<h3>No Post Available</h3>";
      }
      ?>                                 
      </div>
     </div>
    </div>
   </div>
  </div> <!--  widgets close -->

    <div class="widgets">
     <div class="card my-4">
      <h3 class="card-header">Categories</h3>
         <div class="card-body">
           <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                <?php
                 $query = "SELECT * FROM categories";
                 $run = mysqli_query($dbcon,$query);
                 if(mysqli_num_rows($run) > 0){

                   $x = 2;

                   while($row = mysqli_fetch_array($run)){
                    $cat_id = $row['id'];
                    $category= $row['category'];

                    $x = $x +1;

                    if(($x % 2) == 1) {
                       echo "<li><a href='index.php?cat=".$cat_id.
                    "'>".(ucfirst($category))."</a></li>"; 
       
                    }
                   
                  }

                }else{
                          echo "<p>No Category Found</p>";
                   }
                ?>
                    </ul>
                  </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                <?php 
                  $query = "SELECT * FROM categories";
                  $run = mysqli_query($dbcon,$query);
                  if(mysqli_num_rows($run) > 0){
                    $x = 2;
                  while($row = mysqli_fetch_array($run)){
                    $cat_id = $row['id'];
                    $category = $row['category'];

                    $x = $x +1;
                    if(($x % 2) == 0) {
                      echo "<li><a href='index.php?cat=".$cat_id.
                    "'>".(ucfirst($category))."</a></li>"; 
                    }
                    
                 }

               }else{
                
                    echo "<p>No Category Found</p>";
                  }
                ?>
                  </ul>
                  </div>
                 </div>
                </div>
              </div>
            </div>
              <div class="widgets social">
                <div class="card my-4" >
                <h5 class="card-header">Social Media</h5>
                <div class="card-body">
                <div class="row">
                <div class="col-sm-4">
                <a  href="https://www.facebook.com"><img class="d-block w-100" src="dbpic/fc.png" alt="facebook"></a>
                </div>
                <div class="col-sm-4">
                 <a href="https://twitter.com"><img class="d-block w-100" src="dbpic/tw.png" alt="twitter"></a>
                 </div>
                 <div class="col-sm-4">
                   <a href="https://www.linkedin.com"><img class="d-block w-100" src="dbpic/lk.png" alt="linkedin"></a>
                 </div>
                  </div>
                  <hr>
                  <div class="row">
                  <div class="col-sm-4">
                    <a href="https://plus.google.com"><img class="d-block w-100" src="dbpic/gp.png" alt="google+"></a>
                  </div>
                  <div class="col-sm-4">
                     <a href="https://www.instagram.com"><img class="d-block w-100" src="dbpic/inst.png" alt="instagram"></a>
                   </div>
                   <div class="col-sm-4">
                 <a href="https://www.pinterest.com"><img class="d-block w-100" src="dbpic/pin.png" alt="pinterest"></a>
                 </div>
                 </div>
                </div>
               </div>
              </div>
             </div>