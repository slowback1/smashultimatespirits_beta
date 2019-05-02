<?php
    include '../../connection/connect.php';
    $query = $_GET['query'];
    $sqlS = "SELECT name, id, game, series FROM spirits WHERE name LIKE '%$query%' ORDER BY CASE WHEN name LIKE '$query%' THEN 1 ELSE id END LIMIT 5";
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

    $sqlG = "SELECT * FROM spirits WHERE game LIKE '$query' LIMIT 3";
    $res_arr['game'] = array();
    $result = $conn->query($sqlG);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $item = array(
            $game = $row['game'],
            $series = $row['series']
        );
    }
    }
    $sqlSe = "SELECT * FROM spirits WHERE series LIKE '$query' LIMIT 1";
    $res_arr['series'] = array();
    $result = $conn->query($sqlSe);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $item = array(
            $series = $row['series']
        );
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