<?php
include("connect.php");
  include("functions.php");
  include("config.php");

 if(isset($_POST['useremail'])) {
                          
              $rtn = forgotpass($_POST['useremail']);
          }


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Membership Management System | Forgot Password</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="Okechukwu Onwuemenyi"/>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.png" type="image/x-icon">
		
		<!-- vector map CSS -->
		<link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
		
		
		
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
										
								<img src="dist/img/<?php echo getorglogo($org); ?>" alt="<?php echo getorgname($org); ?>" class="col-sm-4 col-sm-offset-4">
										</div>
							<br>
										
										<div class="col-sm-6 col-sm-offset-3">
											<h6 class="panel-title txt-dark">Forgot Password</h6>
										</div>
										
										<div class="clearfix"></div>
									</div>
									<div class="panel-wrapper collapse in">
										<div class="panel-body">
											<?php 
										if(isset($rtn)){
											?>
											<div class="row">
										<div class="alert alert-info"><?php echo $rtn; ?></div>
											</div>
										<?php
										}
										?>
											<div class="row">
												<div class="col-sm-12 col-xs-12">
													<div class="form-wrap">
														<form method="post">
															<div class="form-group">
																<label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
																<div class="input-group">
																	<input type="email" class="form-control" required id="exampleInputEmail_2" placeholder="Enter email" name="useremail">
																	<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																</div>
															</div>
															
															<div class="form-group">
																<button type="submit" class="btn btn-success btn-block">Reset Password</button>
															</div>
															<div class="form-group mb-0">
																
																<a class="inline-block txt-danger" href="index.php">Sign In</a>
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
