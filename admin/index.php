<?php
session_start();
include("../connect.php");
include("../functions.php");

if (isset($_COOKIE["uid"])) {
	$uid = $_COOKIE["uid"];
	$eml = $_COOKIE["eml"];
}

if (isset($_POST['username'])) {

	$email = $_POST['username'];
	$password = $_POST['userpass'];

	$rtn = loginadmin($email, $password);
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


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Lawrevee Admin</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Okechukwu Onwuemenyi" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- vector map CSS -->
	<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css" />



	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>


	<div class="wrapper pa-0">

		<!-- Main Content -->
		<div class="page-wrapper pa-0 ma-0">
			<div class="container-fluid">
				<!-- Row -->

				<div class="table-struct full-width full-height">
					<div class="table-cell vertical-align-middle">
						<div class="auth-form  ml-auto mr-auto no-float">
							<div class="panel panel-default card-view mb-0">
								<div class="panel-heading">
									<div class="row">

										<img src="" width="300px" alt="Logo" class="col-sm-4 col-sm-offset-4">
									</div>
									<br>
									<div class="col-sm-4 col-sm-offset-4">
										<h6 class="panel-title txt-dark">Sign In</h6>
									</div>

									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<?php
										if (isset($rtn)) {
										?>
											<div class="row">
												<div class="alert alert-danger"><?php echo $rtn; ?></div>
											</div>
										<?php
										}
										?>
										<div class="row">
											<div class="col-sm-12 col-xs-12">
												<div class="form-wrap">
													<form method="post">
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputEmail_2">Username</label>
															<div class="input-group">
																<input type="text" class="form-control" required id="exampleInputEmail_2" placeholder="Enter username" name="username">
																<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label mb-10" for="exampleInputpwd_2">Password</label>
															<div class="input-group">
																<input type="password" class="form-control" required id="exampleInputpwd_2" placeholder="Enter pwd" name="userpass">
																<div class="input-group-addon"><i class="icon-lock"></i></div>
															</div>
														</div>

														<div class="form-group">

														</div>
														<div class="form-group">
															<button type="submit" class="btn btn-danger btn-block">sign in</button>
														</div>

													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->
			</div>

		</div>
		<!-- /Main Content -->

	</div>
	<!-- /#wrapper -->

	<!-- JavaScript -->

	<!-- jQuery -->
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
</body>

</html>