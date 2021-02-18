<?php

if(!isset($_SESSION['loggedin'])){
    header("Location: home");
    die();
}

if(!isset($_POST['confirm'])){
    require "views/header.php";
    ?>

    <h2 class="text-center">Delete account</h2>
    <form class="w-50 mx-auto" action="delete" method="POST">
        <div class="text-center">
            <h5>This action is irreversible.</h5>
        </div>
        <div class="form-group">
            <label for="rcs">Type your RCS below to confirm account deletion</label>
            <input id="rcs" class="form-control" name="confirm">
        </div>
        <div class="text-center">
            <button class="btn btn-danger">Delete Account</button>
        </div>

    </form>

    <?php
}

if(isset($_POST['confirm'])){
    if(htmlspecialchars(strtoupper($_POST['confirm'])) == $_SESSION['rcs']){
        $query = "DELETE from classes WHERE classes.class_id IN (SELECT class_id FROM classusers WHERE user_id = ?)";
        $result = $conn->prepare($query);
        $result->execute([$_SESSION['uid']]);
        $query = "DELETE FROM users WHERE user_id = ?";
        $result = $conn->prepare($query);
        $result->execute([$_SESSION['uid']]);
        require "logout.php";
    }
}

?>