<?php
include_once 'database.php';

$character_id = $_POST['character_id'];

$character_id = strip_tags($character_id);

$query = "UPDATE LOA.t_user SET logged_in = 0 WHERE character_id = '$character_id'";

if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Something went wrong');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>