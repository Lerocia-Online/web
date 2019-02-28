<?php
include_once 'database.php';

$character_id = $_POST['character_id'];
$character_personality = $_POST['character_personality'];
$position_x = $_POST['position_x'];
$position_y = $_POST['position_y'];
$position_z = $_POST['position_z'];
$rotation_x = $_POST['rotation_x'];
$rotation_y = $_POST['rotation_y'];
$rotation_z = $_POST['rotation_z'];
$max_health = $_POST['max_health'];
$current_health = $_POST['current_health'];
$max_stamina = $_POST['max_stamina'];
$current_stamina = $_POST['current_stamina'];
$gold = $_POST['gold'];
$weapon_id = $_POST['weapon_id'];
$apparel_id = $_POST['apparel_id'];
$dialogue_id = $_POST['dialogue_id'];

if ($character_id == '') {
    $dataArray = array('success' => false, 'error' => 'must provide character id');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$character_id = strip_tags($character_id);

$position_x = (float) $position_x;
$position_y = (float) $position_y;
$position_z = (float) $position_z;
$rotation_x = (float) $rotation_x;
$rotation_y = (float) $rotation_y;
$rotation_z = (float) $rotation_z;

$query = "
UPDATE LOA.t_character
  SET 
      character_personality = '$character_personality',
      position_x = '$position_x', 
      position_y = '$position_y', 
      position_z = '$position_z', 
      rotation_x = '$rotation_x', 
      rotation_y = '$rotation_y', 
      rotation_z = '$rotation_z',
      max_health = '$max_health',
      current_health = '$current_health',
      max_stamina = '$max_stamina',
      current_stamina = '$current_stamina',
      gold = '$gold',
      weapon_id = '$weapon_id',
      apparel_id = '$apparel_id',
      dialogue_id = '$dialogue_id'
WHERE character_id = '$character_id'
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