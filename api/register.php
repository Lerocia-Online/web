<?php
include_once 'database.php';

$character_name = $_POST['username'];
$password = $_POST['password'];

if ($character_name == '' || $password == '') {
    $dataArray = array('success' => false, 'error' => 'empty username or password');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$character_name = strip_tags($character_name);
$password = strip_tags($password);

$password = hash('sha256', $password);

$query = "SELECT character_name FROM LOA.t_character WHERE character_name = '$character_name'";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_row($result);
if ($row) {
    $dataArray = array('success' => false, 'error' => 'user already exists');
} else {
    $character_query = "
    INSERT INTO LOA.t_character (
        character_name
    ) values (
        '$character_name'
    )";

    if ($character_result = mysqli_query($link, $character_query)) {
        mysqli_free_result($character_result);
        if ($character_id = mysqli_insert_id($link)) {
            $player_query = "
            INSERT INTO LOA.t_player (
                character_id,
                password
            ) VALUES (
                '$character_id',
                '$password'
            )";
            if ($player_result = mysqli_query($link, $player_query)) {
                mysqli_free_result($player_result);
                $dataArray = array('success' => true, 'error' => '');
            } else {
                $dataArray = array('success' => false, 'error' => 'Could not insert into t_player');
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