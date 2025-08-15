<?php
session_start();
include 'config.php';

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$userId) {
  echo json_encode(['error' => 'Not logged in']);
  exit;
}

$requestId = isset($_POST['request_id']) ? intval($_POST['request_id']) : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;

if (!$requestId || ($action !== 'accept' && $action !== 'reject')) {
  echo json_encode(['error' => 'Invalid request']);
  exit;
}

$status = $action === 'accept' ? 'accepted' : 'rejected';

// Get sender and receiver IDs for this request
$getQuery = "SELECT sender_id, receiver_id FROM connection_requests WHERE id = ? AND receiver_id = ?";
$stmt = mysqli_prepare($connect, $getQuery);
mysqli_stmt_bind_param($stmt, 'ii', $requestId, $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$request = mysqli_fetch_assoc($result);

if (!$request) {
  echo json_encode(['error' => 'Request not found or unauthorized']);
  exit;
}

$senderId = $request['sender_id'];

// Update status
$updateQuery = "UPDATE connection_requests SET status = ? WHERE id = ?";
$stmt = mysqli_prepare($connect, $updateQuery);
mysqli_stmt_bind_param($stmt, 'si', $status, $requestId);

if (!mysqli_stmt_execute($stmt)) {
  echo json_encode(['error' => 'Failed to update request']);
  exit;
}

// If accepted, insert into connections table
if ($status === 'accepted') {
  $connQuery = "INSERT INTO connections (user1_id, user2_id, connected_at) VALUES (?, ?, NOW())";
  $stmt = mysqli_prepare($connect, $connQuery);
  mysqli_stmt_bind_param($stmt, 'ii', $senderId, $userId);
  if (!mysqli_stmt_execute($stmt)) {
    echo json_encode(['error' => 'Failed to save connection']);
    exit;
  }
}

echo json_encode(['success' => true, 'new_status' => $status]);
?>
