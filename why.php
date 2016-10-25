<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>Why Donate | Blood Donation Initiative</title>
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
						<li class="current"><a href="why.php">Why Donate</a></li>
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
		  <li class="active">Why Donate</li>
		</ol>
		<!-- BreadCrumbs End
		=========== -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>Why Donate Blood?</h1>
				<div style="width:62%;">
					<p>You don't need a special reason to give blood. <strong>You just need your own reason.</strong> Here are a few reasons why people donate blood and why you should start donating blood now!</p>
					<ul>
						<li><strong>Save multiple Lives</strong>
							<p>When you donate a single unit of blood, it can save upto 3 lives. Donated blood can be split into red blood cells, plasma and platelets, which can be provided in cases of emergency to three different patients.</p>
						</li>
						<li><strong>Help a friend</strong>
							<p>A lot of blood banks have a rule that in order for them to provide you a unit of blood, you must donate one bottle of blood, irrespective of the blood group. So in such cases, you can donate to help any of your close friend or family member.</p>
						</li>
						<li><strong>Donate for free health checkup</strong>
							<p>Well, this is a trick one. When you donate blood at any event, you undergo a mini-health checkup in which the doctors check your blood pressure, haemoglobin level and blood sugar level. When you donate, you don't need to pay to get these tests done!</p>
						</li>					
						<li><strong>Makes you feel good</strong>
							<p>The last reason is pretty self explanatory. When you help other people, there's a feeeling from inside that tells you that you've done something good today. There's nothing that can beat that feeling! </p>
						</li>
					</ul>
				</div>
				<br/><br/><br/>
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