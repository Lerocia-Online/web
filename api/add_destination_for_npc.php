<?php
include_once 'database.php';

$character_id = $_POST['character_id'];
$position_x = $_POST['position_x'];
$position_y = $_POST['position_y'];
$position_z = $_POST['position_z'];
$duration = $_POST['duration'];

if ($character_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide character id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$character_id = strip_tags($character_id);

$query = "
INSERT INTO LOA.t_npc_destination (character_id, position_x, position_y, position_z) 
VALUES ('$character_id', '$position_x', '$position_y', '$position_z', '$duration')
";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not insert destination');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>