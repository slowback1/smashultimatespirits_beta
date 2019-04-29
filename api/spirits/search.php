<?php
    include '../../connection/connect.php';
    $query = $_POST['searchQuery'];
    $searchType = $_POST['searchType'];
    $sql = "SELECT * FROM spirits WHERE $searchType LIKE '$query' LIMIT 30";
    $res_arr = array();
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $item = array(
                $id = $row['id'],
                $name = $row['name'],
                $game = $row['game'],
                $series = $row['series']
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