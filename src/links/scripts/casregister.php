<?php

if(!isset($_SESSION['registername'])){
    header("Location: register");
    die();
}

phpCAS::client(CAS_VERSION_3_0, $cas_host, 443, $cas_context);

phpCAS::setCasServerCACert("certificates/cas.crt");

phpCAS::forceAuthentication();

$query = "SELECT * FROM users WHERE user_rcs=?";
$result = $conn->prepare($query);
$result->execute([phpCAS::getUser()]);

require "views/header.php";

echo "<h2 class=\"text-center\">CAS Registration</h2>";

if($result->rowCount() === 1){
    echo "<p class=\"text-center\">User already made. Please log in instead.</p>";
}
else{
    $query = "SELECT * FROM authorized_users WHERE rcs=?";
    $result = $conn->prepare($query);
    $result->execute([phpCAS::getUser()]);

    if($result->rowCount() === 0){
        $query = "INSERT INTO waitlist (`rcs`, `name`) VALUES (?, ?)";
        $result = $conn->prepare($query);
        $result->execute([phpCAS::getUser(), $_SESSION['registername']]);
        echo "<p class=\"text-center\">You are not currently authorized to use this platform but you have been added to a waitlist.</p>";
    }
    else{
        $query = "INSERT INTO users (`user_rcs`, `user_name`) VALUES (?, ?)";
        $result = $conn->prepare($query);
        $result->execute([phpCAS::getUser(), $_SESSION['registername']]);
    
        if($result !== false){
            echo "<p class=\"text-center\">User created! Please log in now.</p>";
        }
        else if($result !== false){
            echo "<p class=\"text-center\">Failure</p>";
        }
    }
}

session_destroy();

$_SESSION = array();

?>