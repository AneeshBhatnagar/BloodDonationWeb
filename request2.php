<?php
	session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<title>Request Blood | Blood Donation Initiative</title>
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
		  <li class="active">Request Blood</li>
		</ol>
		<!-- BreadCrumbs End
		=========== -->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>Request Blood</h1>
				<div style="width:62%;">
					<?php
						require_once 'api/include/DB_Functions.php';
					    include 'api/gcm.php';
					    $db = new DB_Functions();
						if (isset($_POST['bgroup']) && isset($_POST['phone']) && isset($_POST['location'])) {
							$bgroup = $_POST['bgroup'];
							$contact = $_POST['phone'];
							$location = $_POST['location'];
							$sender = $_SESSION['uid'];
							$reg_ids = array();
							if($db->storeRequest($sender, $bgroup, $location, $contact)){
					     		$result = $db->getNotifAllUsers();
						     	while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
						     		if($sender!=$row['uniqueid']){
							            $to = $row['email'];
							            $message = 'Hello '. $row['fname'] . ' '. $row['lname'] .", \r\n". "There is urgent need for blood. Here are the details about the same: \r\n Blood Group: ".$bgroup ."\r\n". "Location: ". $location. "\r\n" . "Contact Number: ". $contact. "\r\n" . "Please contact the person on the above mentioned phone number if you can be available to donate blood."."\r\n". "You have received this message because you opted to receive notification for all blood groups. You can change this by editing your preferences in your account on our website.";
						                $subject = 'Urgent need for Blood of type: '.$bgroup;
						                $header = 'From: '. 'Blood Donation System' . '<no-reply@aneeshbhatnagar.com>'. "\r\n" . 'Reply-To: '.'contact@aneeshbhatnagar.com' . "\r\n". 'X-Mailer: PHP/'.phpversion();
						                if($row['emailpref'] == 1){
						                	mail($to,$subject,$message,$header);
						                }
						                if($row['androidid'] != null){
						                    array_push($reg_ids, $row['androidid']);
						                }
						            }
						        }            
						        $result = $db->getBloodGroupUsers($bgroup);
						        $num = mysql_num_rows($result);
						        if($num > 0){
						        	while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
						        		if($sender!=$row['uniqueid']){
								            $to = $row['email'];
								            $message = 'Hello '. $row['fname'] . ' '. $row['lname'] .", \r\n". "There is urgent need for blood. Here are the details about the same: \r\n Blood Group: ".$bgroup ."\r\n". "Location: ". $location. "\r\n" . "Contact Number: ". $contact. "\r\n" . "Please contact the person on the above mentioned phone number if you can be available to donate blood."."\r\n";
							                $subject = 'Urgent need for Blood of type: '.$bgroup;
							                $header = 'From: '. 'Blood Donation System' . '<no-reply@aneeshbhatnagar.com>'. "\r\n" . 'Reply-To: '.'contact@aneeshbhatnagar.com' . "\r\n". 'X-Mailer: PHP/'.phpversion();
							                if($row['emailpref'] == 1){
							                	mail($to,$subject,$message,$header);
							                }
						                    if($row['androidid'] != null){
						                        array_push($reg_ids, $row['androidid']);
						                    }
						                }
							        }
						        }
					            $respJSON = '{"bgroup":"'. $bgroup.'","contact":"'.$contact.'","location":"'.$location.'"}';
					            $messagePush = array("m" => $respJSON);
					            sendPushNotificationToGCM($reg_ids, $messagePush);

						        echo '<h3>We have sent out an email and push notificaitons to all our donors, about this blood request. They will get in touch with you at the described location on the given Phone number. Please sit back and relax now! Someone will come to help you ASAP.</h3>';

					     	}else{
					     		echo '<h3>There seems to be some error connecting to our database at the moment. Please try again later!</h3>';
					     	}	
								
						}
						else{
							echo '<h3>It seems you forgot to enter every field in the form!<br/>Please go back and enter all the required data.</h3><p><a href="#" class="go-back">Click here</a> to go back</p>';
						}
					?>
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
		$(".go-back").click(function(e){
			e.preventDefault();
			history.go(-1);
		});
	</script>
</body>
</html>