<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>Forgot Password | Blood Donation Initiative</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<!-- Navigation Bar
	============!-->

	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="index.php" class="navbar-brand"><img src="img/logo.png"></a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="about.php">About Initiative</a></li>
						<li><a href="faq.php">FAQs</a></li>
						<li><a href="why.php">Why Donate</a></li>
						<li><a href="bloodbank.php">Nearest Blood Bank</a></li>
						<?php
							if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')){
								echo'<li><a href="register.php">Register</a></li><li><a href="login.php">Sign In</a></li>';
							}
							else{
								echo'<li class="dropdown">
								<a class="dropdown-toggle" href="#" data-toggle="dropdown">My Account <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="preferences.php">Preferences</a></li>
									
									<li><a href="request.php">Request Blood</a></li>
									<li><a href="logout.php">Logout</a></li>
								</ul>
							</li>';
						}
						?>
					</ul>
				</div>
		</div>
	</div>

	<!-- Navigation BAR END ================ -->

	<!-- Main Content Area
	================== -->
	<div class="container container-main">
		<!-- BreadCrumbs 
		=========== -->
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Forgot Password</li>
		</ol>
		<!-- BreadCrumbs End
		=========== -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>Forgot Password</h1>
				<?php
					if(isset($_SESSION['login'])){
						header('Location: preferences.php ');
					}
					else{
						echo '<form style="width:40%; margin:0 auto;" action="forgot2.php" method="post">
				  <div class="form-group">
				    <label for="email">Email address</label>
				    <input type="email" class="form-control" name="email" placeholder="Enter your email address">
				  </div>
				  <button type="submit" class="btn btn-success">Email Password</button>
				</form>';
					}
				?>
			</div>
		</div>
	</div>

	<!-- Main Content Area End
	================== -->

	<!-- Footer Area 
	================== -->
	<footer>
		<p><a href="#"><img src="img/android.png" class="footer-icon" /></a><a href="index.php">HOME</a> | <a href="about.php">ABOUT</a> | <a href="bloodbank.php">NEAREST BLOOD BANK</a></p>
	</footer>
	<!-- Footer Area End
	================= -->

<!-- JavaScript Files
	============== -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(".carousel").carousel();
	</script>
</body>
</html>