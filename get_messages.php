<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized");
}

$currentUserId = $_SESSION['user_id'];
$receiverId = $_GET['receiver_id'];

$query = "SELECT sender_id, receiver_id, message, created_at 
          FROM messages 
          WHERE (sender_id = $currentUserId AND receiver_id = $receiverId)
             OR (sender_id = $receiverId AND receiver_id = $currentUserId)
          ORDER BY created_at ASC";

$result = mysqli_query($connect, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
