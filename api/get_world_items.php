<?php
include_once 'database.php';

$query = "SELECT world_id, item_id, position_x, position_y, position_z FROM LOA.t_world_item";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array('world_id' => $row[0], 'item_id' => $row[1], 'position_x' => $row[2], 'position_y' => $row[3], 'position_z' => $row[4]);
    }
    // Free result set
    mysqli_free_result($result);
} else {
    echo 'error';
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>