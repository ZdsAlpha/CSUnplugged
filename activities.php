<?php
    require_once('main.php');
    include('json.php');
    $db = connect_db();
    $query = "SELECT * FROM activities";
    $result = $db->query($query);
    $array = array();
    while($row = $result->fetch_assoc()) {
        array_push($array, $row);
    }
    echo json_encode($array);
    $db -> close();
?>