<?php
    include '../../connection/connect.php';
    $sortOptions = $_POST['options'];
    $seriesFilter = $_POST['seriesFilter'];
    $whereSQL = "";
    foreach($seriesFilter) {
        
        $whereSQL = $whereSQL . "series='$series' OR ";
    }
    $SQL = "SELECT id, name FROM spirits WHERE $whereSQL ORDER BY $sortOptions";
    $res_arr = array();
    $result = $conn->query($SQL);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $item = array(
                "id" => $row['id'],
                "name" => $row['name']
            );
            array_push($res_arr, $item);
        }
        
    }
    if(empty($res_arr)) {
        http_response_code(404);
        echo json_encode(array('message' => 'No Response Found'));
    } else {
        http_response_code(200);
        echo json_encode($res_arr);
    }
?>