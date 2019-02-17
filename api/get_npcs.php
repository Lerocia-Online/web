<?php
include_once 'database.php';

$query = "SELECT npc_id, npc_name FROM LOA.t_npc";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array('npc_id' => $row[0], 'npc_name' => $row[1]);
    }
    // Free result set
    mysqli_free_result($result);
} else {
    echo 'error';
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>