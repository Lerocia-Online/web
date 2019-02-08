<?php
include_once 'database.php';

$user_id = $_POST['user_id'];
$item_id = $_POST['item_id'];

echo array_values($item_id);

if ($user_id == '' || $item_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide both user id and item id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$user_id = strip_tags($user_id);

$query = "DELETE FROM LOA.t_user_item WHERE user_id = '$user_id' AND item_id = '$item_id' LIMIT 1";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not delete item');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>