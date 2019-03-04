<?php
include_once 'database.php';

$character_id = $_POST['character_id'];

if ($character_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide character id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$character_id = strip_tags($character_id);

$query = "DELETE FROM LOA.t_npc_destination WHERE character_id = '$character_id'";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not delete destinations');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>