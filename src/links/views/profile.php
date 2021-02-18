<?php

if(!isset($_SESSION['loggedin'])){
    header("Location: login");
    die();
}

if(isset($_POST['newName'])){
    $query = "UPDATE users SET user_name = ? WHERE user_id = ?";
    $result = $conn->prepare($query);
    $result->execute([$_POST['newName'], $_SESSION['uid']]);
    $query = "SELECT user_name FROM users WHERE user_id = ?";
    $result = $conn->prepare($query);
    $result->execute([$_SESSION['uid']]);
    $row = $result->fetch();
    $_SESSION['name'] = $row['user_name'];
}

require "views/header.php";

?>

<h2 class="text-center">My Profile</h2>

<form class="w-50 mx-auto" action="profile" method="POST">

    <div class="form-group">
        <label for="nameChange">Change your name:</label>
        <input id="nameChange" name="newName" class="form-control" value="<?php echo $_SESSION['name']; ?>">
    </div>
    <div class="form-group">
        <label for="rcs">Your RCS:</label>
        <input id="rcs" readonly class="form-control" value="<?php echo $_SESSION['rcs']; ?>">
    </div>
    <div class="text-center">
        <button class="btn btn-primary" type="submit">Save Changes</button>
    </div>

</form>

<form class="w-50 mx-auto" action="delete" method="POST">

    <div class="text-center">
        <h5>Delete your account:</5><br><br>
        <button class="btn btn-danger" type="submit">Delete</button>
    </div>


</form>
