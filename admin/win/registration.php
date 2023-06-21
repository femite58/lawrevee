<?php
session_start();
include("../connect.php");
  include("../functions.php");


if(isset($_POST['first_name'])) {
   
  	$first_name = sanitizeInput($_POST['first_name']);
	$other_name = sanitizeInput($_POST['other_names']);
	$surname = sanitizeInput($_POST['surname']);
	$dob= sanitizeInput($_POST['dob']);
	$gender = sanitizeInput($_POST['gender']);
	$residence = sanitizeInput($_POST['residence']);
	$lga = sanitizeInput($_POST['lga']);
	$school = sanitizeInput($_POST['school']);
	$school_address = sanitizeInput($_POST['school_address']);
	$school_state = sanitizeInput($_POST['school_state']);
	$school_phone = sanitizeInput($_POST['school_phone']);
	$school_email = sanitizeInput($_POST['school_email']);
	$parent_title = sanitizeInput($_POST['parent_title']);
	$parent_first_name = sanitizeInput($_POST['parent_first_name']);
	$parent_surname = sanitizeInput($_POST['parent_surname']);
	$parent_other_names = sanitizeInput($_POST['parent_other_names']);
	$parent_gender = sanitizeInput($_POST['parent_gender']);
	$parent_phone = sanitizeInput($_POST['parent_phone']);
	$parent_email = sanitizeInput($_POST['parent_email']);
	$ticket = $_SESSION["ticket"];
	
	if(genfetch("users", $_SESSION["ticket"], "ticket", "ticket")==""){
adduser($first_name, $other_name, $surname, $dob, $gender, $residence, $lga, $school, $school_address, $school_state, $school_phone, $school_email, $parent_title, $parent_first_name, $parent_surname, $parent_other_names, $parent_gender, $parent_phone, $parent_email, $ticket);
	}
	header("location: success.php");

}
?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>BrainDrill</title>
      <meta name="Brain drill" content="Brain Drill">
      <!-- description -->
      <meta name="Brain Drill" content="Barin Drill">
      <!-- keywords -->
      <meta name="keywords" content="Play Cards for kids">
      <!-- Favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
      <!-- Flaticon CSS -->
      <link rel="stylesheet" href="css/flaticon.css" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- jquery js-->
      <script src="js/jquery.min.js"></script>
      <!-- REVOLUTION STYLE SHEETS -->
      <link rel="stylesheet" type="text/css" href="css/revolution/settings.css" >
      <!-- REVOLUTION LAYERS STYLES -->
      <link rel="stylesheet" type="text/css" href="css/revolution/layers.css" >
      <!-- REVOLUTION NAVIGATION STYLES -->
      <link rel="stylesheet" type="text/css" href="css/revolution/navigation.css" >
      <!-- REVOLUTION JS FILES -->
      <script src="js/revolution/jquery.themepunch.tools.min.js"></script>
      <script src="js/revolution/jquery.themepunch.revolution.min.js"></script>
      <!-- PARTICLES ADD-ON FILES -->
      <link rel='stylesheet' href='css/revolution/revolution.addon.particles.css' type='text/css' media='all' />
      <script src='js/revolution/revolution.addon.particles.min.js'></script>
      <!-- SLIDER REVOLUTION 5.0 EXTENSIONS  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->   
      <script src="js/revolution/revolution.extension.actions.min.js"></script>
      <script src="js/revolution/revolution.extension.layeranimation.min.js"></script>
      <script src="js/revolution/revolution.extension.navigation.min.js"></script>
      <script src="js/revolution/revolution.extension.parallax.min.js"></script>
      <script src="js/revolution/revolution.extension.slideanims.min.js"></script>
      <!-- Owl Carousel stylesheet -->
      <link rel="stylesheet" href="css/owl.carousel.min.css" />
      <link rel="stylesheet" href="css/owl.theme.default.min.css" />
      <!-- Defualt CSS -->
      <link rel="stylesheet" href="css/defualt.css" />
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css" />
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <!-- ====== Preloader ====== -->
      <div class="preloader js-preloader flex-center">
         <img src="img/loader.gif" alt="Loader" />
      </div>
      <div class="wraper">
         <!-- ====== Header Start ====== -->
         <header class="index-2" id="home">
            <div class="container">
               <div class="row">
                  <div class="col-md-2 col-sm-4 col-xs-6 logo">
                     <a href="index.html"><img src="img/logo.png" alt="MobFire"></a>
                  </div>
                  <div class="col-md-10 col-sm-8 col-xs-6">
                     <div class="menu move-right">
                        <div class="toggle">
                           <span></span>
                        </div>
                        <ul>
                           <li><a href="#home" title="Homepage">Homepage</a></li>
                           <li><a href="#about-us" title="About Us">About Us</a></li>
                           <li><a href="#features" title="Features">Benefits</a></li>
                           <li><a href="#screenshots" title="Screenshots">Screenshots</a></li>
                           <li><a href="#price-plans" title="Price Plans">Price Plans</a></li>
                           <li><a href="#review" title="Reviews">Reviews</a></li>
                           <li><a href="#contact-us" title="Contact Us">Contact Us</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <!-- ====== Header End ====== -->
         <!-- ====== Slider Start ====== -->
       
         <!-- ====== Slider End ====== -->
         <main class="index-2">
           
            <!-- ====== Contact Us Start ====== -->
            <section id="contact-us" class="index-2">
               <div class="container">
                  <div class="section-heading d-none">
                     <h3>Contact Us</h3>
                  </div>
                  <div class="content">
					  <?php
					  if(genfetch("tickets", $_SESSION["ticket"], "ticket", "ticket")==""){
						  ?>
					  <div class="alert alert-danger">Invalid Ticket!</div>
					  <?php
					  }else{
					  if(genfetch("users", $_SESSION["ticket"], "ticket", "ticket")==""){
					  ?>
					  <br><br>
					  <h4>Raffle Draw Registration</h4>
					  <p>Please complete the form below to register your child for the raffle draw.</p>
					  <br>
                     <div class="row">
                    <form method="post">
                        <div class="col-md-6 col-sm-6 col-xs-12 contact-form">
                           
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="First Name" name="first_name" required />
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Surname" name="surname" required />
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Other Names" name="other_names" />
                              </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="date" placeholder="Date of Birth" name="dob" />
                              </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
							  <select name="gender" required class="form-control">
							  <option value="">Select Gender</option>
							  <option value="Male">Male</option>
							  <option value="Female">Female</option>
							  </select>
                              </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Residence" name="residence" />
                              </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="LGA" name="lga" />
                              </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="School" name="school" />
                              </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="School Address" name="school_address" />
                              </div>
                          <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="School State" name="school_state" />
                              </div>
                             
                             
                           
                        </div>
						
						<div class="col-md-6 col-sm-6 col-xs-12 contact-form">
                           
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="School Phone" name="school_phone" />
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="email" placeholder="School Email" name="school_email" />
                              </div>
							<h5>Parent/Guardian Details</h5>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Parent Title" name="parent_title" />
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Parent First Name" name="parent_first_name" />
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Parent Surname" name="parent_surname" />
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Parent Other Names" name="parent_other_names" />
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 
								  <select name="parent_gender" required class="form-control">
							  <option value="">Parent Gender</option>
							  <option value="Male">Male</option>
							  <option value="Female">Female</option>
							  </select>
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Parent Phone" name="parent_phone" />
                              </div>
                              <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                 <input type="text" placeholder="Parent Email" name="parent_email" />
                              </div>
                             
                             
                           
                        </div>
						 <div class="col-sm-12 text-center  form-group mar_none">
                                 <button type="submit">Submit<i class="glyph-icon flaticon-sent-mail"></i></button>
                              </div>
						</form>
                     </div>
                     <?php
					  }else{
						  ?>
					  <div class="alert alert-danger">This ticket has been used!</div>
					  <?php
					  }
					  }
						  ?>
                  </div>
               </div>
            </section>
            <!-- ====== Contact Us End ====== -->
            <!-- ====== Download Application Start ====== -->
          
            <!-- ====== Download Application End ====== -->
         </main>
         <!-- ====== Footer Start ====== -->
          <footer class="ani-gradiant">
            <div class="container">
               <div class="section-heading d-none">
                  <h2>Footer</h2>
               </div>
               <div class="content">
                  <div class="row">
                     <div class="social_media">
                        <ul>
                           <li><a href="javascript:void(0)"><i class="flaticon flaticon-facebook-logo"></i></a></li>
                           <li><a href="javascript:void(0)"><i class="flaticon flaticon-twitter-logo-silhouette"></i></a></li>
                           <li><a href="javascript:void(0)"><i class="flaticon flaticon-google-plus-logo"></i></a></li>
                           <li><a href="javascript:void(0)"><i class="flaticon flaticon-linkedin-logo"></i></a></li>
                           <li><a href="javascript:void(0)"><i class="flaticon flaticon-instagram"></i></a></li>
                        </ul>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="logo"><a href="index.html"><img src="img/logo-footer.png" alt="MobFire"></a></div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                        <p>&copy; 2021 Brain Drill. All Rights Reserved</p>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12 footer-nav">
                        <a href="#features" title="Features">Benefits</a>
                        <a href="#price-plans" title="Price Plans">Price Plans</a>
                        <a href="#contact-us" title="Contact Us">Contact Us</a>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- ====== Footer End ====== -->
      </div>
       <a href="javascript:void(0)" id="scroll"><span></span></a>
      <!-- bootstrap js--> 
      <script src="js/bootstrap.min.js"></script> 
      <!-- Parallax js--> 
      <script src="js/jquery.parallax-1.1.3.js"></script> 
      <!-- Waypoints js -->
      <script src="js/waypoints.min.js"></script>
      <!-- Preloader js -->
      <script src="js/jquery.preloadinator.min.js"></script>
      <script>
         $('.js-preloader').preloadinator({
           minTime: 2000
         });
      </script>
      <!-- Counter-up js -->
      <script src="js/jquery.counterup.min.js"></script>
      <!-- owl.carousel js -->
      <script src="js/owl.carousel.js"></script>
      <script src="js/owl.custom.js"></script>
      <!-- Custom js -->
      <script src="js/custom.js"></script> 
   </body>
</html>