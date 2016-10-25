<?php
if(isset($_POST['tag']) && $_POST['tag'] != '') {
    // get tag
    $tag = $_POST['tag'];
 
    // include db handler
    require_once 'include/DB_Functions.php';
    $db = new DB_Functions();
 
    // response Array
    $response = array("tag" => $tag, "error" => "0");
 
    // check for tag type
    if ($tag == 'login') {
        // Request type is check Login
        $email = $_POST['email'];
        $password = $_POST['password'];
        // check for user
        $user = $db->getUserByEmailAndPassword($email, $password);
        if ($user != false) {
            // user found
            $response["error"] = "0";
            $response["uid"] = $user["uniqueid"];
            $response["user"]["fname"] = $user["fname"];
            $response["user"]["lname"] = $user["lname"];
            $response["user"]["email"] = $user["email"];

            if($user["androidid"]==null){
                $response["user"]["gcmid"] = "NULL";
            }else{
                $response["user"]["gcmid"] = $user["androidid"];
            }
            echo json_encode($response);
        } else {
            // user not found
            // echo json with error = 1
            $response["error"] = "1";
            $response["error_msg"] = "Incorrect email or password!";
            echo json_encode($response);
        }
    } else if ($tag == 'register') {
        // Request type is Register new user
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];        
        $password = $_POST['password'];
        $bgroup = $_POST['bgroup'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $forall = $_POST['forall'];
        $vphone = $_POST['vphone'];
        $emailpref = $_POST['emailpref'];
        $androidid = $_POST['gcmid'];
        // check if user is already existed
        if ($db->isUserExisted($email)) {
            // user is already existed - error response
            $response["error"] = "1";
            $response["error_msg"] = "User already exists";
            echo json_encode($response);
        } else {
            // store user
            $user = $db->storeUser($fname, $lname, $email, $password, $bgroup, $phone, $city, $forall, $vphone, $emailpref, $androidid);
            if ($user) {
                // user stored successfully
                $response["error"] = "0";
                $response["uid"] = $user["uniqueid"];
                $response["user"]["fname"] = $user["fname"];
                $response["user"]["lname"] = $user["lname"];
                $response["user"]["email"] = $user["email"];
                $message = 'Hello '. $fname . ' '. $lname .", \r\n". "Welcome to Blood Donation System. Your account has been created successfully. Your login credentials are as follows: \r\n Login ID: ".$email ."\r\n". "Password: ". $password. "\r\n" . "To login, please follow the following link: <a href='http://www.aneeshbhatnagar.com/blood/login.php' target='_blank'>http://www.aneeshbhatnagar.com/blood/login.php</a>";
                $to = $email;
                $subject = 'New Account Registration on Blood Donation System';
                $header = 'From: '. 'Blood Donation System' . '<no-reply@aneeshbhatnagar.com>'. "\r\n" . 'Reply-To: '.'contact@aneeshbhatnagar.com' . "\r\n". 'X-Mailer: PHP/'.phpversion();
                mail($to,$subject,$message,$header);
                echo json_encode($response);
            } else {
                // user failed to store
                $response["error"] = "2";
                $response["error_msg"] = "Database error occured in Registartion";
                echo json_encode($response);
            }
        }
    } else if ($tag == 'gcmreg') {
        // Request type is Register new user
        $uid = $_POST['uid'];
        $gcmid = $_POST['gcmid'];
        
        $result = $db->storeGcm($uid,$gcmid);

        if($result){
            $response["error"] = "0";
            $response["error_msg"] = "Updated!";
            echo json_encode($response);
        }else{
            $response["error"] = "2";
            $response["error_msg"] = "Database error occured in Push Notification Registration";
            echo json_encode($response);
        }

        
    } else {
        // user failed to store
        $response["error"] = "3";
        $response["error_msg"] = "Unknow 'tag' value. It should be either 'login' or 'register'";
        echo json_encode($response);
    }
} else {
    $response["error"] = "3";
    $response["error_msg"] = "Required parameter 'tag' is missing!";
    echo json_encode($response);
}
?>