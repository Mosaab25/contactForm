<?php

    $list = array("firstname" => "", "lastname" => "", "email" => "", "phone" => "", "message" => "", "firstnameError" => "", "lastnameError" => "", "emailError" => "", "phoneError" => "", "messageError" => "", "isSuccess" => false);
    
    $emailTo = "mosaab.dhaim@gmail.com";


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $list["firstname"] = verifyInput($_POST["firstname"]);
        $list["lastname"] = verifyInput($_POST["lastname"]);
        $list["email"] = verifyInput($_POST["email"]);
        $list["phone"] = verifyInput($_POST["phone"]);
        $list["message"] = verifyInput($_POST["message"]);
        $list["isSuccess"] = true;
        $emailText = "";
        
        if(empty($list["firstname"])){
             $list["firstnameError"]= " What's your first name ?";
            $list["isSuccess"] = false;
        }else{
          $emailText .= "First name: {$list["firstname"]} \n";  
        }
        if(empty($list["lastname"])){
            $list["lastnameError"] = " What's your last name ?";
            $list["isSuccess"] = false;
        }else{
          $emailText .= "Last name: {$list["lastname"]} \n";  
        }
        if(!isEmail($list["email"])){
            $list["emailError"] = " Invalid Email. Please try again";
            $list["isSuccess"] = false;
        }else{
          $emailText .= "Email: {$list["email"]} \n";  
        }
        
        if(!isPhone($list["phone"])){
            $list["phoneError"] = " Invalid phone number(example: 0033 6 54 63 78 95). Please try again";
            $list["isSuccess"] = false;
        }else{
          $emailText .= "Phone number:{$list["phone"]}\n";  
        }
        
        if(empty($list["message"])){
            $list["messageError"] = " Please type your message ";
            $list["isSuccess"] = false;
        }else{
          $emailText .= "Message: {$list["message"]} \n";  
        }
        
        if($list["isSuccess"]){
            $headers = "From: {$list["firstname"]} {$list["lastname"]} <{$list["email"]}> \r\nReply-To: {$list["email"]}";
            mail($emailTo, "Message from your website", $emailText, $headers);
            
        }
        
        echo json_encode($list);
        
    }

    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
    
    function isPhone($var){
        return preg_match("/^[0-9 ]*$/",$var);
    }

    function verifyInput($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        
        return $var;
    }

?>