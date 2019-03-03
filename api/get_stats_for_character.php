<?php
include_once 'database.php';

$character_id = $_POST['character_id'];

if ($character_id == '') {
    $dataArray = array('success' => false, 'error' => 'no character id provided');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$character_id = strip_tags($character_id);

$query = "
SELECT 
    character_id, 
	character_name, 
	character_personality, 
	position_x, 
	position_y, 
	position_z, 
	rotation_x, 
	rotation_y, 
	rotation_z, 
	max_health, 
	current_health, 
	max_stamina, 
	current_stamina, 
	gold, 
    base_weight,
    base_damage,
    base_armor,
	weapon_id, 
	apparel_id, 
	dialogue_id
FROM LOA.t_character 
WHERE character_id = '$character_id'
";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
$dataArray = array();
if ($row) {
    $dataArray = array(
        'success'          => true,
        'error'            => '',
        'character_id' => $row[0],
        'character_name' => $row[1],
        'character_personality' => $row[2],
        'position_x' => $row[3],
        'position_y' => $row[4],
        'position_z' => $row[5],
        'rotation_x' => $row[6],
        'rotation_y' => $row[7],
        'rotation_z' => $row[8],
        'max_health' => $row[9],
        'current_health' => $row[10],
        'max_stamina' => $row[11],
        'current_stamina' => $row[12],
        'gold' => $row[13],
        'base_weight' => $row[14],
        'base_damage' => $row[15],
        'base_armor' => $row[16],
        'weapon_id' => $row[17],
        'apparel_id' => $row[18],
        'dialogue_id' => $row[19]
    );
} else {
    $dataArray = array('success' => false, 'error' => 'Something went wrong');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>