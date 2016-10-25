<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>Register | Blood Donation Initiative</title>
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
								echo'<li class="current"><a href="register.php">Register</a></li><li><a href="login.php">Sign In</a></li>';
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
		  <li class="active">Register</li>
		</ol>
		<!-- BreadCrumbs End
		=========== -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php
						require_once __DIR__ . '/db_connect.php';
						$db = new DB_CONNECT();
						if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['emailId']) && isset($_POST['phone']) && isset($_POST['password1']) && isset($_POST['bgroup']) && isset($_POST['city'])) {
								$fname = $_POST['fname'];
								$lname = $_POST['lname'];
								$pass = $_POST['password1'];
								$email = $_POST['emailId'];
								$bgroup = $_POST['bgroup'];
								$phone = $_POST['phone'];
								$city = $_POST['city'];
								$forall = false;
								$vphone = false;
								$emailpref = false;

								if(isset($_POST['forall'])){
									$forall = true;
								}
								if(isset($_POST['visiblephone'])){
									$vphone = true;
								}
								if(isset($_POST['emailpref'])){
									$emailpref = true;
								}
								$uuid = uniqid('', true);
								$salt = sha1(rand());
						        $salt = substr($salt, 0, 10);
						        $encrypted = base64_encode(sha1($pass . $salt, true) . $salt);
								$result = mysql_query("INSERT INTO users(uniqueid, fname, lname, email, password, phone, city, emailpref, phonepref, bloodgroup, notifgroup, salt) VALUES('$uuid', '$fname', '$lname', '$email', '$encrypted', '$phone', '$city', '$emailpref', '$vphone', '$bgroup', '$forall', '$salt')");
								
								if($result){
									/*Send Email */
									$message = 'Hello '. $fname . ' '. $lname .", \r\n". "Welcome to Blood Donation System. Your account has been created successfully. Your login credentials are as follows: \r\n Login ID: ".$email ."\r\n". "Password: ". $pass. "\r\n" . "To login, please follow the following link: <a href='http://www.aneeshbhatnagar.com/blood/login.php' target='_blank'>http://www.aneeshbhatnagar.com/blood/login.php</a>";
									$to = $email;
									$subject = 'New Account Registration on Blood Donation System';
									$header = 'From: '. 'Blood Donation System' . '<no-reply@aneeshbhatnagar.com>'. "\r\n" . 'Reply-To: '.'contact@aneeshbhatnagar.com' . "\r\n". 'X-Mailer: PHP/'.phpversion();
									mail($to,$subject,$message,$header);
									echo '<h4>Your account has been successfully created. Please check your email for your account details.</h4><p> Please proceed to logging in to the system now by <a href="login.php">Clicking here</a></p>';
								}
								else{
									echo '<h4>It seems you have an account with the provided email ID already.</h4><p><a href="forgot.php">Click here</a> to go to the forgot password page.</p>';
								}
						}
						else if(isset($_SESSION['login'])){
							header('Location: preferences.php ');
						}
						else{
							echo '<h3>It seems you forgot to enter every field in the form!<br/>Please go back and enter all the required data.</h3><p><a href="#" class="go-back">Click here</a> to go back</p>';
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
		$(".go-back").click(function(e){
			e.preventDefault();
			history.go(-1);
		});
	</script>
</body>
</html>