<?php
session_start();
include("connect.php");
include("functions.php");

$sqlgnip = "SELECT * FROM blog WHERE publish=1";
$querygnip = mysqli_query($link, $sqlgnip);
while ($fchgnip = mysqli_fetch_assoc($querygnip)) {

  $bid[] = $fchgnip["id"];
}


$querytsld = "SELECT * FROM topslide WHERE active=1";

$resulttsld = mysqli_query($link, $querytsld);
while ($fchtsld = mysqli_fetch_assoc($resulttsld)) {

  $tsld[] = $fchtsld['id'];
}


$querybsld = "SELECT * FROM bottomslide WHERE active=1";

$resultbsld = mysqli_query($link, $querybsld);
while ($fchbsld = mysqli_fetch_assoc($resultbsld)) {

  $bsld[] = $fchbsld['id'];
}

$strp = 0;
$stpp = $strp - 12;
$pg = 1;

if (isset($_GET["pg"])) {
  $strp = sanitizeInput($_GET["pg"]) * 12;
  $stpp = $strp - 12;
  $pg = sanitizeInput($_GET["pg"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Lawrevee Homes</title>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
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

  <style>
    .btn-blue {
      background: #000066;
      color: #ffcc00;
    }

    .btn-yellow {
      background: #ffcc00;
      color: #000066;
    }

    .btn-yellow:hover {
      background: #000066;
      color: #ffcc00;
    }

    .btn-blue:hover {
      background: #ffcc00;
      color: #000066;
    }

    .blink_me {
      animation: blinker 2s linear infinite;
    }

    @keyframes blinker {
      50% {
        opacity: 0;
      }
  </style>

  <div class="slide-one-item home-slider owl-carousel">

    <?php

    for ($i = 0; $i < count($tsld); $i++) {

    ?>
      <div class="site-blocks-cover overlay" style="background-image: url(img/<?php echo genfetch("topslide", $tsld[$i], "img"); ?>);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">

              <h1 class="mb-2 text-white">Let's Take You Home </h1>
              <p class="mb-5"><strong class="h2 text-success font-weight-bold"></strong></p>
              <p><a href="lands.php" class="btn btn-white  py-3 px-5 rounded-0 btn-2 mb-2 btn-yellow">Lands <span class="icon-arrow_forward"></span></a>
                <!--	<a href="investments.php" class="btn btn-white  py-3 px-5 rounded-0 btn-2 mb-2 btn-blue" >Investments <span class="icon-arrow_forward"></span></a> -->
              </p>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>

  </div>


  <div class="site-section" style="background: url(lawbk.jpg); background-size:cover; min-height:800px; padding-top:10px;">
    <div class="container">
      <div class="row justify-content-center ">
        <h1 style="color:#ffcc00;" class="text-center blink_me">THE GAME CHANGER IN REAL ESTATE BUSINESS</h1><br><br>

      </div>

      <div class="row mt-1">
        <div class="col-md-6 text-white offset-sm-3">
          <a href="#" class="service text-center">
            <span class="icon flaticon-house text-white"></span>
            <h2 class="service-heading text-white">Purchase Property</h2>
            <p class="text-white">View our list of Real Estate properties available for purchase at strategic locations in Nigeria.</p>
            <p class="text-center"><a href="lands.php" class="btn btn-success btn-outline-white py-3 px-5 rounded-0 btn-2 btn-yellow">Purchase Now</a></p>
          </a>
        </div>


      </div>
    </div>
  </div>

  <div class="site-section bg-light">
    <div class="container">
      <div class="col-lg-12">
        <div class="splide">
          <div class="splide__track">
            <ul class="splide__list">

              <?php

              for ($i = 0; $i < count($bsld); $i++) {

              ?>
                <li class="splide__slide"><img src="img/<?php echo genfetch("bottomslide", $bsld[$i], "img"); ?>" width="100%"></li>
              <?php
              }
              ?>

            </ul>
          </div>
        </div>
      </div>


    </div>
  </div>




  <?php include "footer.php"; ?>


  <div style="width:80px; min-height:100px;  position:fixed; top: 150px; z-index:1000; right: 0px;">
    <a href="http://facebook.com/lawrevee.homes247" class="col-sm-12"><img src="lawrevee-fb.png" width="50%" class="mb-2"></a>
    <a href="https://instagram.com/lawrevee_homes" class="col-sm-12"><img src="lawrevee-ins.png" width="50%" class="mb-2"></a>
    <a href="" class="col-sm-12"><img src="lawrevee-tw.png" width="50%" class="mb-2"></a>
    <a href="https://linkedin.com/in/lawrevee-homes-214a0b209" class="col-sm-12"><img src="lawrevee-lkd.png" width="50%" class="mb-2"></a>
  </div>
  <div style="width:200px; position:fixed; bottom: 0px; z-index:1000; right: 0px;">
    <a href="https://wa.me/+2349030587652" class="col-sm-12"><img src="lawrevee-chat.png" width="80%" class="mb-2 mr-5"></a>
  </div>


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
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
  <script src="js/main.js"></script>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      new Splide('.splide', {
        type: 'loop',
        autoplay: true,

      }).mount();
    });
  </script>
</body>

</html>