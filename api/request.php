<?php

if(isset($_POST['tag']) && $_POST['tag'] != '') {
	 $tag = $_POST['tag'];
	 require_once 'include/DB_Functions.php';
     include 'gcm.php';
     $db = new DB_Functions();
     $response = array("tag" => $tag, "error" => "0");

     if ($tag == 'request'){
        $reg_ids = array();
     	$bgroup = $_POST['bgroup'];
     	$sender = $_POST['sender'];
     	$location = $_POST['location'];
     	$contact = $_POST['contact'];
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
            sendPushNotificationToGCM(array_unique($reg_ids), $messagePush);

	        $response["error"] = "0";
        	$response["error_msg"] = "Blood Request successfully processed. Please wait for someone to call you pretty soon.";
        	echo json_encode($response);

     	}else{
     		$response["error"] = "2";
        	$response["error_msg"] = "Error Requesting Blood. Please try later.";
        	echo json_encode($response);
     	}	
     	
     	
     }else{
     	$response["error"] = "3";
        $response["error_msg"] = "Unknow 'tag' value. It should be 'request blood'.";
        echo json_encode($response);
     }

}else {
    $response["error"] = "3";
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>