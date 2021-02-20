<?php

if(sizeof($burl) === 2){
    
    $query = "SELECT * FROM classes, classusers WHERE classusers.class_id = classes.class_id AND classes.class_url_name = ? AND classusers.user_id = ?";
    $result = $conn->prepare($query);
    $result->execute([$burl[1], $_SESSION['uid']]);
    if($result->rowCount() === 1){
        
        require "views/header.php";
        $row = $result->fetch();
        echo "<h1 id=\"classname\" classurlname=\"".$row['class_url_name']."\">".$row['class_name']."</h1>";

        echo "<h3>My Links</h3>";
        if($_POST['linkname'] && $_POST['linkurl']){
            $classid = $row['class_id'];
            
            $query = "INSERT INTO classlinks (`class_id`, `link`, `linkname`) VALUES (?, ?, ?)";
            $result = $conn->prepare($query);
            $result->execute([$classid, $_POST['linkurl'], $_POST['linkname']]);
            
            
        }
        $query = "SELECT * FROM classlinks WHERE class_id=?";
        $result = $conn->prepare($query);
        $result->execute([$row['class_id']]);
        while($row = $result->fetch()){
            $tmpurl = $row['link'];
            $explodedurl = explode("/", $tmpurl);
            $finurl;
            if(sizeof($explodedurl) > 1){
                if(substr($explodedurl[0], -1, 1) == ":"){
                    if(strlen($explodedurl[1]) == 0 && strlen($explodedurl > 1)){
                        $finurl = $explodedurl[2];
                    }
                    else{
                        $finurl = $explodedurl[1];
                    }
                }
                else if(strlen($explodedurl[0]) == 0){
                    $finurl = $explodedurl[1];
                }
            }
            else{
                $finurl = $explodedurl[0];
            }
            echo "<div class=\"card mt-3\"><div class=\"card-body d-flex justify-content-between\"><img src=\"https://www.google.com/s2/favicons?domain=".$finurl."\" width=30px height=30px><a class=\"mt-1\" target=\"_blank\" href=\"".$row['link']."\">".$row['linkname']."</a><button type=\"submit\" class=\"btn btn-danger deletebutton\" linkid=\"".$row['id']."\">Delete</button></div></div>";
        }
    }
    else{
        header("Location: ../classes");
        die();
    }
}
else{
    header("Location: ../classes");
    die();
}

?>

<h3 class="mt-5">Add more links</h3>

<form action="<?php echo "/links/".htmlspecialchars($url); ?>" method="POST">
    <div class="form-group">
        <label for="linkname">Link Name</label>
        <input id="linkname" name="linkname" class="form-control">
    </div>
    <div class="form-group">
        <label for="linkurl">Link URL</label>
        <input id="linkurl" name="linkurl" class="form-control" type="url">
    </div>
    <button type="submit" class="btn btn-primary">Add a new link</button>
</form>

<script src="../scripts/deletelink.js"></script>