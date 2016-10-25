<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>Preferences | Aneesh Bhatnagar</title>
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
								echo'<li class="dropdown current">
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
		  <?php if ((isset($_SESSION['login']) && $_SESSION['login'] != '')){
		  		echo '<li class="active">Preferences</li>';
		  	}
		  ?>
		</ol>
		<!-- BreadCrumbs End
		=========== -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php
					require_once __DIR__ . '/db_connect.php';
					$db = new DB_CONNECT();
					if (isset($_POST['email']) && isset($_POST['password'])) {
						$email1 = $_POST['email'];
						$password1 = $_POST['password'];
						$result = mysql_query("SELECT * FROM users WHERE email='$email1'");
						if($result){
							$num_rows = mysql_num_rows($result);
							if($num_rows > 0){
								$result = mysql_fetch_array($result);
								$salt = $result["salt"];
								$encrypted = base64_encode(sha1($password1 . $salt, true) . $salt);
								if($encrypted == $result["password"]){
									echo "Logged In";
									$_SESSION['login']=1;
									$_SESSION['uid']=$result['uniqueid'];
									sleep(2);
									header('Location: '.$_SERVER['REQUEST_URI']);
								}
								else{
									echo "<h2>Invalid Username/Password Entered!</h2><h4>Please <a href='login.php'>Go back</a> and try again!</h4>";
									echo "<p><a href='login.php'>Click Here</a> to go back.</p>";
								}
							}
							else{
								echo "<h2>Invalid Username/Password Entered!</h2><h4>Please <a href='login.php'>Go back</a> and try again!</h4>";
								echo "<p><a href='login.php'>Click Here</a> to go back.</p>";
							}
						}
						else
							echo "Error connecting to the Database";
					}
					else if(isset($_SESSION['login'])){
						$uid = $_SESSION['uid'];
						$result = mysql_query("SELECT * FROM users WHERE uniqueid='$uid'");
						if($result){
							$num_rows = mysql_num_rows($result);
							if($num_rows > 0){
								$result = mysql_fetch_array($result);
								$name = $result['fname'] . " " . $result['lname'];
								echo '<h1>Preferences</h1>
								<p><strong>Name:</strong> '. $name . '</p><p><strong>Email ID:</strong> '. $result['email'] . '</p><p><strong>Password:</strong> [Hidden for account safety] <a href="editpass.php" style="color:red;">Edit Password</a></p>'.'<p><strong>Blood Group: </strong>'.$result['bloodgroup'].'</p><p><strong>Account preferences</strong></p>';
								echo '<form action="update-pref.php" method="post">';
								echo '<input type="hidden" name="update-pref" value="true">';
								if($result['emailpref']==0){
									echo '<input type="checkbox" name="emailpref"> Send me Email Notifications in case of emergency';
								}
								else{
									echo '<input type="checkbox" name="emailpref" checked> Send me Email Notifications in case of emergency';
								}

								if($result['phonepref']==0){
									echo '<br/><input type="checkbox" name="phonepref"> Phone number visible to others';
								}
								else{
									echo '<br/><input type="checkbox" name="phonepref" checked> Phone number visible to others';
								}

								if($result['notifgroup']==0){
									echo '<br/><input type="checkbox" name="notifgroup"> Send me notifications for all blood groups';
								}
								else{
									echo '<br/><input type="checkbox" name="notifgroup" checked> Send me notifications for all blood groups';
								}

								echo '<br/><br/><button type="submit" class="btn btn-success">Update Preferences</button></form>';
								
							}
							else
								echo"BYE";
						}	
					}
					else{
						header('Location: login.php ');
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