<?php
include_once 'database.php';

$world_id = $_POST['world_id'];

if ($world_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide world id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$query = "DELETE FROM LOA.t_world_item WHERE world_id = '$world_id'";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not delete world item');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>