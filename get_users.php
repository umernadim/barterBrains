<?php
include 'config.php';
session_start();

$currentUserId = $_SESSION['user_id'];

$sql = "
    SELECT u.id, u.first_name, u.profile_photo
    FROM users u
    INNER JOIN connection_requests c 
        ON (
            (c.sender_id = $currentUserId AND c.receiver_id = u.id) 
            OR 
            (c.receiver_id = $currentUserId AND c.sender_id = u.id)
        )
    WHERE c.status = 'accepted' AND u.id != $currentUserId
";

$result = mysqli_query($connect, $sql);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

echo json_encode($users);
?>
