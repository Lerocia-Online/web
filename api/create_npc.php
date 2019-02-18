<?php
include_once 'database.php';

$npc_name = $_POST['npc_name'];
$position_x = $_POST['position_x'];
$position_y = $_POST['position_y'];
$position_z = $_POST['position_z'];
$rotation_x = $_POST['rotation_x'];
$rotation_y = $_POST['rotation_y'];
$rotation_z = $_POST['rotation_z'];

if ($npc_name == '') {
    $dataArray = array('success' => false, 'error' => 'must provide npc name');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$npc_name = strip_tags($npc_name);

$query = "INSERT INTO LOA.t_npc (
    npc_name,
    position_x,
    position_y,
    position_z,
    rotation_x,
    rotation_y,
    rotation_z
) values (
    '$npc_name',
    '$position_x',
    '$position_y',
    '$position_z',
    '$rotation_x',
    '$rotation_y',
    '$rotation_z'
)";
if (mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not create NPC.');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>