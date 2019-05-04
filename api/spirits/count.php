<?php
    include '../../connection/connect.php';
    $sql = "SELECT COUNT(id) FROM spirits";
    $res_arr = array();
    $res_arr['records'] = array();
    $res_arr['records']['count'] = 0;
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $res_arr['records']['count'] = $row["COUNT(id)"];
        }
        http_response_code(200);
        echo json_encode($res_arr);
    } else {
        http_response_code(404);
        echo json_encode(array('message' => 'no spirits found'));
    }
?>