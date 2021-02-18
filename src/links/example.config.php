<?php

$ip = "";
$db = "";
$user = "";
$pass = "";

$dsn = 'mysql:host='.$ip.';dbname='.$db;

$conn = new PDO($dsn, $user, $pass);

$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$cas_host = "";
$cas_context = "";

$env = ""; //can be either dev or prod

$hostname = ""; //ex: example.com

$path = ""; //ex: /links/

?>