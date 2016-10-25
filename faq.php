<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>FAQs of Blood Donation | Blood Donation Initiative</title>
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
						<li class="current"><a href="faq.php">FAQs</a></li>
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
		  <li class="active">FAQs</li>
		</ol>
		<!-- BreadCrumbs End
		=========== -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>Frequently Asked Questions (FAQs)</h1>
				<div style="width:62%;">
					<p>Whenever people think of donating blood, they have few questions in mind. Here are answers to few of such questions.</p>
					<ul>
						<li><strong>Under which conditions can people not donate blood?</strong>
							<ol>
								<li>Women during pregenancy</li>
								<li>People suffering from AIDS</li>
								<li>If you've had Alcoholic drinks in the last 48 hours</li>
								<li>If you're under 18 years, or over 55 years of age</li>
								<li>If you don't meet the minimum haemoglobin level in your blood</li>
								<li>If you've donated blood anytime in the last three months</li>
								<li>If you're suffering from Thalassemia</li>
							</ol>
						</li>
						<li><strong>What is the time duration between two consecutive blood donations?</strong>
							<p>Usually there is a wait period of 3 months before you can donate blood again, but under certain circumstances, this condition can be waived off.</p>
						</li>
						<li><strong>What are the places that a person can donate blood at?</strong>
							<p>Blood can be donated at any of the following places:</p>
							<ol>
								<li>Any hospital that has a blood bank</li>
								<li>Any individual blood bank</li>
								<li>At any blood donation camp organized by various organizations</li>
							</ol>
						</li>
						<li><strong>What is the minimum Haemoglobin level required for blood donation in India?</strong>
							<ul>
								<li>Females require a minimum Haemoglobin level of 11</li>
								<li>Males require a minimum Haemoglobin level of 13</li>
							</ul>
						</li>
						<li><strong>How long does it take to donate a single unit of blood?</strong>
							<p>The entire process takes about one hour and 15 minutes; the actual donation of a pint of whole blood unit takes eight to 10 minutes. However, the time varies slightly with each person depending on several factors including the donor's health history and attendance at the blood drive.</p>
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