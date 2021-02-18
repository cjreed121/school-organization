<?php

if(!isset($_SESSION['loggedin'])){
    header("Location: home");
    die();
}

if(!isset($_POST['id'])){
    header("Location: classes");
    die();
}

$query = "SELECT * FROM classusers WHERE class_id=?";
$result = $conn->prepare($query);
$result->execute([$_POST['classid']]);

if($result->rowCount() > 0){
    $row = $result->fetch();
    if($row['user_id'] == $_SESSION['uid']){
        $query = "DELETE FROM classlinks WHERE id=?";
        $result = $conn->prepare($query);
        $result->execute([$_POST['id']]);
        echo json_encode(array('errors'=>false,'message'=>'Delete successful'));
    }
    else{
        header("Location: classes");
        die();
    }
}
else{
    header("Location: classes");
    die();
}