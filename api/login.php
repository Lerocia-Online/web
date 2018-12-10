<?php
include_once 'database.php';

$email = $_POST['email'];
$upass = $_POST['password'];

$email = strip_tags($email);
$upass = strip_tags($upass);

$password = hash('sha256', $upass);

$query = "SELECT username FROM LOA.t_user WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_row($result);
if ($row) {
	$dataArray = array('success' => true, 'error' => '', 'email' => "$email", 'username' => "$row[0]");
} else {
	$dataArray = array('success' => false, 'error' => 'Invalid email or password', 'email' => "", 'username' => "");
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>