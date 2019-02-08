<?php
include_once 'database.php';

$user_id = $_POST['user_id'];

if ($user_id == '') {
    $dataArray = array('success' => false, 'error' => 'no user id provided');
    header('Content-Type: application/json');
    die(json_encode($dataArray));
}

$user_id = strip_tags($user_id);

$query = "SELECT item_id FROM LOA.t_user_item WHERE user_id = '$user_id'";
$dataArray = array();

if ($result = mysqli_query($link, $query)) {
  // Fetch one and one row
  while ($row = mysqli_fetch_row($result)) {
  	$dataArray[] = array('item_id' => $row[0]);
  }
  // Free result set
  mysqli_free_result($result);
}

header('Content-Type: application/json');
echo json_encode($dataArray);
?>