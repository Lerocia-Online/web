<?php
include_once 'database.php';

$user_id = $_POST['user_id'];
$weapon_id = $_POST['weapon_id'];

if ($user_id == '' || $weapon_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide user id and weapon id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$user_id = strip_tags($user_id);

$query = "
UPDATE LOA.t_user
  SET equipped_weapon = '$weapon_id'
WHERE user_id = '$user_id'
";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not update equipped weapon');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>