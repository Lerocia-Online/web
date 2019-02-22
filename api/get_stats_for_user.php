<?php
include_once 'database.php';

$user_id = $_POST['user_id'];

if ($user_id == '') {
    $dataArray = array('success' => false, 'error' => 'no user id provided');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$user_id = strip_tags($user_id);

$query = "
SELECT 
       user_id, 
       username, 
       position_x, 
       position_y, 
       position_z, 
       rotation_x, 
       rotation_y, 
       rotation_z, 
       type, 
       max_health,
       current_health,
       max_stamina,
       current_stamina,
       gold,
       equipped_weapon, 
       equipped_apparel 
FROM LOA.t_user 
WHERE user_id = '$user_id'
";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
$dataArray = array();
if ($row) {
    $dataArray = array(
        'success'          => true,
        'error'            => '',
        'user_id'          => "$row[0]",
        'username'         => "$row[1]",
        'position_x'       => "$row[2]",
        'position_y'       => "$row[3]",
        'position_z'       => "$row[4]",
        'rotation_x'       => "$row[5]",
        'rotation_y'       => "$row[6]",
        'rotation_z'       => "$row[7]",
        'type'             => "$row[8]",
        'max_health'       => "$row[9]",
        'current_health'   => "$row[10]",
        'max_stamina'      => "$row[11]",
        'current_stamina'  => "$row[12]",
        'gold'             => "$row[13]",
        'equipped_weapon'  => "$row[14]",
        'equipped_apparel' => "$row[15]"
    );
} else {
    $dataArray = array('success' => false, 'error' => 'Something went wrong');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>