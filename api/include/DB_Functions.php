<?php
 
class DB_Functions {
 
    private $db;
 
    //put your code here
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }
 
    // destructor
    function __destruct() {
         $this->db->close();
    }
 
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($fname, $lname, $email, $password, $bgroup, $phone, $city, $forall, $vphone, $emailpref, $androidid) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        $result = mysql_query("INSERT INTO users(uniqueid, fname, lname, email, password, phone, city, emailpref, phonepref, bloodgroup, notifgroup, salt, androidid) VALUES('$uuid', '$fname', '$lname', '$email', '$encrypted_password', '$phone', '$city', '$emailpref', '$vphone', '$bgroup', '$forall', '$salt', '$androidid')");
        // check for successful store
        if ($result) {
            // get user details 
            $uid = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM users WHERE id = $uid");
            // return user details
            return mysql_fetch_array($result);
        } else {
            return false;
        }
    }

    public function storeRequest($sender, $bgroup, $location, $contact){
        $result = mysql_query("INSERT INTO request(requester, bgroup, location, contact) VALUES ('$sender', '$bgroup', '$location', '$contact')");
        if ($result) {
            return true;
        }
        else{
            return false;
        }
    }
 
    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {
        $result = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
            $salt = $result['salt'];
            $encrypted_password = $result['password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $result;
            }
        } else {
            // user not found
            return false;
        }
    }

    /* Get user details via Email only */

    public function getUserByEmail($email) {
        $result = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
               return $result;
        } else {
            // user not found
            return false;
        }
    }

    public function getUserByUID($uuid) {
        $result = mysql_query("SELECT * FROM users WHERE uniqueid = '$uuid'") or die(mysql_error());
        // check for result 
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            $result = mysql_fetch_array($result);
               return $result;
        } else {
            // user not found
            return false;
        }
    }

    public function updateDatabaseQuery($query) {
        $result = mysql_query($query) or die(mysql_error());
        if($result){
           return true;
        }
        return false;
    }

    public function storeGcm($uid, $gcmid) {
        $result = mysql_query("UPDATE users set androidid = '$gcmid' where uniqueid = '$uid'");
        // check for successful update
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateUserPassword($uuid, $pass, $newpass) {
        $result = mysql_query("SELECT * from users WHERE uniqueid='$uuid'");
        if ($result) {
                $num_rows = mysql_num_rows($result);
                if($num_rows > 0){
                    $result = mysql_fetch_array($result);
                    $salt = $result['salt'];
                    $encrypted = base64_encode(sha1($pass . $salt, true) . $salt);
                    if($result['password'] == $encrypted){
                        $encrypted = base64_encode(sha1($newpass . $salt, true) . $salt);
                        $SQL = mysql_query("UPDATE users SET password='$encrypted' WHERE uniqueid ='$uuid'");
                        if($SQL){
                            return true;
                        }
                    }
                }
        }
        return false;
    }

    public function getNotifAllUsers(){
        $result = mysql_query("SELECT * from users WHERE notifgroup = 1");
        return $result;
    }

    public function getBloodGroupUsers($bgroup){
        $result = mysql_query("SELECT * from users WHERE bloodgroup = '$bgroup' AND notifgroup = 0");
        return $result;
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT email from users WHERE email = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed 
            return true;
        } else {
            // user not existed
            return false;
        }
    }
 
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */    public function checkhashSSHA($salt, $password) {

        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        return $encrypted;
    }


 
}

?>