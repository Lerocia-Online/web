<?php
include_once 'database.php';

$character_id = $_POST['character_id'];
$item_id = $_POST['item_id'];

if ($character_id == '' || $item_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide both character id and item id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$character_id = strip_tags($character_id);

$query = "INSERT INTO LOA.t_character_item (character_id, item_id) VALUES ('$character_id', '$item_id')";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not insert item');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>