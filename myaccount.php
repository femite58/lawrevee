<?php
session_start();
include("connect.php");
  include("functions.php");

$uid = $_COOKIE["uid"];
$authen = $_COOKIE["eml"];

if(isset($_GET['logoff'])) {
    
    
 unset($_COOKIE["uid"]); 
unset($_COOKIE["eml"]);   
    
    header("location: login.php"); exit();
}

$queryusr = "SELECT * FROM users WHERE authen='$authen' AND id= $uid";

		$resultusr = mysqli_query($link,$queryusr);
		 while($fchusr = mysqli_fetch_assoc($resultusr)){
             
             $vuid[] = $fchusr['id'];
           
         }

if(!isset($vuid)){ header("location:login.php"); }


$queryinv = "SELECT * FROM investments WHERE user=".$uid;

		$resultinv = mysqli_query($link,$queryinv);
		 while($fchinv = mysqli_fetch_assoc($resultinv)){
             
             $invid[] = $fchinv['id'];
           
         }

?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; My Account</title>
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
            <h4 class="text-white mt-5 text-center">My Account</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
		 <div class="row mb-5">
			 
		 <div class="col-sm-3">
	
<div class="bg-white widget border rounded">

              <h4 class="h4 text-black widget-title mb-3">Hi, <?php echo  genfetch("users", $uid, "username");  ?></h4>
	<span class=""><?php echo  genfetch("users", $uid, "email");  ?></span><br>
	<span class=""><?php echo  genfetch("users", $uid, "phone");  ?></span><br><br>
	<a class="btn btn-sm btn-info" href="">My Profile</a> <a class="btn btn-sm btn-danger" href="?logoff=1">Logout</a>
			 </div>
			 </div>	 
		 <div class="col-sm-9">
	
<div class="bg-white widget border rounded">

              <h3 class="h4 text-black widget-title mb-3">My Investments</h3>
	
    <div class=" table-responsive">
         <table class="table table-striped table-hover" id="customers2">
                <thead>
             <th>S/N</th>
             
             <th>Location</th>
             <th>Estate</th>
             <th>Size</th>
             <th>Value</th>
             <th>Expected Profit</th>
             <th>Duration</th>
             <th>Final Value</th>
             <th>Maturity</th>
             
             <th>Status</th>
            
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($invid)){
                 $sn =1;
                 for($i=count($invid)-1; $i>=0; $i--){
					
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                
                 
                 <td><?php echo genfetch("trading",genfetch("investments", $invid[$i], "property"), "location"); ?></td>
                 <td><?php echo genfetch("trading", genfetch("investments", $invid[$i], "property"), "estate"); ?></td>
                 <td><?php echo genfetch("investments", $invid[$i], "qty"); ?> Sq. Meters</td>
                  
                 <td>N<?php echo number_format(genfetch("investments", $invid[$i], "price"),2); ?></td>
                 <td>N<?php echo number_format((genfetch("investments", $invid[$i], "price")*genfetch("investments", $invid[$i], "interest_rate")/100),2); ?></td>
				 <td><?php echo genfetch("investments", $invid[$i], "duration"); ?></td>
                 <td>N<?php echo number_format(genfetch("investments", $invid[$i], "price")+(genfetch("investments", $invid[$i], "price")*genfetch("investments", $invid[$i], "interest_rate")/100),2); ?></td>
                  <td><?php echo date("M-d-Y", genfetch("investments", $invid[$i], "due_date")); ?></td>
                  <td><?php echo genfetch("investments", $invid[$i], "status"); ?></td>
                 
                 
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Investment</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
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