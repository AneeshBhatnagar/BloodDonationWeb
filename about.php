<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>About this Initiative | Blood Donation Initiative</title>
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
						<li class="current"><a href="about.php">About Initiative</a></li>
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
		  <li class="active">About Initiative</li>
		</ol>
		<!-- BreadCrumbs End
		=========== -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>About this Initiative</h1>
				<div style="width:62%;">
					<p>This is an initiative by <strong>Aneesh Bhatnagar</strong>, a computer science student who felt the need for such a service where people can request for blood, and anyone who has the andorid application installed, would get a notification about the same. This would make saving peoples life much easier in cases where a blood donor can not be found. Here are a few salient features about the initiative:</p>
					<ul>
						<li><strong>A web interface where you can manage all tasks related to donating and requesting blood</strong><br/>
							<p>The application developed has a web interface, along with an Android application, to provide you with more options to find donors, or to provide yourself as a donor.</p>
						</li>
						<li><strong>An Android application to run on your smartphone to allow managing these tasks on the go</strong>
							<p>The Android application runs on most of the modern Android powered smartphones. If you own an Android phone, you can download the app for our initiative by <a href="#" style="text-decoration:underline;">clicking here</a>.</p>
						</li>
						<li><strong>Email and push notifications to all users who have opted for the same</strong>
							<p>When you register for this, we will ask you if you want email Notifications and push notifications, along with an option to receive notifications for all blood groups, apart from your blood group.</p>
						</li>
						<li><strong>Notifications for all blood groups</strong>
							<p>Within the application, web and Android both, there is an option to enable notifications for all blood groups, so that when you're with a group of people, you can see if any one around you can donate blood for that blood group, and respond accordingly.</p>
						</li>
						<li><strong>Getting approval for the application from Rotary Blood Bank</strong>
							<p>I am in talks with the Rotary Blood Bank in New Delhi, and trying to convince them about this idea and it's benefits. If they like the idea, it can be taken to a whole new level.</p>
						</li>						
					</ul>
				</div>
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