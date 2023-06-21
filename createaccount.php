<?php
session_start();
include("connect.php");
  include("functions.php");

if(isset($_POST['first_name'])){
	
	
	$first_name = sanitizeInput($_POST["first_name"]);
	$middle_name = sanitizeInput($_POST["middle_name"]);
	$surname = sanitizeInput($_POST["surname"]);
	$phone = sanitizeInput($_POST["phone"]);
	$email = sanitizeInput($_POST["email"]);
	$address = sanitizeInput($_POST["address"]);
	$sex = sanitizeInput($_POST["sex"]);
	$marital_status = sanitizeInput($_POST["marital_status"]);
	$nationality = sanitizeInput($_POST["nationality"]);
	$kin_first_name = sanitizeInput($_POST["kin_first_name"]);
	$kin_surname = sanitizeInput($_POST["kin_surname"]);
	$kin_phone = sanitizeInput($_POST["kin_phone"]);
	$kin_address = sanitizeInput($_POST["kin_address"]);
	$username = sanitizeInput($_POST["username"]);
	$ref = sanitizeInput($_POST["ref"]);
	$password = protectPass($_POST["password"]);
	
	if(genfetch("users", $email, "email", "email")!=""){
		$rtn= "Email already exist!";
	}else if(genfetch("users", $username, "username", "username")!=""){
		$rtn= "Username already exist!";
	}else {
	addUser($first_name, $middle_name, $surname, $email, $phone, $address, $sex, $marital_status, $nationality, $kin_first_name, $kin_surname, $kin_phone, $kin_address, $password, $username, $ref);
		
		header("location:login.php");
	}
	
}

?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Lawrevee &mdash; Create Account</title>
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
            <h4 class="text-white mt-5 text-center">Create Account</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
		 <div class="row mb-5">
			 
		 
		 <div class="col-sm-8 offset-sm-2">
	
<div class="bg-white widget border rounded">

	<?php
			if(isset($rtn)){
				?>
			<div class="col-lg-12">
			<div class="alert alert-success text-center"><?php echo $rtn; ?></div>
			</div>
			<?php
			}
			?>
              <form action="" class="form-contact-agent" method="post">
                <div class="form-group">
                  <label for="name">First Name</label>
                  <input type="text" id="name" name="first_name" class="form-control" required>
                </div> 
				<div class="form-group">
                  <label for="name">Middle Name</label>
                  <input type="text" id="name" name="middle_name" class="form-control">
                </div>
				<div class="form-group">
                  <label for="name">Surname</label>
                  <input type="text" id="name" name="surname" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
				  <div class="form-group">
                  <label for="phone">Address</label>
                  <input type="text" id="phone" name="address" class="form-control" required>
                </div>
				  <div class="form-group">
                  <label for="phone">Username</label>
                  <input type="text" id="phone" name="username" class="form-control" required>
                </div>
				 <div class="form-group">
                  <label for="phone">Password</label>
                  <input type="password" id="phone" name="password" class="form-control" required>
                </div>
				 <div class="form-group">
                  <label for="phone">Referral Username</label>
                  <input type="text" id="phone" name="ref" class="form-control">
                </div>
				 
				  <div class="form-group">
                  <label for="time">Sex</label>
                  <select  id="time" name="sex" class="form-control" required>
					  <option value="Male">Male</option>
					  <option value="Female">Female</option>
					 
					  </select>
                </div>
				  <div class="form-group">
                  <label for="time">Marital Status</label>
                  <select  id="time" name="marital_status" class="form-control" required>
					  <option value="Single">Single</option>
					  <option value="Married">Married</option>
					 
					  </select>
                </div>
				 <div class="form-group">
                  <label for="phone">Nationality</label>
                  <input type="text" id="phone" name="nationality" class="form-control" required>
                </div>
				 <div class="form-group">
                  <label for="phone">Next of Kin First Name</label>
                  <input type="text" id="phone" name="kin_first_name" class="form-control" required>
                </div>
				 <div class="form-group">
                  <label for="phone">Next of Kin Surname</label>
                  <input type="text" id="phone" name="kin_surname" class="form-control" required>
                </div>
				 <div class="form-group">
                  <label for="phone">Next of Kin phone</label>
                  <input type="text" id="phone" name="kin_phone" class="form-control" required>
                </div>
				 <div class="form-group">
                  <label for="phone">Next of Kin address</label>
                  <input type="text" id="phone" name="kin_address" class="form-control" required>
                </div>
                <div class="form-group">
                  <input type="submit"  class="btn btn-primary" value="Submit">
                </div>
              </form>
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