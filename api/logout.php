<?php
include_once 'database.php';

$user_id = $_POST['user_id'];

$user_id = strip_tags($user_id);

$query = "UPDATE LOA.t_user SET logged_in = 0 WHERE user_id = '$user_id'";

if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Something went wrong');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>