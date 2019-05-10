<?php
    include '../../connection/connect.php';
    $sql = "SELECT id, game FROM spirits ORDER BY id";
    $res_arr = array();
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $item = substr(strchr($row['game'], "("), 1, 5);
            $id = $row['id'];
            array_push($res_arr, $item);
            $sql2 = "UPDATE spirits SET release_year = '$item' WHERE id='$id'";
            if($conn->query($sql2)) {
                echo "addition successful";
            };
        }
    }
    echo json_encode($res_arr);
?>