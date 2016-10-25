<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>Edit Password | Aneesh Bhatnagar</title>
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
					if(!isset($_SESSION['login'])){
						header('Location: login.php ');
					}
				?>
				<h1>Edit Password</h1>
				<form action="#" method="post">
					<label for="currentp">Current Password&nbsp; &nbsp;</label>
					<input type="password" name="currentp" placeholder="Enter Current Password"><br/><br/>
					<label for="newpass">New Password&nbsp; &nbsp;</label>
					<input type="password" name="newpass" placeholder="Enter New Password"><br/><br/>
					<label for="newpass2">Confirm new Password&nbsp; &nbsp;</label>
					<input type="password" name="newpass2" placeholder="Confirm New Password"><br/><br/>
					<button type="submit" class="btn btn-success">Update Password</button>
				</form>
				<?php
					require_once __DIR__ . '/db_connect.php';
					$db = new DB_CONNECT();
					if(isset($_POST['currentp']) && isset($_POST['newpass']) && isset($_POST['newpass2'])){
						if(empty($_POST['currentp']) || empty($_POST['newpass']) || empty($_POST['newpass2'])){
							echo 'Please enter all the fields';
						}
						else{				
							$currentp = $_POST['currentp'];			
							$newpass = $_POST['newpass'];			
							$newpass2 = $_POST['newpass2'];
							$uid = $_SESSION['uid'];

							if($newpass2 != $newpass){
								echo 'The new passwords that you entered do not match';
							}			
							else{
								$result = mysql_query("SELECT * from users WHERE uniqueid='$uid'");
								if($result){
									$num_rows = mysql_num_rows($result);
									if($num_rows > 0){
										$result = mysql_fetch_array($result);
										$salt = $result['salt'];
										$encrypted = base64_encode(sha1($currentp . $salt, true) . $salt);
										if($encrypted == $result["password"]){
											$encrypted = base64_encode(sha1($newpass . $salt, true) . $salt);
											$SQL = mysql_query("UPDATE users SET password='$encrypted' WHERE uniqueid ='$uid'");
											if($SQL){
												echo "Password Updated Successfully! <a href='preferences.php'>Click here</a> to go back!";
											}
											else{
												echo "Password Updation failed!";
											}
										}
										else{
											echo "The current password you entered is incorrect!";
										}
									}
								}
								else{
									echo "Server Error";
								}
							}
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