<?php
include_once 'database.php';

$original_owner_id = $_POST['original_owner'];
$new_owner_id = $_POST['new_owner'];

if ($original_owner_id == '' || $new_owner_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide both original owner and new owner');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$original_owner_id = strip_tags($original_owner_id);
$new_owner_id = strip_tags($new_owner_id);

$query = "UPDATE LOA.t_character_item SET character_id = '$new_owner_id' WHERE character_id = '$original_owner_id'";

$dataArray = array();
if (mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not update inventory ownership');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>