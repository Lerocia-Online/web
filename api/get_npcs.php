<?php
include_once 'database.php';

$query = "SELECT npc_id, npc_name, position_x, position_y, position_z, rotation_x, rotation_y, rotation_z, type, dialogue_id FROM LOA.t_npc";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array('npc_id' => $row[0], 'npc_name' => $row[1], 'position_x' => $row[2], 'position_y' => $row[3], 'position_z' => $row[4], 'rotation_x' => $row[5], 'rotation_y' => $row[6], 'rotation_z' => $row[7], 'type' => $row[8], 'dialogue_id' => $row[9]);
    }
    // Free result set
    mysqli_free_result($result);
} else {
    echo 'error';
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>