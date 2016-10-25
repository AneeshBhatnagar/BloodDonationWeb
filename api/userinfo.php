<?php
if(isset($_POST['tag']) && $_POST['tag'] != '') {
	 $tag = $_POST['tag'];
	 require_once 'include/DB_Functions.php';
     $db = new DB_Functions();
     $response = array("tag" => $tag, "error" => "0");

     if ($tag == 'userinfo'){
     	if(isset($_POST['uuid']) && !empty($_POST['uuid'])){
	     	$uuid = $_POST['uuid'];
	     	$user = $db->getUserByUID($uuid);
	     	if ($user != false) {
				$response["error"] = "0";
				$response["error_msg"] = "User Details are here!";
				$response['fname'] = $user['fname'];
				$response['lname'] = $user['lname'];
				$response['email'] = $user['email'];
				$response['phone'] = $user['phone'];
				$response['city'] = $user['city'];
				$response['emailpref'] = $user['emailpref'];
				$response['phonepref'] = $user['phonepref'];
				$response['bloodgroup'] = $user['bloodgroup'];
				$response['notifgroup'] = $user['notifgroup'];
				echo json_encode($response); 
			}else{
				$response["error"] = "1";
	            $response["error_msg"] = "Incorrect User ID!";
	            echo json_encode($response);
			}
		}else{
			$response["error"] = "1";
            $response["error_msg"] = "No User ID entered!";
            echo json_encode($response);
		}

     }else if ($tag == 'updateuser'){
     	if(isset($_POST['uuid']) && !empty($_POST['uuid'])){
	     	$uuid = $_POST['uuid'];
	     	$emailpref = $_POST['emailpref'];
	     	$phonepref = $_POST['phonepref'];
	     	$notifgroup = $_POST['notifgroup'];

	     	$query = "UPDATE users SET emailpref='$emailpref', notifgroup='$notifgroup', phonepref='$phonepref' WHERE uniqueid ='$uuid'";
	     	$user = $db->updateDatabaseQuery($query);
	     	if ($user != false) {
				$response["error"] = "0";
				$response["error_msg"] = "User Preferences Updated!";
				echo json_encode($response); 
			}else{
				$response["error"] = "1";
	            $response["error_msg"] = "Incorrect User ID!";
	            echo json_encode($response);
			}
		}else{
			$response["error"] = "1";
            $response["error_msg"] = "No User ID entered!";
            echo json_encode($response);
		}

     }else if($tag == 'changepass'){
     	if(isset($_POST['uuid']) && !empty($_POST['uuid'])){
     		$uuid = $_POST['uuid'];
     		$pass = $_POST['password'];
     		$newpass = $_POST['newpass'];
     		$user = $db->updateUserPassword($uuid,$pass,$newpass);
     		if ($user != false) {
				$response["error"] = "0";
				$response["error_msg"] = "Password Updated!";
				echo json_encode($response); 
			}else{
				$response["error"] = "1";
	            $response["error_msg"] = "Incorrect current password entered";
	            echo json_encode($response);
			}

     	}else{
     		$response["error"] = "1";
	            $response["error_msg"] = "Incorrect User ID!";
	            echo json_encode($response);
     	}

     }else{
     	$response["error"] = "3";
        $response["error_msg"] = "Unknow 'tag' value. It should be for user info or user updation.";
        echo json_encode($response);
     }

}else {
    $response["error"] = "3";
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>