<?php
include_once 'database.php';

$query = "SELECT user_id, username, signup_date FROM LOA.t_user";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
        $dataArray[] = array('user_id' => $row[0], 'username' => $row[1], 'signup_date' => $row[2]);
    }
    // Free result set
    mysqli_free_result($result);
} else {
    echo 'error';
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>