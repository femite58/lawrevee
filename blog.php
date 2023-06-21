<?php
session_start();
include("connect.php");
  include("functions.php");

$sqlgnip = "SELECT * FROM blog WHERE publish=1";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
       
       
}
$strp = 0;
$stpp = $strp-12;
$pg = 1;

if(isset($_GET["pg"])){
	$strp = sanitizeInput($_GET["pg"])*12;
	$stpp = $strp-12;
	$pg = sanitizeInput($_GET["pg"]);
}

?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; Blog</title>
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
	  
 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_2.jpg); min-height:300px;" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center"  style=" min-height:400px;">
          <div class="col-md-10">
           
            <h2 class="text-white">Blog</h2>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold"></strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
		 <div class="row mb-5">
						<?php
				if(!empty($bid)){
					$curps = count($bid)-($strp+1);
				for($i=$curps; $i>=0; $i--){
					 $pstg = getblogcontent($bid[$i]); 
					preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $pstg, $image); 
					?>
          <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
            <a href="readpost.php?rp=<?php echo getblogtopicurl($bid[$i]); ?>"><img src="<?php  echo $image['src'];
 ?>" alt="<?php echo getblogtopic($bid[$i]); ?>" alt="Image" class="img-fluid"></a>
            <div class="p-4 bg-white">
              <span class="d-block text-secondary small text-uppercase"><?php echo getblogdate($bid[$i]); ?></span>
              <h2 class="h5 text-black mb-3"><a href="readpost.php?rp=<?php echo getblogtopicurl($bid[$i]); ?>"><?php echo getblogtopic($bid[$i]); ?></a></h2>
              <p><?php echo strstr(getblogcontent($bid[$i]),"</p>", true); echo "..."; ?></p>
            </div>
          </div>
  <?php 
					if($i<=$stpp-1){
				break;
			}
				 }
                   }?>
			 
        </div>
       
		  
			   <div class="row" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-pagination">
				<?php
					if($i>=0){
						?>
              <a href="#" ><i class="icon-arrow_back"></i></a>
				<?php
					}
				  if($i>0){
						?>
              <a href="#"><i class="icon-arrow_forward"></i></a>
				 <?php
				  }
				  ?>
              
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