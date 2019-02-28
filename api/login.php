<?php
include_once 'database.php';

$character_name = $_POST['username'];
$password = $_POST['password'];

$character_name = strip_tags($character_name);
$password = strip_tags($password);

$password = hash('sha256', $password);

$query = "
SELECT 
       LOA.t_character.character_id, 
       LOA.t_character.character_name, 
       LOA.t_player.logged_in 
FROM LOA.t_character 
JOIN LOA.t_player ON LOA.t_character.character_id = LOA.t_player.character_id
WHERE 
      character_name = '$character_name' AND 
      password = '$password'
";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_row($result);
if ($row) {
    if ($row[2] == 0) {
        $query2 = "UPDATE LOA.t_player SET logged_in = 1 WHERE character_id = '$row[0]'";
        if ($result2 = mysqli_query($link, $query2)) {
            $dataArray = array('success' => true, 'error' => '', 'character_id' => "$row[0]", 'character_name' => "$character_name");
        } else {
            $dataArray = array('success' => false, 'error' => 'Something went wrong');
        }
    } else {
        $dataArray = array('success' => false, 'error' => 'User already logged in');
    }
} else {
	$dataArray = array('success' => false, 'error' => 'Invalid username or password');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>