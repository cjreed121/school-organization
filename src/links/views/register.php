<?php

if(isset($_POST['name'])){
    $_SESSION['registername'] = htmlspecialchars($_POST['name']); //potentially harmful data
    header("Location: casregister");
    die();
}

require "views/header.php";

?>

<form class="w-50 mx-auto" action="register" method="POST">
    <h2 class="text-center">Register</h2>
    <div class="form-group">
        <label for="inputName">Name</label>
        <input type="text" class="form-control" id="inputName" name="name">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary text-center">CAS Registration</button>
    </div>

</form>