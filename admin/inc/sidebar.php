<!-- =============ADMIN SIDEBAR=============== -->
<?php
$session_role1 = $_SESSION['role'];

$comment_sql = "SELECT * FROM comments WHERE status='pending'";
$run= mysqli_query($dbcon,$comment_sql);
$comments = mysqli_num_rows($run);
$comment_qry = "SELECT * FROM comments WHERE status='unapproved'";
$run= mysqli_query($dbcon,$comment_qry);
$comment_unap = mysqli_num_rows($run);

?>
	<div class="list-group">
	    <a href="index.php" class="list-group-item" style="background: #013243; color:#fff; font-size: 20px;"><i class="fa fa-tachometer-alt color-white" ></i>&nbsp;Dashboard</a>
	    <a href="allposts.php" class="list-group-item list-group-item-action"><i class="fas fa-file-alt"></i>&nbsp;All Posts</a>
	    <a href="media.php" class="list-group-item list-group-item-action"><i class="fas fa-database" style="color:#013243;"></i>&nbsp;Media</a>
	 <?php
	 	if($session_role1 =='admin'){
	 		
	 ?>
	    <a href="comment.php" class="list-group-item list-group-item-action">
	   <?php if($comments > 0){echo "<span class='badge btn btn-danger'>$comments</span>";} ?>
	   <?php if($comment_unap > 0){echo "<span class='badge btn btn-danger'>$comment_unap</span>";} ?>
	    <i class="fas fa-comment"></i>&nbsp;Comments</a>
	    <a href="category.php" class="list-group-item list-group-item-action"><i class="fas fa-folder-open"></i>&nbsp;Categories</a>
	    <a href="user.php" class="list-group-item list-group-item-action "><i class="fas fa-users"></i>&nbsp;Users</a> 
	  <?php } ?>    
	</div>