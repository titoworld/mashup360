<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<? include("../config.php") ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" href="plugins/uniform/css/uniform.default.css" media="screen">
<link rel="stylesheet" href="assets/css/fonts/icomoon/style.css" media="screen">
<link rel="stylesheet" href="assets/css/login.css" media="screen">
<title>Mashup360 :: Administració Backend</title>
</head>
<body>
    <div id="login-wrap">
    	<div id="login-logo"><img src="images/logo.png" alt="logo" /></div>
		<div id="login-inner" class="login-inset">
			<div id="login-circle">
				<section id="login-form" class="login-inner-form" data-angle="0">
					<h1>Login</h1>
					<div class="form-vertical">
						<div class="control-group-merged">
							<div class="control-group">
								<input type="text" placeholder="Username" name="username" id="input-username" class="big required">
							</div>
							<div class="control-group">
								<input type="password" placeholder="Password" name="passw" id="input-password" class="big required">
								<input type="hidden" name="section" value="users">
							</div>
						</div>
						<div class="form-actions">
							<button id="loginButt" class="btn btn-success btn-block btn-large">Login</button>
						</div>
					</div>
				</section>

			</div>
		</div>
    </div>
	<!-- Core Scripts -->
	<script src="assets/js/libs/jquery-1.8.3.min.js"></script>
	<script src="assets/js/libs/jquery.placeholder.min.js"></script>
    
    <!-- Login Script -->
     <script src="js/md5.js"></script>
     <script src="js/login.js"></script>
    <script src="assets/js/login.js"></script>
    <!-- Validation -->
    <script src="plugins/validate/jquery.validate.min.js"></script>

    <!-- Uniform Script -->
    <script src="plugins/uniform/jquery.uniform.min.js"></script>

</body>

</html>
