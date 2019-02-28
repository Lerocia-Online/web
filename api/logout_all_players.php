<?php
include_once 'database.php';

$query = "UPDATE LOA.t_player SET logged_in = 0 WHERE logged_in = 1";

if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Something went wrong');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>