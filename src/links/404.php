<?php

session_start();
http_response_code(404);
require "views/header.php";
require "views/404.php";
require "views/footer.php";

?>