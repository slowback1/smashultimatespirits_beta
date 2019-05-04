<?php
    include '../../../connection/connect.php';
    $sid = $_POST['id'];
    $suser = $_POST['user'];
    $sql = "DELETE FROM spirits WHERE id='$sid'";
    $sql2 = "INSERT INTO spiritchangelog (id, action, user) 
    VALUES ('$sid', 'delete', '$suser')";
    $conn->query($sql2);
    if($conn->query($sql1) == true) {
        echo json_encode({'result': true});
    } else {
        echo json_encode({'result': false});
    }
?>