<?php
session_start();
include("../connect.php");
include("../functions.php");

$adid = $_COOKIE["uid"];
$eml = $_COOKIE["eml"];


if (isset($_GET['logoff'])) {


	unset($_COOKIE["uid"]);
	unset($_COOKIE["eml"]);

	header("location: index.php");
	exit();
}

$sqlchk = "SELECT * FROM admin WHERE authen='" . $eml . "' AND id=" . $adid;
$querychk = mysqli_query($link, $sqlchk);
while ($fch = mysqli_fetch_assoc($querychk)) {

	$regeml[] = $fch["id"];
}
if (empty($regeml)) {
	header("location:dashboard.php?logoff=1");
	exit();
}



$queryins = "SELECT * FROM inspection";

$resultins = mysqli_query($link, $queryins);
while ($fchins = mysqli_fetch_assoc($resultins)) {

	$insid[] = $fchins['id'];
}


$queryinv = "SELECT * FROM investments";

$resultinv = mysqli_query($link, $queryinv);
while ($fchinv = mysqli_fetch_assoc($resultinv)) {

	$invid[] = $fchinv['id'];
}

$queryland = "SELECT * FROM lands";

$resultland = mysqli_query($link, $queryland);
while ($fchland = mysqli_fetch_assoc($resultland)) {

	$landid[] = $fchland['id'];
}


$querytrd = "SELECT * FROM trading";

$resulttrd = mysqli_query($link, $querytrd);
while ($fchtrd = mysqli_fetch_assoc($resulttrd)) {

	$trdid[] = $fchtrd['id'];
}


$querysta = "SELECT * FROM admin";

$resultsta = mysqli_query($link, $querysta);
while ($fchsta = mysqli_fetch_assoc($resultsta)) {

	$staid[] = $fchsta['id'];
}


$queryusr = "SELECT * FROM users";

$resultusr = mysqli_query($link, $queryusr);
while ($fchusr = mysqli_fetch_assoc($resultusr)) {

	$usrid[] = $fchusr['id'];
}

$queryblg = "SELECT * FROM blog";

$resultblg = mysqli_query($link, $queryblg);
while ($fchblg = mysqli_fetch_assoc($resultblg)) {

	$pidblg[] = $fchblg['id'];
}





$querytsld = "SELECT * FROM topslide";

$resulttsld = mysqli_query($link, $querytsld);
while ($fchtsld = mysqli_fetch_assoc($resulttsld)) {

	$tsld[] = $fchtsld['id'];
}


$querybsld = "SELECT * FROM bottomslide";

$resultbsld = mysqli_query($link, $querybsld);
while ($fchbsld = mysqli_fetch_assoc($resultbsld)) {

	$bsld[] = $fchbsld['id'];
}

$querylby = "SELECT * FROM library";

$resultlby = mysqli_query($link, $querylby);
while ($fchlby = mysqli_fetch_assoc($resultlby)) {

	$lby[] = $fchlby['id'];
}




if (isset($_POST['tradingname'])) {

	$location = sanitizeInput($_POST["tradinglocation"]);
	$estate = sanitizeInput($_POST["tradingname"]);
	$price_per_plot = sanitizeInput($_POST["tradingpriceplot"]);
	$price_per_meter = sanitizeInput($_POST["tradingpricemeter"]);
	$added_by = $adid;

	addTrading($location, $estate, $price_per_plot, $price_per_meter, $added_by);
	header("location:dashboard.php?pg=trading");
}

if (isset($_POST['tradingnameed'])) {

	$location = sanitizeInput($_POST["tradinglocationed"]);
	$estate = sanitizeInput($_POST["tradingnameed"]);
	$price_per_plot = sanitizeInput($_POST["tradingpriceploted"]);
	$price_per_meter = sanitizeInput($_POST["tradingpricemetered"]);
	$tid = sanitizeInput($_POST["tid"]);
	$edit_by = $adid;

	editTrading($tid, $location, $estate, $price_per_plot, $price_per_meter, $edit_by);
	header("location:dashboard.php?pg=trading");
}

if (isset($_POST['estatename'])) {

	$name = sanitizeInput($_POST["estatename"]);
	$location = sanitizeInput($_POST["estatelocation"]);
	$neighborhood = sanitizeInput($_POST["estateneighborhood"]);
	$size = sanitizeInput($_POST["estatesize"]);
	$title = sanitizeInput($_POST["estatetitle"]);
	$price = sanitizeInput($_POST["estateprice"]);
	$promo = sanitizeInput($_POST["estatepromo"]);
	$promo_start = strtotime(sanitizeInput($_POST["estatepromostart"]));
	$promo_end = strtotime(sanitizeInput($_POST["estatepromoend"]));
	$video = sanitizeInput($_POST["estatevideo"]);
	$description = $_POST["estatedescription"];
	$use_type = sanitizeInput($_POST["estateusetype"]);
	$popular = sanitizeInput($_POST["popular"]);
	$added_by = $adid;


	$images = "";
	for ($i = 0; $i < count($_FILES["prodimg"]['name']); $i++) {

		if (@getimagesize($_FILES["prodimg"]['tmp_name'][$i])) {
			$filename = $_FILES["prodimg"]['name'][$i];
			$filetemp = $_FILES["prodimg"]['tmp_name'][$i];
			$target_dir = "../img/";
			$images .= uploadimage($filename, $filetemp, $target_dir);
			if ($i < count($_FILES["prodimg"]['name']) - 1) {
				$images .= ",";
			}
		}
	}

	$form = "";

	$filename = $_FILES["estateform"]['name'];
	$filetemp = $_FILES["estateform"]['tmp_name'];
	$target_dir = "../doc/";
	$form = uploaddoc($filename, $filetemp, $target_dir);



	addLand($name, $location, $neighborhood, $size, $title, $price, $promo, $promo_start, $promo_end, $form, $images, $video, $description, $use_type, $added_by, $popular);
	header("location:dashboard.php?pg=allproperties");
}

if (isset($_POST['estatenameed'])) {

	$name = sanitizeInput($_POST["estatenameed"]);
	$location = sanitizeInput($_POST["estatelocationed"]);
	$neighborhood = sanitizeInput($_POST["estateneighborhooded"]);
	$size = sanitizeInput($_POST["estatesizeed"]);
	$title = sanitizeInput($_POST["estatetitleed"]);
	$price = sanitizeInput($_POST["estatepriceed"]);
	$promo = sanitizeInput($_POST["estatepromoed"]);
	$promo_start = strtotime(sanitizeInput($_POST["estatepromostarted"]));
	$promo_end = strtotime(sanitizeInput($_POST["estatepromoended"]));
	$video = sanitizeInput($_POST["estatevideoed"]);
	$description = $_POST["estatedescriptioned"];
	$use_type = sanitizeInput($_POST["estateusetypeed"]);
	$lid = sanitizeInput($_POST["landid"]);
	$popular = sanitizeInput($_POST["popular"]);
	$edit_by = $adid;


	$images = "";
	$imgold = $_POST["imgold"];
	for ($i = 0; $i < count($imgold); $i++) {


		$images .= sanitizeInput($imgold[$i]);
		if ($i < count($imgold) - 1) {
			$images .= ",";
		}
	}

	for ($i = 0; $i < count($_FILES["prodimg"]['name']); $i++) {

		if (@getimagesize($_FILES["prodimg"]['tmp_name'][$i])) {
			$filename = $_FILES["prodimg"]['name'][$i];
			$filetemp = $_FILES["prodimg"]['tmp_name'][$i];
			$target_dir = "../img/";
			if ($images != "") {
				$images .= "," . uploadimage($filename, $filetemp, $target_dir);
			} else {
				$images .= uploadimage($filename, $filetemp, $target_dir);
			}
		}
	}



	$filename = $_FILES["estateform"]['name'];
	$filetemp = $_FILES["estateform"]['tmp_name'];
	$target_dir = "../doc/";
	$form = uploaddoc($filename, $filetemp, $target_dir);
	if ($form == "") {
		$form = genfetch("lands", $lid, "form");
	}


	editLand($lid, $name, $location, $neighborhood, $size, $title, $price, $promo, $promo_start, $promo_end, $form, $images, $video, $description, $use_type, $edit_by, $popular);
	header("location:dashboard.php?pg=allproperties");
}

if (isset($_POST['staffname'])) {

	$name = sanitizeInput($_POST["staffname"]);
	$phone = sanitizeInput($_POST["staffphone"]);
	$email = sanitizeInput($_POST["staffemail"]);
	$username = sanitizeInput($_POST["staffusername"]);
	$password = protectPass($_POST["staffpassword"]);
	$level = sanitizeInput($_POST["stafflevel"]);
	$auth = $password;

	addStaffs($name, $phone, $email, $username, $password, $level, $auth);
	header("location:dashboard.php?pg=staffs");
}


if (isset($_POST['topicbg'])) {

	$topic = sanitizeInput($_POST["topicbg"]);
	$category = sanitizeInput($_POST["categorybg"]);
	$content = $_POST["contentbg"];
	$tags = sanitizeInput($_POST["tagsbg"]);
	$url = str_replace(" ", "_", $topic);
	$url = str_replace("'", "", $url);
	$url = str_replace("#", "", $url);

	newblogpost($topic, $category, $content, $tags, $url);
	header("location:dashboard.php?pg=allblogposts");
}

if (isset($_POST['topicbged'])) {

	$topic = sanitizeInput($_POST["topicbged"]);
	$category = sanitizeInput($_POST["categorybged"]);
	$content = $_POST["contentbged"];
	$tags = sanitizeInput($_POST["tagsbged"]);
	$bpid = sanitizeInput($_POST["blogid"]);

	updateblogpost($topic, $category, $content, $tags, $bpid);
	header("location:dashboard.php?pg=allblogposts");
}


if (isset($_POST['librarytitle'])) {

	$title = sanitizeInput($_POST["librarytitle"]);
	$category = sanitizeInput($_POST["librarycategory"]);
	$videolink = sanitizeInput($_POST["libraryvideo"]);


	$images = "";

	if (@getimagesize($_FILES["libraryfile"]['tmp_name'])) {
		$filename = $_FILES["libraryfile"]['name'];
		$filetemp = $_FILES["libraryfile"]['tmp_name'];
		$target_dir = "../img/";
		$images = uploadimage($filename, $filetemp, $target_dir);
	}

	if ($category == "picture") {
		$content = $images;
	} else {
		$content = $videolink;
	}


	addlibrary($title, $category, $content);
	header("location:dashboard.php?pg=alllibrary");
}

if (isset($_POST['librarytitleed'])) {
	$libid = sanitizeInput($_POST["libid"]);
	$title = sanitizeInput($_POST["librarytitleed"]);
	$category = sanitizeInput($_POST["librarycategoryed"]);
	$videolink = sanitizeInput($_POST["libraryvideoed"]);
	$content = genfetch("library", $libid, "content");

	$images = "";

	if (@getimagesize($_FILES["libraryfile"]['tmp_name'])) {
		$filename = $_FILES["libraryfile"]['name'];
		$filetemp = $_FILES["libraryfile"]['tmp_name'];
		$target_dir = "../img/";
		$images = uploadimage($filename, $filetemp, $target_dir);
	}

	if ($category == "picture" && $images != "") {
		$content = $images;
	} else if ($category == "video" && $videolink != "") {
		$content = $videolink;
	}


	editlibrary($libid, $title, $category, $content);
	header("location:dashboard.php?pg=alllibrary");
}


if (isset($_FILES["slidefile"]['tmp_name'])) {

	$images = "";

	if (@getimagesize($_FILES["slidefile"]['tmp_name'])) {
		$filename = $_FILES["slidefile"]['name'];
		$filetemp = $_FILES["slidefile"]['tmp_name'];
		$target_dir = "../img/";
		$images = uploadimage($filename, $filetemp, $target_dir);
	}

	addtopslide($images);
	header("location:dashboard.php?pg=alltopslide");
}

if (isset($_FILES["slidefileed"]['tmp_name'])) {

	$slid = sanitizeInput($_POST["slideid"]);
	$images = genfetch("topslide", $slid, "img");

	if (@getimagesize($_FILES["slidefileed"]['tmp_name'])) {
		$filename = $_FILES["slidefileed"]['name'];
		$filetemp = $_FILES["slidefileed"]['tmp_name'];
		$target_dir = "../img/";
		$images = uploadimage($filename, $filetemp, $target_dir);
	}

	edittopslide($slid, $images);
	header("location:dashboard.php?pg=alltopslide");
}

if (isset($_FILES["bottomslidefile"]['tmp_name'])) {

	$images = "";

	if (@getimagesize($_FILES["bottomslidefile"]['tmp_name'])) {
		$filename = $_FILES["bottomslidefile"]['name'];
		$filetemp = $_FILES["bottomslidefile"]['tmp_name'];
		$target_dir = "../img/";
		$images = uploadimage($filename, $filetemp, $target_dir);
	}

	addbottomslide($images);
	header("location:dashboard.php?pg=allbottomslide");
}

if (isset($_FILES["bottomslidefileed"]['tmp_name'])) {

	$slid = sanitizeInput($_POST["bslideid"]);
	$images = genfetch("bottomslide", $slid, "img");

	if (@getimagesize($_FILES["bottomslidefileed"]['tmp_name'])) {
		$filename = $_FILES["bottomslidefileed"]['name'];
		$filetemp = $_FILES["bottomslidefileed"]['tmp_name'];
		$target_dir = "../img/";
		$images = uploadimage($filename, $filetemp, $target_dir);
	}

	editbottomslide($slid, $images);
	header("location:dashboard.php?pg=allbottomslide");
}

if (isset($_POST['showlibrary'])) {
	showlibrary(sanitizeInput($_POST["showlibrary"]));
}
if (isset($_POST['hidelibrary'])) {
	hidelibrary(sanitizeInput($_POST["hidelibrary"]));
}

if (isset($_POST['showbottomslide'])) {
	showbottomslide(sanitizeInput($_POST["showbottomslide"]));
}
if (isset($_POST['hidebottomslide'])) {
	hidebottomslide(sanitizeInput($_POST["hidebottomslide"]));
}

if (isset($_POST['showtopslide'])) {
	showtopslide(sanitizeInput($_POST["showtopslide"]));
}
if (isset($_POST['hidetopslide'])) {
	hidetopslide(sanitizeInput($_POST["hidetopslide"]));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Lawrevee Admin </title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Okechukwu Onwuemenyi" />
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.png">

	<!-- Bootstrap Colorpicker CSS -->
	<link href="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />

	<!-- select2 CSS -->
	<link href="vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

	<!-- switchery CSS -->
	<link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-select CSS -->
	<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-tagsinput CSS -->
	<link href="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-touchspin CSS -->
	<link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

	<!-- multi-select CSS -->
	<link href="vendors/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Switches CSS -->
	<link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Datetimepicker CSS -->
	<link href="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Daterangepicker CSS -->
	<link href="vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Dropzone CSS -->
	<link href="vendors/bower_components/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />





	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

	<div class="wrapper ">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block mr-20 pull-left" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
			<a href="dashboard.php"><img class="brand-img pull-left" src="" width="120px" alt="Lawrevee Homes" /></a>
			<ul class="nav navbar-right top-nav pull-right">
				<li>

				</li>
				<li>
					<a href="#">Hi, <?php echo genfetch("admin", $adid, "username"); ?></a>
				</li>
				<li>

				</li>
				<li>

				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="dist/img/user.png" alt="" class="user-auth-img img-circle" /></a>
					<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

						<li>
							<a href="?pg=changepassword"><i class="fa fa-fw fa-lock"></i> Change Password</a>
						</li>

						<li>
							<a href="?logoff=1"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="collapse navbar-search-overlap" id="site_navbar_search">
				<form role="search">
					<div class="form-group mb-0">
						<div class="input-search">
							<div class="input-group">
								<input type="text" id="overlay_search" name="overlay-search" class="form-control pl-30" placeholder="Search">
								<span class="input-group-addon pr-30">
									<a href="javascript:void(0)" class="close-input-overlay" data-target="#site_navbar_search" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="fa fa-times"></i></a>
								</span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</nav>
		<!-- /Top Menu Items -->

		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">

				<li>
					<a href="?pg=dashboard" class="<?php if (@$_GET['pg'] == 'dashboard') {
														echo 'active';
													} ?>"><i class="fa fa-dashboard mr-10"></i>Dashboard </a>

				</li>

				<li>
					<a href="?pg=lands" class="<?php if (@$_GET['pg'] == 'lands') {
													echo 'active';
												} ?>"><i class="fa fa-bank mr-10"></i>properties </a>

				</li>
				<li>
					<a href="?pg=trading" class="<?php if (@$_GET['pg'] == 'trading') {
														echo 'active';
													} ?>"><i class="fa fa-money mr-10"></i>Estate Trading </a>

				</li>

				<li>
					<a href="?pg=investments" class="<?php if (@$_GET['pg'] == 'investments') {
															echo 'active';
														} ?>"><i class="fa fa-money mr-10"></i>Investments </a>

				</li>


				<li>
					<a href="?pg=staffs" class="<?php if (@$_GET['pg'] == 'staffs') {
													echo 'active';
												} ?>"><i class="fa fa-user mr-10"></i>Staffs </a>

				</li>


				<li>
					<a href="?pg=users" class="<?php if (@$_GET['pg'] == 'users') {
													echo 'active';
												} ?>"><i class="fa fa-users mr-10"></i>Investors</a>

				</li>

				<li>
					<a href="?pg=inspections" class="<?php if (@$_GET['pg'] == 'inspections') {
															echo 'active';
														} ?>"><i class="fa fa-clock-o mr-10"></i>Inspections</a>

				</li>

				<li>
					<a href="?pg=alltopslide" class="<?php if (@$_GET['pg'] == 'alltopslide') {
															echo 'active';
														} ?>"><i class="fa fa-flag mr-10"></i>Top Slides</a>

				</li>

				<li>
					<a href="?pg=allbottomslide" class="<?php if (@$_GET['pg'] == 'allbottomslide') {
															echo 'active';
														} ?>"><i class="fa fa-flag mr-10"></i>Bottom Slides</a>

				</li>
				<li>
					<a href="?pg=alllibrary" class="<?php if (@$_GET['pg'] == 'alllibrary') {
														echo 'active';
													} ?>"><i class="fa fa-photo mr-10"></i>Library</a>

				</li>


				<li>
					<a href="?pg=allblogposts" class="<?php if (@$_GET['pg'] == 'allblogposts') {
															echo 'active';
														} ?>"><i class="fa fa-globe mr-10"></i>News</a>

				</li>






			</ul>
		</div>
		<!-- /Left Sidebar Menu -->

		<!-- Right Sidebar Menu -->

		<!-- /Right Sidebar Menu -->

		<script>
			(function(document) {
				'use strict';

				var LightTableFilter = (function(Arr) {

					var _input;

					function _onInputEvent(e) {
						_input = e.target;
						var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
						Arr.forEach.call(tables, function(table) {
							Arr.forEach.call(table.tBodies, function(tbody) {
								Arr.forEach.call(tbody.rows, _filter);
							});
						});
					}

					function _filter(row) {
						var text = row.textContent.toLowerCase(),
							val = _input.value.toLowerCase();
						row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
					}

					return {
						init: function() {
							var inputs = document.getElementsByClassName('light-table-filter');
							Arr.forEach.call(inputs, function(input) {
								input.oninput = _onInputEvent;
							});
						}
					};
				})(Array.prototype);

				document.addEventListener('readystatechange', function() {
					if (document.readyState === 'complete') {
						LightTableFilter.init();
					}
				});

			})(document);
		</script>

		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				<!-- Title -->

				<!-- /Title -->

				<!-- Row -->
				<div class="row" style="padding-top:15px;">
					<?php

					switch (@$_GET["pg"]) {



						case "newproperty":
							include("newproperty.php");

							break;

						case "properties":
							include("allproperties.php");


						case "editproperty":
							include("editproperty.php");

							break;

						case "newtrading":
							include("newtrading.php");

							break;

						case "trading":
							include("alltrading.php");

							break;

						case "edittrading":
							include("edittrading.php");

							break;

						case "newbottomslide":
							include("newbottomslide.php");

							break;

						case "newtopslide":
							include("newtopslide.php");

							break;

						case "newlibrary":
							include("newlibrary.php");

							break;

						case "alltopslide":
							include("alltopsliders.php");

							break;

						case "edittopslide":
							include("edittopsliders.php");

							break;

						case "allbottomslide":
							include("allbottomsliders.php");

							break;

						case "editbottomslide":
							include("editbottomsliders.php");

							break;

						case "alllibrary":
							include("alllibrary.php");

							break;

						case "editlibrary":
							include("editlibrary.php");

							break;



						case "newblog":
							include("newblogpost.php");

							break;

						case "allblogposts":
							include("allposts.php");

							break;

						case "editblog":
							include("editblogpost.php");

							break;


						case "newstaff":
							include("newstaff.php");

							break;


						case "users":
							include("users.php");

							break;




						case "staffs":
							include("staffs.php");

							break;


						case "investments":
							include("investments.php");

							break;



						case "inspections":
							include("inspections.php");

							break;






						default:
							include("allproperties.php");
							break;
					}

					?>
				</div>
				<!-- /Row -->

			</div>

			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-5">
						<a href="dashboard.php" class="brand mr-30"><img src="dist/img/" alt="logo" /></a>
						<ul class="footer-link nav navbar-nav">

						</ul>
					</div>
					<div class="col-sm-7 text-right">
						<p>2021 &copy; . Powered by <a href="">Uppermark Solutions</a></p>
					</div>
				</div>
			</footer>
			<!-- /Footer -->

		</div>
		<!-- /Main Content -->
	</div>
	<!-- /#wrapper -->

	<!-- JavaScript -->

	<!-- jQuery -->
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Moment JavaScript -->
	<script type="text/javascript" src="vendors/bower_components/moment/min/moment-with-locales.min.js"></script>

	<!-- Bootstrap Colorpicker JavaScript -->
	<script src="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>

	<!-- Select2 JavaScript -->
	<script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

	<!-- Bootstrap Select JavaScript -->
	<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

	<!-- Bootstrap Tagsinput JavaScript -->
	<script src="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

	<!-- Bootstrap Touchspin JavaScript -->
	<script src="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>

	<!-- Multiselect JavaScript -->
	<script src="vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>


	<!-- Bootstrap Switch JavaScript -->
	<script src="vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

	<!-- Bootstrap Datetimepicker JavaScript -->
	<script type="text/javascript" src="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Form Advance Init JavaScript -->
	<script src="dist/js/form-advance-data.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>


	<!-- Tinymce JavaScript -->
	<script src="vendors/bower_components/tinymce/tinymce.min.js"></script>
	<script src="vendors/bower_components/ckeditor/ckeditor.js"></script>

	<!-- Tinymce Wysuhtml5 Init JavaScript -->
	<script src="dist/js/tinymce-data.js"></script>

	<!-- Bootstrap Switch JavaScript -->
	<script src="vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

	<script type="text/javascript" src="tableexport/tableExport.js"></script>
	<script type="text/javascript" src="tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="tableexport/html2canvas.js"></script>
	<script type="text/javascript" src="tableexport/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="tableexport/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="tableexport/jspdf/libs/base64.js"></script>

	<script src="vendors/bower_components/dropify/dist/js/dropify.min.js"></script>

	<!-- Form Flie Upload Data JavaScript -->
	<script src="dist/js/form-file-upload-data.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>



	<script>
		function publish(pid) {
			$.get('publish.php', {
				pid: pid,
				action: "publish"
			}, function(data) {
				//if(data == 'true'){
				$("#pdpublish" + pid).addClass("hide");
				$("#pdunpublish" + pid).removeClass("hide");
				//}
			});
		}

		function unpublish(pid) {
			$.get('publish.php', {
				pid: pid,
				action: "unpublish"
			}, function(data) {
				//if(data == 'true'){
				$("#pdunpublish" + pid).addClass("hide");
				$("#pdpublish" + pid).removeClass("hide");
				//}
			});
		}

		function showtrack(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "showtrack"
			}, function(data) {
				//if(data == 'true'){

				$("#trkshow" + pid).addClass("hide");
				$("#trkhide" + pid).removeClass("hide");
				//}
			});
		}

		function hidetrack(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "hidetrack"
			}, function(data) {
				//if(data == 'true'){
				$("#trkhide" + pid).addClass("hide");
				$("#trkshow" + pid).removeClass("hide");
				//}
			});
		}

		function showcategory(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "showcategory"
			}, function(data) {
				//if(data == 'true'){

				$("#categoryshow" + pid).addClass("hide");
				$("#categoryhide" + pid).removeClass("hide");
				//}
			});
		}

		function hidecategory(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "hidecategory"
			}, function(data) {
				//if(data == 'true'){
				$("#categoryhide" + pid).addClass("hide");
				$("#categoryshow" + pid).removeClass("hide");
				//}
			});
		}

		function addhot(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "addhot"
			}, function(data) {
				//if(data == 'true'){
				$("#addhot" + pid).addClass("hide");
				$("#removehot" + pid).removeClass("hide");
				//}
			});
		}


		function removehot(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "removehot"
			}, function(data) {
				//if(data == 'true'){
				$("#removehot" + pid).addClass("hide");
				$("#addhot" + pid).removeClass("hide");
				//}
			});
		}

		function hidenews(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "unpublishnews"
			}, function(data) {
				//if(data == 'true'){
				$("#newshide" + pid).addClass("hide");
				$("#newsshow" + pid).removeClass("hide");
				//}
			});
		}

		function shownews(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "publishnews"
			}, function(data) {
				//if(data == 'true'){
				$("#newsshow" + pid).addClass("hide");
				$("#newshide" + pid).removeClass("hide");
				//}
			});
		}

		function disprovemember(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "disproveuser"
			}, function(data) {
				//if(data == 'true'){
				$("#memhide" + pid).addClass("hide");
				$("#memshow" + pid).removeClass("hide");
				//}
			});
		}

		function approvemember(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "approveuser"
			}, function(data) {
				//if(data == 'true'){
				$("#memshow" + pid).addClass("hide");
				$("#memhide" + pid).removeClass("hide");
				//}
			});
		}

		function closevoting(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "closevoting"
			}, function(data) {
				//if(data == 'true'){
				$("#votesclose" + pid).addClass("hide");
				$("#votesopen" + pid).removeClass("hide");
				//}
			});
		}

		function openvoting(pid) {
			$.get('activateproduct.php', {
				pid: pid,
				action: "openvoting"
			}, function(data) {
				//if(data == 'true'){
				$("#votesopen" + pid).addClass("hide");
				$("#votesclose" + pid).removeClass("hide");
				//}
			});
		}

		function bannerdisprove(pid) {
			$.get('../activateproduct.php', {
				pid: pid,
				action: "bannerdisprove"
			}, function(data) {
				//if(data == 'true'){
				$("#bannerdisprove" + pid).addClass("hide");
				$("#bannerapprove" + pid).removeClass("hide");
				//}
			});
		}

		function bannerapprove(pid) {
			$.get('../activateproduct.php', {
				pid: pid,
				action: "bannerapprove"
			}, function(data) {
				//if(data == 'true'){
				$("#bannerapprove" + pid).addClass("hide");
				$("#bannerdisprove" + pid).removeClass("hide");
				//}
			});
		}

		function approvepay(pid, dues) {
			$.get('activateproduct.php', {
				pid: pid,
				dues: dues,
				action: "approvepay"
			}, function(data) {
				//if(data == 'true'){
				$("#approvepay" + pid).addClass("hide");
				$("#approved" + pid).append("Approved");
				//}
			});
		}

		function myFunction(pid, dues) {

			var r = confirm("Are you sure you want to confirm this payment? This action is not reversible.");
			if (r == true) {


				approvepay(pid, dues);

			} else {

			}

		}
	</script>


	<script>
		$(document).ready(function() {

			$("#imglist").load("listimages.php");
			$("#but_upload").click(function() {

				$("#but_upload").val("Uploading...");
				var fd = new FormData();
				var files = $('#file')[0].files[0];
				fd.append('file', files);

				$.ajax({
					url: 'imgupload.php',
					type: 'post',
					data: fd,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response == "0") {
							$("#imglist").load("listimages.php");
							$("#file").val("");
							$("#but_upload").val("Upload");
							//$(".preview img").show(); // Display image element
						} else {
							alert('file not uploaded');
						}
					},
				});
			});
		});

		function insertImageUrl(someText) {

			var imglink = "<img src='../admin/uploads/" + someText + "' />";
			CKEDITOR.instances.jsckeditor.insertHtml(imglink);
		}

		var uiHelperCkeditor = function() {
			// Disable auto init when contenteditable property is set to true
			CKEDITOR.disableAutoInline = true;

			// Init inline text editor
			if (jQuery('#js-ckeditor-inline').length) {
				CKEDITOR.inline('js-ckeditor-inline');
			}

			// Init full text editor
			if (jQuery('#js-ckeditor').length) {
				CKEDITOR.replace('js-ckeditor');
			}

			// Init full text editor
			if (jQuery('#jsckeditor').length) {
				CKEDITOR.replace('jsckeditor');
			}

			if (jQuery('#js-ckeditor2').length) {
				CKEDITOR.replace('js-ckeditor2');
			}

			if (jQuery('#js-ckeditor3').length) {
				CKEDITOR.replace('js-ckeditor3');
			}

			if (jQuery('#js-ckeditor4').length) {
				CKEDITOR.replace('js-ckeditor4');
			}

			if (jQuery('#js-ckeditor5').length) {
				CKEDITOR.replace('js-ckeditor5');
			}

			if (jQuery('#js-ckeditor6').length) {
				CKEDITOR.replace('js-ckeditor6');
			}
		};

		uiHelperCkeditor();
	</script>
</body>

</html>