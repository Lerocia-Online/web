<?php
include_once 'database.php';

$username = $_POST['username'];
$upass = $_POST['password'];

$username = strip_tags($username);
$upass = strip_tags($upass);

$password = hash('sha256', $upass);

$query = "SELECT user_id, username, logged_in FROM LOA.t_user WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_row($result);
if ($row) {
    if ($row[2] == 0) {
        $query2 = "UPDATE LOA.t_user SET logged_in = 1 WHERE user_id = '$row[0]'";
        if ($result2 = mysqli_query($link, $query2)) {
            $dataArray = array('success' => true, 'error' => '', 'user_id' => "$row[0]", 'username' => "$username");
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