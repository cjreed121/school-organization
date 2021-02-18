<?php 

if(!isset($_SESSION['uid'])){
    header("Location: home");
    die();
}

require "views/header.php";

?>

<h1 class="mt-2">My Classes</h1>

<?php

if($_POST['classname']){
    $query = "INSERT INTO classes (`class_name`) VALUES (?)";
    $result = $conn->prepare($query);
    $result->execute([$_POST['classname']]);
    $query = "INSERT INTO classusers (`class_id`, `user_id`) VALUES (?, ?)";
    $result = $conn->prepare($query);
    $result->execute([$conn->lastInsertId(), $_SESSION['uid']]);
}

$query = "SELECT * FROM classes, classusers WHERE classes.class_id = classusers.class_id AND classusers.user_id=? ORDER BY classes.class_name";
$result = $conn->prepare($query);
$result->execute([$_SESSION['uid']]);


while($row = $result->fetch()){
    echo "<div class=\"card mt-3\"><div class=\"card-body d-flex justify-content-between\"><a class=\"mt-1\" href=\"class/".$row['class_id']."\">".$row['class_name']."</a><button type=\"submit\" class=\"btn btn-danger deletebutton\" classid=\"".$row['class_id']."\">Delete</button></div></div>";
}


?>

<h3 class="mt-5">Add more classes</h3>

<form action="classes" method="POST">
    <div class="form-group">
        <label for="classname">Class Name</label>
        <input id="classname" name="classname" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add a new class</button>
</form>

<script src="scripts/deleteclass.js"></script>