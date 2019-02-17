<?php
include_once 'database.php';

$npc_id = $_POST['npc_id'];

if ($npc_id == '') {
    $dataArray = array('success' => false, 'error' => 'no npc id provided');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$npc_id = strip_tags($npc_id);

$query = "SELECT item_id FROM LOA.t_npc_item WHERE npc_id = '$npc_id'";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array('item_id' => $row[0]);
    }
    // Free result set
    mysqli_free_result($result);
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>