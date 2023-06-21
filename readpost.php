<?php
session_start();
include("connect.php");
  include("functions.php");

$blogurl = sanitizeInput($_GET['rp']);

$sqlgnip = "SELECT * FROM blog WHERE url='$blogurl'";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
       
}

$sqlgn = "SELECT * FROM comments WHERE post=".$bid[0];
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
       
        $comid[]= $fchgn["id"];
}

addblogview($bid[0]);

if(isset($_POST["name"])){
	$post=$bid[0];
	$name=$_POST["name"];
	$email=$_POST["email"];
	$message=$_POST["comment"];
	
	$rt = addcomment($post, $name, $email, $message);
	$cul =curPageURL() ;
	header("location:".$cul);
}

?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; <?php echo getblogtopic($bid[0]); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">
	  <link rel="icon" href="lawrevee.png" type="image/x-icon">


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/mediaelementplayer.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/fl-bigmug-line.css">
    
  
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
	
  </head>
  <body>
  <div class="site-loader"></div>
    
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

       <?php include "header.php"; ?>
    </div>
	  
 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_2.jpg); min-height:80px;" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row "  style=" min-height:80px;">
          <div class="col-md-12">
           <br><br><br>
            <h4 class="text-white mt-5 text-center">Blog</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
		 <div class="row mb-5">
			 
		 
		 <div class="col-sm-10 offset-sm-1">
	
<div class="bg-white widget border rounded">

	<h2 class="widget-title"><?php echo getblogtopic($bid[0]); ?></h2>
	
	<div class="row mb-3">
						<div class="col-xs-2 mr-3">
							<small><?php echo getblogdate($bid[0]); ?></small>
							</div>
					<div class="col-xs-2 mr-3">
							<small><?php echo getblogviews($bid[0]); ?> Views</small>
							</div>
							
							<div class="col-xs-2 mr-3">
							<small><?php echo getcommentcount($bid[0]); ?> Comments</small>
							</div>
		<hr>
							</div>
						<div class="intro_text text-dark">
							<?php echo getblogcontent($bid[0]); ?>
						</div>
			 </div>
			 </div>
			 
			 </div>
       
        
      </div>
    </div>

    
      <?php include "footer.php"; ?>

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/mediaelement-and-player.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

  </body>
</html>