<?php
require_once('db_operation.php');
require_once('log_auth.php');
ini_set("soap.wsdl_cache_enabled", "0");

function isPasswordValid($password, $minLength, $maxLength) {
    $passwordLength = strlen($password);
    if ($passwordLength < $minLength) {
        return false; 
    } elseif ($passwordLength > $maxLength) {
        return false; 
    }
    return true; 
}

function userCreate($username,$password){
    if($username && $password){
        //default user level 'user'
        $user_level = 'user';
        $message = null;
        // validate format username
        $user_name_check = getUsername($username);

        if($username == $user_name_check['username']){
            $message = "$username in used, please try again";
        }
        else{
            // validate password format pwd,min,max
            if (isPasswordValid($password, 8, 20)) {
                // hash password
                $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
                // save to databse
                createUsr($username,$hashedPwd,$user_level);
                $message = "Create $username Success";
            } else {
                $message = "Require minimum 8 character, please try again";
            } 
        }
    } else{
        $message = "Empty field";
    }

    logMessage($message);
    echo $message;
    return $message;
}

function usrPwdAuth($username,$password){
    if($username && $password){
        $message = null;
        $data = machingUsr($username);
        if($data){
            $storedHashedPassword = $data['password'];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            if (password_verify($password, $storedHashedPassword)) {
                $message = "Authentication successful";
            } else {
                $message ="username or password was wrong";
            }   
        } else {
            $message = "username or password was wrong"; 
        } 
    }
    else{
         $message = "Empty field";
    }

    logMessage($message);
    echo $message;
    return $message;
}

$server = new SoapServer("wsdl/auth.wsdl");
$server->addFunction("userCreate");
$server->addFunction("usrPwdAuth");
$server->handle();
?>