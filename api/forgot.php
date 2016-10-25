<?php
if(isset($_POST['tag']) && $_POST['tag'] != '') {
	 $tag = $_POST['tag'];
	 require_once 'include/DB_Functions.php';
     $db = new DB_Functions();
     $response = array("tag" => $tag, "error" => "0");

     if ($tag == 'forgot'){
     	if(isset($_POST['email']) && !empty($_POST['email'])){
	     	$email = $_POST['email'];
	     	$user = $db->getUserByEmail($email);
	     	if ($user != false) {
		     	$uuid = $user['uniqueid'];
				$fname = $user['fname'];
				$message = 'Hello '. $fname .", \r\n". "Someome tried to reset your password using the Forgot Password link on our website. If you did that, here are your details: \r\n Login ID: ".$email ."\r\n". "Password: <a href='http://www.aneeshbhatnagar.com/blood/changepass.php?id=\"$uuid\"'>Click here to change your password</a>". "\r\n" . "To login, please follow the following link: <a href='http://www.aneeshbhatnagar.com/blood/login.php' tarpost='_blank'>http://www.aneeshbhatnagar.com/blood/login.php</a>";
				$to = $email;
				$subject = 'Request to change your password';
				$header = 'From: '. 'Blood Donation System' . '<no-reply@aneeshbhatnagar.com>'. "\r\n" . 'Reply-To: '.'contact@aneeshbhatnagar.com' . "\r\n". 'X-Mailer: PHP/'.phpversion();
				mail($to,$subject,$message,$header);
				$response["error"] = "0";
				$response["error_msg"] = "Password Reset email sent!";
				echo json_encode($response); 
			}else{
				$response["error"] = "1";
	            $response["error_msg"] = "Email ID is not present in the system. Please Register with this email ID.";
	            echo json_encode($response);
			}
		}else{
			$response["error"] = "1";
            $response["error_msg"] = "No email ID entered!";
            echo json_encode($response);
		}

     }else{
     	$response["error"] = "3";
        $response["error_msg"] = "Unknow 'tag' value. It should be 'forgot'.";
        echo json_encode($response);
     }

}else {
    $response["error"] = "3";
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>