<?php 
    include '../../connection/connect.php';
    $limit = $_GET['limit'];
    $offset = $_GET['offset'];
    $sql = "SELECT * FROM spirits ORDER BY id LIMIT $limit OFFSET $offset";
    $res_arr = array();
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $item = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'game' => $row['game'],
                    'series' => $row['series'],
                    'description' => $row['description'],
                    /*
                    Won't be implemented until we add the author to every spirit in the DB, and make sure no one accidentally used their real name
                    $author = $row['author']
                    */
                );

            array_push($res_arr, $item);
        }
        http_response_code(200);
        echo json_encode($res_arr);
    } else {
        http_response_code(404);
        echo $limit;
        echo $offset;
        echo json_encode(array('message' => 'No Spirit Found'));
    }
    
?>