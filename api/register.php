<?php
include_once 'database.php';

$username = $_POST['username'];
$upass = $_POST['password'];

if ($username == '' || $upass == '') {
    $dataArray = array('success' => false, 'error' => 'empty username or password');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$username = strip_tags($username);
$upass = strip_tags($upass);

$password = hash('sha256', $upass);

$query = "SELECT username FROM LOA.t_user WHERE username = '$username'";
$result = mysqli_query($link, $query);

$row = mysqli_fetch_row($result);
if ($row) {
    $dataArray = array('success' => false, 'error' => 'user already exists');
} else {
    $query2 = "INSERT INTO LOA.t_user (
        username,
        password,
        signup_date
    ) values (
        '$username',
        '$password',
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