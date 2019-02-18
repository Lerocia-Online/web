<?php
include_once 'database.php';

$query = "SELECT LOA.t_npc.npc_id, npc_name, position_x, position_y, position_z, rotation_w, rotation_x, rotation_y, rotation_z FROM LOA.t_npc JOIN LOA.t_npc_transform ON LOA.t_npc.npc_id";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array('npc_id' => $row[0], 'npc_name' => $row[1], 'position_x' => $row[2], 'position_y' => $row[3], 'position_z' => $row[4], 'rotation_w' => $row[5], 'rotation_x' => $row[6], 'rotation_y' => $row[7], 'rotation_z' => $row[8]);
    }
    // Free result set
    mysqli_free_result($result);
} else {
    echo 'error';
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>