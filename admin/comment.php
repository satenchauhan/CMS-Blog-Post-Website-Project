<!-- ===================TOP======================== -->
<?php include('inc/top.php');
if (!isset($_SESSION['username'])) {
   header("Location:login.php");
}

if(isset($_SESSION['username']) && $_SESSION['role'] == 'author') {
   header("Location:index.php");
}

$session_username =$_SESSION['username'];

$msg=""; $error="";

if(isset($_GET['del'])){
  $del_id = $_GET['del'];
  $del_check_sql ="SELECT * FROM comments WHERE id='$del_id'";
  $check_run =mysqli_query($dbcon,$del_check_sql);
  if(mysqli_num_rows($check_run) > 0){
     $del_sql = "DELETE FROM comments WHERE id='$del_id'";
     if(isset($_SESSION['username']) && ($_SESSION['role']) == 'admin'){
         if(mysqli_query($dbcon,$del_sql)){
            $msg ="<div class='alert alert-success' style='color:green;'>Comment has been deleted</div>";
         }else{
            $error ="<span class='alert alert-danger w-100' style='color:red;'>Comment has not been deleted </span>";
         }
     }

  }else{

     header("Location:index.php");
   }

}

if(isset($_GET['approve'])){
  $approve_id = $_GET['approve'];
  $approve_sql ="SELECT * FROM comments WHERE id='$approve_id'";
  $approve_run =mysqli_query($dbcon,$approve_sql);
  if(mysqli_num_rows($approve_run) > 0){
     $approve_sql = "UPDATE comments SET status='approved' WHERE id='$approve_id'";
     if(isset($_SESSION['username']) && ($_SESSION['role']) == 'admin'){
         if(mysqli_query($dbcon,$approve_sql)){
            $msg ="<div class='alert alert-success' style='color:green;'>Comment has been approved</div>";
         }else{
            $error ="<span class='alert alert-danger w-100' style='color:red;'>Comment has not been unapproved</span>";
         }
     }

  }else{

     header("Location:index.php");
   }

}

if(isset($_GET['unapprove'])){
  $unapprove_id = $_GET['unapprove'];
  $unapprove_sql ="SELECT * FROM comments WHERE id='$unapprove_id'";
  $unapprove_run =mysqli_query($dbcon,$unapprove_sql);
  if(mysqli_num_rows($unapprove_run) > 0){
     $unapprove_sql = "UPDATE comments SET status='unapproved' WHERE id='$unapprove_id'";
     if(isset($_SESSION['username']) && ($_SESSION['role']) == 'admin'){
         if(mysqli_query($dbcon,$unapprove_sql)){
            $msg ="<div class='alert alert-danger' style='color:red;'>Comment has been approved</div>";
         }else{
            $error ="<span class='alert alert-danger w-100' style='color:red;'>Comment has not been unapproved</span>";
         }
     }

  }else{

     header("Location:index.php");
   }

}

if(isset($_GET['reply'])){
  $reply_id = $_GET['reply'];
  $reply_sql ="SELECT * FROM comments WHERE post_id='$reply_id'";
  $reply_run =mysqli_query($dbcon,$reply_sql);
  if($row=mysqli_num_rows($reply_run) > 0){
     $reply_sql = "UPDATE comments SET status='replied' WHERE post_id='$reply_id'";
     if(isset($_SESSION['username']) && ($_SESSION['role']) == 'admin'){
         if(mysqli_query($dbcon,$reply_sql)){
            $msg ="<div class='alert alert-success' style='color:green;'>Comment has been replied</div>";
         }else{
            $error ="<span class='alert alert-danger w-100' style='color:red;'>Comment is not replied </span>";
         }
      }


  }else{

     header("Location:index.php");
   }

}


if (isset($_POST['checkboxes'])) {

   foreach ($_POST['checkboxes'] as $user_id){
         $select_option = $_POST['select_option'];

      if($select_option =='delete'){
          $del_query= "DELETE FROM comments WHERE id='$user_id'";
          mysqli_query($dbcon, $del_query);
          $msg ="<div class='alert alert-success' style='color:green;'>Comment has been deleted</div>";

       }elseif ($select_option == 'approve') {
          $apv_sql ="UPDATE comments SET status ='approved' WHERE id='$user_id' ";
          mysqli_query($dbcon,$apv_sql);
          $msg ="<div class='alert alert-success' style='color:green;'>Comment has been approved</div>";
       }elseif ($select_option == 'pending') {
          $unapv_sql ="UPDATE comments SET status ='unapproved' WHERE id='$user_id'";
          mysqli_query($dbcon,$unapv_sql);
       }  $msg ="<div class='alert alert-success' style='color:green;'>Comment has been approved</div>";
   }
}

?>
<body>
<div id="container">
<!-- ==============HEADER NAVBAR CONTENTS================ -->
<?php include("inc/navbar.php"); ?>
 <div class="container-fluid body-section">
   <div class="row">
     <div class="col-md-3">
      <?php include("inc/sidebar.php"); ?>
     </div>
<!-- ================PAGE CONTENTS===================== -->
    <div class="col-md-9 dash">
         <h1><i style="color: #013243;" class="fa fa-comments static size"></i> Comments<small style="font-size: 25px;">  View All Comments</small></h1><hr>
         <ol class="breadcrumb">
           <li class="breadcrumb-item ft-size"><a href="#" class="txt"><i class="fa fa-tachometer-alt static" ></i> Dashboard</a></li>
           <li class="breadcrumb-item active ft-size"><i class="fa fa-comments static"></i> Comments</li>
         </ol>

<!-- =================== -->
   <?php
   $cmsg=""; $cerror="";
    if (isset($_GET['reply'])) {
      $rep_id = $_GET['reply'];
      $sql ="SELECT * FROM comments WHERE post_id ='$rep_id'";
      $run =mysqli_query($dbcon,$sql);
        if($row=mysqli_num_rows($run) > 0){
           
          if (isset($_POST['reply'])) {
            
            $country = mysqli_real_escape_string($dbcon,ucfirst($_POST['country']));
            $comment = mysqli_real_escape_string($dbcon,ucfirst($_POST['comment']));

            if(empty($comment)){
            
               $cerror ="<span class='alert alert-danger w-100' style='color:red;'>Comment reply filed can not be empty !!</span>";
            }else{
               $session_username = ucfirst($_SESSION['username']);
               $fetch_user_data_sql ="SELECT * FROM users WHERE username ='$session_username'";
               $run = mysqli_query($dbcon,$fetch_user_data_sql);
               $row= mysqli_fetch_array($run);
               $fname = $row['first_name'];
               $lname = $row['last_name'];
               $fullname = $fname." ".$lname;
               $email = $row['email'];
               $image = $row['image'];
              $date =  date('d-m-y');

               $insert_sql="INSERT INTO comments (name, username, post_id, email, country, comment, status, image, date) VALUES('$fullname', '$session_username', '$rep_id', '$email', '$country', '$comment', 'pending','$image','$date')";
               if ($run=mysqli_query($dbcon,$insert_sql)) {
                  
                  $cmsg ="<span class='alert alert-success w-100' style='color:green;'>Comment has been replied</span>";
                  //header("Location:comment.php?cmsg");
               }else{
                  $cerror ="<span class='alert alert-danger w-100' style='color:red;'>Reply comment is failed</span>";
               }
            }
            
          }
       ?>
         <div class="row">
           <div class="col-sm-12 col-sm-8 col-md-6 col-lg-6">
            <center><?php echo $cmsg;  ?><?php echo $cerror; ?></center>
             <form action="" method="POST">
              <div class="form-group">
               <label for="country"><b>Country :</b></label>
               <input type="text" name="country" id="country" rows="10" placeholder="Please your country name" class="form-control">
              </div>
              <div class="form-group">
               <label for="comment"><b>Comment :</b></label>
               <textarea  name="comment" id="comment" rows="10" placeholder="Your Comment Here" class="form-control"></textarea>
              </div>
             <input type="submit" name="reply" class="btn btn-custom" value="Reply">
            </form>
            </div>
           </div>
          <hr>
      <?php   
            }
         }
//================
      $query = "SELECT * FROM comments ORDER BY id DESC";
      $run = mysqli_query($dbcon,$query);
        if(mysqli_num_rows($run) > 0){
    ?>
      <form action="" method="POST">
         <div class="row">
           <div class="col-sm-8">
             <div class="row">
              <div class="col-sm-4">
                <div class="form-group">
                 <select name="select_option" id="" class="form-control">
                  <option value="delete">Delete</option>
                  <option value="approve">Approve</option>
                  <option value="pending">Unapprove</option>
                 </select>
                </div>
               </div>
              <div class="col-sm-8">
             <input type="submit" class="btn btn-custom" name="submit" value="Apply">
             </div>
            </div>
           </div>
          </div>
           <center><?php echo $msg;  ?><?php echo $error; ?></center>
          <div><span class="float-left">Click on below&nbsp;<i class="fa fa-check btn btn-info btn-sm"></i>&nbsp;For Comment approve&nbsp;&nbsp;&nbsp;&nbsp; OR&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle btn btn-danger btn-sm"></i>&nbsp;For Comment  unapprove&nbsp;&nbsp;&nbsp;&nbsp;OR &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-reply btn btn-success btn-sm"></i>&nbsp;&nbsp;For Comment reply  </span></div>
          
          <table class="table table-hover table-bordered table-striped table-custom">
          <thead>
          <tr align="center">
          <th><input type="checkbox" id="selectallboxes"></th>
          <th>Id</th>
          <th>Date</th>
          <th>Name</th>
          <th>Username</th>
          <th>Comments</th>
          <th >Status</th>
          <th>Approve</th>
          <th>Unapprove</th>
          <th>Reply</th>
          <th>Delete</th>
          </tr>
          </thead>
          <tbody>
          <?php
          while ($row=mysqli_fetch_array($run)) {
            $id = $row['id'];
            $date = $row['date'];
            $name = $row['name'];
            $username = $row['username'];
            $comment = $row['comment'];
            $post_id = $row['post_id'];
            $status = $row['status'];
          ?>
           <tr>
             <td><input type="checkbox" class="checkboxes" name="checkboxes[]" value="<?php echo $id; ?>"></td>
             <td><?php echo $id; ?></td>
             <td width="15%"><?php echo $date; ?></td>
             <td><?php echo ucfirst($name); ?></td>
             <td><?php echo ucfirst($username); ?></td>
             <td><?php echo ucfirst($comment); ?></td>
             <td align="center" style="color:<?php if($status =='approved' || $status =='replied'){echo 'green';}elseif($status =='pending' || 'unapproved'){ echo 'red'; } ?>">
              <?php echo ucfirst($status); ?> 
              </td>
             <td align="center"><a href="comment.php?approve=<?php echo $id; ?>"><i class="fa fa-check btn btn-info"></i></a></td>
             <td align="center"><a href="comment.php?unapprove=<?php echo $id;?>"><i class="fa fa-times-circle btn btn-danger"></i></a></td>
             <td><a href="comment.php?reply=<?php echo $post_id; ?>"><i class="fa fa-reply btn btn-success"></i></a></td>
             <td><a href="comment.php?del=<?php echo $id;?>"><i class="fas fa-times fa-del btn btn-danger"></i></a></td>
           </tr>
           <?php } ?>                      
          </tbody>
        </table>
        <?php }
              else{
            echo "<center><h2>No Comments Available</h2></center>";
           } 
        ?>
        </form>
    </div>
 </div>
</div>

              
  <!-- ==========================FOOTER============================================  -->
 <?php include("inc/footer.php"); ?>

