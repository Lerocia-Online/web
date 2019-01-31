<?php
include_once 'database.php';

$username = $_POST['username'];
$upass = $_POST['password'];

$username = strip_tags($username);
$upass = strip_tags($upass);

$password = hash('sha256', $upass);

$query = "SELECT user_id, username FROM LOA.t_user WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_row($result);
if ($row) {
	$dataArray = array('success' => true, 'error' => '', 'user_id' => "$row[0]", 'username' => "$username");
} else {
	$dataArray = array('success' => false, 'error' => 'Invalid username or password', 'username' => '');
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>