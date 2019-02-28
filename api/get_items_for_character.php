<?php
include_once 'database.php';

$character_id = $_POST['character_id'];

if ($character_id == '') {
    $dataArray = array('success' => false, 'error' => 'no character id provided');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$character_id = strip_tags($character_id);

$query = "SELECT item_id FROM LOA.t_character_item WHERE character_id = '$character_id'";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array('item_id' => $row[0]);
    }
    // Free result set
    mysqli_free_result($result);
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>