<?php

declare(strict_types=1);

ini_set("session.cookie_httponly", "1");

require __DIR__."/config.php";
require __DIR__."/vendor/autoload.php";

use jasig\phpcas\phpCAS;

if(isset($env) && $env == "prod"){
    session_set_cookie_params(60*60*24*7, $path, $hostname, true, true);
}

session_start();

if(isset($_SESSION['expire']) && time() > $_SESSION['expire']){
    require "scripts/logout.php";
    header("Location: home");
    die();
}

if(isset($_SESSION['useragent']) && $_SESSION['useragent'] !== $_SERVER['HTTP_USER_AGENT']){
    require "scripts/logout.php";
    header("Location: home");
    die();
}

if(!isset($_GET['url'])){
    $url = "";
}
else{
    $url = $_GET['url'];
    $url = rtrim($url);
    $url = filter_var($url, FILTER_SANITIZE_URL);
}

$burl = explode("/", $url);

switch($burl[0]) {
    case "" :
        require "views/header.php";
        require "views/home.php";
        break;
    case "home":
        require "views/header.php";
        require "views/home.php";
        break;
    case "about":
        require "views/header.php";
        require "views/about.php";
        break;
    case "login":
        require "views/login.php";
        break;
    case "register":
        require "views/register.php";
        break;
    case "caslogin":
        require "scripts/caslogin.php";
        break;
    case "caslogout":
        require "scripts/caslogout.php";
        break;
    case "logout":
        require "scripts/logout.php";
        break;
    case "casregister":
        require "scripts/casregister.php";
        break;
    case "classes":
        require "views/classes.php";
        break;
    case "class":
        require "views/class.php";
        break;
    case "profile":
        require "views/profile.php";
        break;
    case "delete":
        require "scripts/delete.php";
        break;
    case "deleteclass":
        require "scripts/deleteclass.php";
        break;
    case "deletelink":
        require "scripts/deletelink.php";
        break;
    default:
        http_response_code(404);
        require "views/header.php";
        require "views/404.php";
        require "views/footer.php";
        break;
}

?>