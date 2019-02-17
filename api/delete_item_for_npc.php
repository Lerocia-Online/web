<?php
include_once 'database.php';

$npc_id = $_POST['npc_id'];
$item_id = $_POST['item_id'];

if ($npc_id == '' || $item_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide both npc id and item id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$npc_id = strip_tags($npc_id);

$query = "DELETE FROM LOA.t_npc_item WHERE npc_id = '$npc_id' AND item_id = '$item_id' LIMIT 1";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not delete item');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>