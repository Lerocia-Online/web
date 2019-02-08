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

$query = "INSERT INTO LOA.t_user_item VALUES ('$user_id', '$item_id')";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not insert item');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>