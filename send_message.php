<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized");
}

$sender_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];
$message = mysqli_real_escape_string($connect, $_POST['message']);

$query = "INSERT INTO messages (sender_id, receiver_id, message) 
          VALUES ($sender_id, $receiver_id, '$message')";

mysqli_query($connect, $query);
?>
