<?php
include_once 'database.php';

$email = $_POST['email'];
$upass = $_POST['password'];
$username = $_POST['username'];

$email = strip_tags($email);
$upass = strip_tags($upass);
$username = strip_tags($username);

$password = hash('sha256', $upass);

$query = "SELECT username FROM LOA.t_user WHERE email = '$email'";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_row($result);
if ($row) {
    $dataArray = array('success' => false, 'error' => 'user already exists');
} else {
    $query2 = "INSERT INTO LOA.t_user (
        username,
        password,
        email,
        signup_date
    ) values (
        '$username',
        '$password',
        '$email',
        CURRENT_TIMESTAMP
    )";
    if ($result2 = mysqli_query($link, $query2)) {
        $dataArray = array('success' => true, 'error' => '', 'username' => "$username");
    } else {
        $dataArray = array('success' => false, 'error' => 'Could not create user.');
    }
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>