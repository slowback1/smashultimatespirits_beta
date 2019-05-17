<?php
    include '../../connection/connect.php';
    $json_str = file_get_contents('php://input');
    $post = json_decode($json_str);
    $sortType = $post->sortType;
    $offset = $post->offset;
    $includes = $post->includes;
    $minYear = $post->minYear - 1;
    $maxYear = $post->maxYear + 1;
    $includesSql = "WHERE";
    if($includes != "all") {
        foreach($includes as $i) {
            $includesSql = $includesSql . " series='$i' OR";
        }
        $includesSql = substr($includesSql, 0, -2) . " AND";
    }
    $sql = "
        SELECT id, name, game, series FROM spirits
        $includesSql 
        release_year BETWEEN $minYear and $maxYear
        AND id > $offset
        ORDER BY $sortType
        LIMIT 20
    ";
    $res_arr = array();
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $item = array (
                "id" => $row['id'],
                "name" => $row['name'],
                "game" => $row['game'],
                "series" => $row['series'],
            );
            array_push($res_arr, $item);
        }
        http_response_code(200);
        echo json_encode($res_arr);
    } else {
        http_response_code(404);
        echo json_encode(array('message' => 'No Spirits Found'));   
    }
?>