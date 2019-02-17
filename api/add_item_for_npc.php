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

$query = "INSERT INTO LOA.t_npc_item VALUES ('$npc_id', '$item_id')";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not insert item');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>