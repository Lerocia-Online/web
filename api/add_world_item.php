<?php
include_once 'database.php';

$world_id = $_POST['world_id'];
$item_id = $_POST['item_id'];
$position_x = $_POST['position_x'];
$position_y = $_POST['position_y'];
$position_z = $_POST['position_z'];

if ($world_id == '' || $item_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide both world id and item id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
} else if ($position_x == '' || $position_y == '' || $position_z == '') {
    $dataArray = array('success' => false, 'error' => 'must provide item location');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$position_x = (float) $position_x;
$position_y = (float) $position_y;
$position_z = (float) $position_z;

$query = "INSERT INTO LOA.t_world_item VALUES ('$world_id', '$item_id', '$position_x', '$position_y', '$position_z')";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not insert world item');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>