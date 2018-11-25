<!-- =================TOP================== -->
<?php include('inc/top.php') ?>
<body>
<div id="container">
 <!--=======================HEADER===================== -->
<?php include('inc/navbar.php') ?>
   <div class="container-fluid body-section">
<!-- =================Jumbotron==================z0. -->
      <div class="jumbotron container-fluid w-100">
        <div class="container">
          <div id="details" class="animated fadeInRight">
            <h1>Contact us</span></h1> 
            </div>
          </div>
       </div>
    <section>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">              
<!--================Contact form================ -->
             <div class="col-md-12 map">
              <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyB8hPx2KmF4i7S1V-GQefFzf2xOwGshj1U'></script><div style='overflow:hidden;height:400px;width:100%;'><div id='gmap_canvas' style='height:400px;width:100%;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='http://maps-generator.com/it'>Find way</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=6cca73b87bf018ecff72628d452350e2302e43a4'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(43.7724351,11.252140899999972),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(43.7724351,11.252140899999972)});infowindow = new google.maps.InfoWindow({content:'<strong>Saten Giorgio La Pira</strong><br>Via Dei Pescioni 3<br>50123 firenze<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
            </div><br>
             <div class="col-md-12 contact-form">
          <?php
           $error=""; $msg=""; $emsg="";
            if(isset($_POST['submit'])){
               // $id = $_POST['id'];
              $date = date('d-m-y H:i:s');
              $fullname = mysqli_real_escape_string($dbcon,ucwords($_POST['fname']));
              //$cs_username = $_POST['username'];
              $email = mysqli_real_escape_string($dbcon,$_POST['email']);
              $country = mysqli_real_escape_string($dbcon,ucfirst($_POST['country']));
              $comment = mysqli_real_escape_string($dbcon,ucfirst($_POST['comment']));

              $to = "useremail@gmail.com";
              $header = "$fullname<$email";
              $subject = "Message from $fullname";
              $message = "Name: $fullname \n\n<br><br>Email: $email \n\n<br><br>Country: $country  \n\n<br><br>Message: $comment";

              if(empty($fullname) or empty($email) or empty($country) or empty($comment)){
                $error = "<div class='alert alert-danger w-100' style='color:red;'>All (*) Fielsd are Required</div>";

              }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                 $emsg = "<span style='color:red;'>Please enter valid e-mail address !!</span>";

              }else{
                 
                  if(mail($to, $subject, $message, $header)){
                  
                  $msg ="<div class='alert alert-success w-100' style='color:green;'>Message has been sent</div>";

                  }else{

                  $error ="<div class='alert alert-danger w-100' style='color:red;'>Message sending failed</div>";
                  }
              }
            }
            ?>
              <h2 class="card-header">Contact Form</h2><br>
              <form action="" method="POST">
                <center><?php echo  $msg; ?><?php echo $error; ?></center>
                <div class="form-group">
                  <label for="fname">Full Name*:</label>
                  <input type="text" id="fname" class="form-control" name="fname" placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                  <label for="email">E-mail*:</label>
                  <input type="email" id="email" class="form-control" name="email" placeholder=" Enter E-mail Address">
                  <?php echo  $emsg; ?>
                </div>
                <div class="form-group">
                  <label for="country">Country:</label>
                  <input type="text" name="country" id="country" class="form-control"  placeholder="Enter country">
                </div>
                <div class="form-group">
                  <label for="comment">Comment:</label>
                  <textarea id="comment"  name="comment" cols="30" rows="10" class="form-control" placeholder="Write Your Message Here"></textarea>
                </div>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
              </form>
             </div>
            </div><br>
<!--====================== Sidebar-========================= -->
    
              <?php include('inc/sidebar.php'); ?>

            </div>
           </div>
    </section>
   </div>
<!--=============Footer==============->
   <?php include('inc/footer.php') ?>