<?php
    include '../../../connection/connect.php';
    $sid = $_POST['id'];
    $sname = $_POST['name'];
    $sgame = $_POST['game'];
    $sseries = $_POST['series'];
    $sdescription = $_POST['description'];
    $sauthor = $_POST['author'];
    $suser = $_POST['user'];
    
    $sql = "INSERT INTO spirits (id, name, game, series, description, author)
    VALUES('$sid', '$sname', '$sgame', '$sseries', '$sdescription', '$sauthor')";
    $sql2 = "INSERT INTO spiritchangelog (newName, newGame, newSeries, newDescription, id, action, user)
    VALUES ('$sname', '$sgame', '$sseries', '$sdescription', '$sid', 'add', '$suser')";
    $conn->query($sql2);
    if($conn->query($sql1) == true) {
        echo json_encode({'result': true});
    } else {
        echo json_encode({'result': false});
    }
?>