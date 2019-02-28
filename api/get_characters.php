<?php
include_once 'database.php';

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
	weapon_id, 
	apparel_id, 
	dialogue_id
FROM LOA.t_character
";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array(
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
            'weapon_id' => $row[14],
            'apparel_id' => $row[15],
            'dialogue_id' => $row[16]
        );
    }
    // Free result set
    mysqli_free_result($result);
} else {
    echo 'error';
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>