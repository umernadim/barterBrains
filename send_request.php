<?php
include 'config.php'; 
session_start();

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['error' => 'Not authenticated']);
  exit;
}

$sender_id = $_SESSION['user_id'];
$receiver_id = isset($_POST['receiver_id']) ? intval($_POST['receiver_id']) : 0;

if (!$receiver_id || $receiver_id === $sender_id) {
  http_response_code(400);
  echo json_encode(['error' => 'Invalid request']);
  exit;
}

// Check if request already exists
$check_query = "SELECT * FROM connection_requests WHERE sender_id = ? AND receiver_id = ?";
$stmt = mysqli_prepare($connect, $check_query);
mysqli_stmt_bind_param($stmt, 'ii', $sender_id, $receiver_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
  echo json_encode(['message' => 'Request already sent']);
  exit;
}

// Insert new request
$insert_query = "INSERT INTO connection_requests (sender_id, receiver_id, status, sent_at) VALUES (?, ?, 'pending', NOW())";
$stmt = mysqli_prepare($connect, $insert_query);
mysqli_stmt_bind_param($stmt, 'ii', $sender_id, $receiver_id);

if (mysqli_stmt_execute($stmt)) {
  echo json_encode(['message' => 'Request sent']);
} else {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to send request']);
}
?>

