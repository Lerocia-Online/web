<?php
include_once 'database.php';

$user_id = $_POST['user_id'];
$position_x = $_POST['position_x'];
$position_y = $_POST['position_y'];
$position_z = $_POST['position_z'];
$rotation_x = $_POST['rotation_x'];
$rotation_y = $_POST['rotation_y'];
$rotation_z = $_POST['rotation_z'];

if ($user_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide user id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$user_id = strip_tags($user_id);

$position_x = (float) $position_x;
$position_y = (float) $position_y;
$position_z = (float) $position_z;
$rotation_x = (float) $rotation_x;
$rotation_y = (float) $rotation_y;
$rotation_z = (float) $rotation_z;

$query = "
UPDATE LOA.t_user
  SET 
      position_x = '$position_x', 
      position_y = '$position_y', 
      position_z = '$position_z', 
      rotation_x = '$rotation_x', 
      rotation_y = '$rotation_y', 
      rotation_z = '$rotation_z'
WHERE user_id = '$user_id'
";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not update transform');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>