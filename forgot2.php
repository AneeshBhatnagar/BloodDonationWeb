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
						if(isset($_POST['email']) && !empty($_POST['email'])){
							require_once __DIR__ . '/db_connect.php';
							$db = new DB_CONNECT();
							$email = $_POST['email'];
							$result = mysql_query("SELECT * from users where email='$email'");
							if($result){
								$num_rows = mysql_num_rows($result);
								if($num_rows > 0){
									$result = mysql_fetch_array($result);
									$uuid = $result['uniqueid'];
									$fname = $result['fname'];

									$message = 'Hello '. $fname .", \r\n". "Someome tried to reset your password using the Forgot Password link on our website. If you did that, here are your details: \r\n Login ID: ".$email ."\r\n". "Password: <a href='http://www.aneeshbhatnagar.com/blood/changepass.php?id=\"$uuid\"'>Click here to change your password</a>". "\r\n" . "To login, please follow the following link: <a href='http://www.aneeshbhatnagar.com/blood/login.php' target='_blank'>http://www.aneeshbhatnagar.com/blood/login.php</a>";
									$to = $email;
									$subject = 'Request to change your password';
									$header = 'From: '. 'Blood Donation System' . '<no-reply@aneeshbhatnagar.com>'. "\r\n" . 'Reply-To: '.'contact@aneeshbhatnagar.com' . "\r\n". 'X-Mailer: PHP/'.phpversion();
									mail($to,$subject,$message,$header);
									echo '<p>Your password reset instructions have been emailed to you.</p><p>Please check your email ID for your password, and then login to the website again.</p>';
								}
								else{
									echo '<p>Your email address was not found in the database. Please check and enter again!</p>';
								}
							}
							else{
								echo "Error Connecting to Database!";
							}

						}	
						else{
							echo "<p>It seems there was some problem with your email ID. Please enter it again by going back. <a href='forgot.php'>Click here</a> to go back!</p>";
						}				

						
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