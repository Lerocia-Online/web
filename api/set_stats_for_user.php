<?php
include_once 'database.php';

$user_id = $_POST['user_id'];
$position_x = $_POST['position_x'];
$position_y = $_POST['position_y'];
$position_z = $_POST['position_z'];
$rotation_x = $_POST['rotation_x'];
$rotation_y = $_POST['rotation_y'];
$rotation_z = $_POST['rotation_z'];
$type = $_POST['type'];
$max_health = $_POST['max_health'];
$current_health = $_POST['current_health'];
$max_stamina = $_POST['max_stamina'];
$current_stamina = $_POST['current_stamina'];
$gold = $_POST['gold'];
$equipped_weapon = $_POST['equipped_weapon'];
$equipped_apparel= $_POST['equipped_apparel'];

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
      rotation_z = '$rotation_z',
      type = '$type',
      max_health = '$max_health',
      current_health = '$current_health',
      max_stamina = '$max_stamina',
      current_stamina = '$current_stamina',
      gold = '$gold',
      equipped_weapon = '$equipped_weapon',
      equipped_apparel = '$equipped_apparel'
WHERE user_id = '$user_id'
";

$dataArray = array();
if ($result = mysqli_query($link, $query)) {
    $dataArray = array('success' => true, 'error' => '');
} else {
    $dataArray = array('success' => false, 'error' => 'Could not update stats');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>