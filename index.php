<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>Blood Donation Initiative</title>
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

	<!--- Carousel
	============ -->

	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
			<div class="item active">
				<img src="img/banner1.jpg" class="img-responsive" />
			</div>
			<div class="item">
				<img src="img/banner2.jpg"  class="img-responsive" />
			</div>
			<div class="item">
				<img src="img/banner3.jpg"  class="img-responsive" />
			</div>
			<div class="item">
				<img src="img/banner4.jpg"  class="img-responsive" />
			</div>
		</div>
		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		</a>
	</div>

	<!-- Carousel End
	============== -->

	<!-- Main Content Area
	================== -->
	<div class="container container-main">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>Why Donate?</h1>
				<p>You don't need a special reason to give blood. <strong>You just need your own reason.</strong><br/>Here are a few reasons why people donate blood.</p>
				<ul>
					<li>Save multiple Lives</li>
					<li>Makes you feel good</li>
					<li>Donate for free health checkup</li>
					<li>Help a friend</li>
				</ul>
				<strong><a href="why.php" class="read-more">Read More</a></strong>
				<h1>About this Initiative</h1>
				<p>This is an initiative by <strong>Aneesh Bhatnagar</strong>, a computer science student who felt the need for such a service where people can request for blood, and anyone who has the andorid application installed, would get a notification about the same. This would make saving peoples life much easier in cases where a blood donor can not be found. Here are a few salient features about the initiative:</p>
				<ul>
					<li>A web interface where you can manage all tasks related to donating and requesting blood.</li>
					<li>An Android application to run on your smartphone to allow managing these tasks on the go.</li>
					<li>Email and push notifications to all users who have opted for the same.</li>
				</ul>
				<strong><a href="about.php" class="read-more">Read More</a></strong>
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