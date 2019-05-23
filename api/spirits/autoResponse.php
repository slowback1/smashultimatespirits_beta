<?php
    include '../../connection/connect.php';
    $query = $_GET['query'];
    $sqlS = "SELECT  name, id, game, series FROM spirits WHERE name LIKE '%$query%' ORDER BY CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END, id LIMIT 5";
    $res_arr = array();
    $res_arr['spirits'] = array();
    $result = $conn->query($sqlS);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $item = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'game' => $row['game'],
            'series' => $row['series'],
        );
        array_push($res_arr['spirits'], $item);
    }
    }

    $sqlG = "SELECT DISTINCT game FROM spirits WHERE game LIKE '%$query%' ORDER BY CASE WHEN game LIKE '$query%' THEN 1 ELSE game END LIMIT 3";
    $res_arr['game'] = array();
    $result = $conn->query($sqlG);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $item = array(
            "game" => $row['game'],
        );
        array_push($res_arr['game'], $item);
    }
    }
    $sqlSe = "SELECT DISTINCT series FROM spirits WHERE series LIKE '%$query%' ORDER BY CASE WHEN series LIKE '$query%' THEN 1 ELSE series END LIMIT 1";
    $res_arr['series'] = array();
    $result = $conn->query($sqlSe);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $item = array(
            "series" => $row['series']
        );
        array_push($res_arr['series'], $item);
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