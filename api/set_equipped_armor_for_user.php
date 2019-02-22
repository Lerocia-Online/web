<?php
include_once 'database.php';

$user_id = $_POST['user_id'];
$armor_id = $_POST['armor_id'];

if ($user_id == '' || $armor_id) {
    $dataArray = array('success' => false, 'error' => 'must provide user id and armor id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$user_id = strip_tags($user_id);

$query = "
UPDATE LOA.t_user
  SET equipped_armor = '$armor_id'
WHERE user_id = '$user_id'
";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not update equipped armor');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>