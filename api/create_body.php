<?php
include_once 'database.php';

$character_name = $_POST['character_name'];
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

if ($character_name == '') {
    $dataArray = array('success' => false, 'error' => 'must provide body name');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$character_name = strip_tags($character_name);

$query = "SELECT character_id FROM LOA.t_character WHERE character_name = '$character_name'";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_row($result);
if ($row) {
    $update_query = "
    UPDATE t_character 
    SET character_personality = '$character_personality',
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
        dialogue_id = '$dialogue_id',
    WHERE character_id = '$row[0]'
    ";
    if (mysqli_query($link, $update_query)) {
        $dataArray = array('success' => true, 'error' => '', 'character_id' => $row[0]);
    } else {
        $dataArray = array('success' => false, 'error' => 'Could not update t_character');
    }
} else {
    $character_query = "
INSERT INTO LOA.t_character (
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
) values (
    '$character_name',
    '$character_personality',
    '$position_x',
    '$position_y',
    '$position_z',
    '$rotation_x',
    '$rotation_y',
    '$rotation_z',
    '$max_health',
    '$current_health',
    '$max_stamina',
    '$current_stamina',
    '$gold',
    '$weapon_id',
    '$apparel_id',
    '$dialogue_id'
)";

    if ($character_result = mysqli_query($link, $character_query)) {
        mysqli_free_result($character_result);
        if ($character_id = mysqli_insert_id($link)) {
            $body_query = "
        INSERT INTO LOA.t_body (
            character_id
        ) VALUES (
            '$character_id'
        )";
            if ($body_result = mysqli_query($link, $body_query)) {
                mysqli_free_result($body_result);
                $dataArray = array('success' => true, 'error' => '', 'character_id' => $character_id);
            } else {
                $dataArray = array('success' => false, 'error' => 'Could not insert into t_body');
            }
        } else {
            $dataArray = array('success' => false, 'error' => 'Could not get character_id');
        }
    } else {
        $dataArray = array('success' => false, 'error' => 'Could not insert into t_character');
    }
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>
