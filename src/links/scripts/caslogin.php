<?php



//phpCAS::setDebug();

//phpCAS::setVerbose(true);

phpCAS::client(CAS_VERSION_3_0, $cas_host, 443, $cas_context);

phpCAS::setCasServerCACert("certificates/cas.crt");

phpCAS::forceAuthentication();

$query = "SELECT * FROM users WHERE user_rcs=?";
$result = $conn->prepare($query);
$result->execute([phpCAS::getUser()]);

if($result !== false && $result->rowCount() === 1){
    $_SESSION['loggedin'] = true;
    $_SESSION['expire'] = time() + (60 * 60 * 24 * 7);
    $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
    $row = $result->fetch();
    $_SESSION['uid'] = $row['user_id'];
    $_SESSION['name'] = $row['user_name'];
    $_SESSION['rcs'] = $row['user_rcs'];
    header("Location: classes");
    die();
}
else if($result !== false && $result->rowCount() === 0){
    header("Location: register");
    die();
}

?>