<?php
include_once 'database.php';

$query = "
SELECT 
	LOA.t_character.character_id, 
	LOA.t_player.player_id,
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
	dialogue_id,
    origin_x,
    origin_y,
    origin_z,
    LOA.t_player.logged_in
FROM LOA.t_character
JOIN LOA.t_player ON LOA.t_character.character_id = LOA.t_player.character_id
";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array(
            'character_id' => $row[0],
            'player_id' => $row[1],
            'character_name' => $row[2],
            'character_personality' => $row[3],
            'position_x' => $row[4],
            'position_y' => $row[5],
            'position_z' => $row[6],
            'rotation_x' => $row[7],
            'rotation_y' => $row[8],
            'rotation_z' => $row[9],
            'max_health' => $row[10],
            'current_health' => $row[11],
            'max_stamina' => $row[12],
            'current_stamina' => $row[13],
            'gold' => $row[14],
            'base_weight' => $row[15],
            'base_damage' => $row[16],
            'base_armor' => $row[17],
            'weapon_id' => $row[18],
            'apparel_id' => $row[19],
            'dialogue_id' => $row[20],
            'origin_x' => $row[21],
            'origin_y' => $row[22],
            'origin_z' => $row[23],
            'logged_in' => $row[24]
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