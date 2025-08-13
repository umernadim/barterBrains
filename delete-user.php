<?php
include "config.php";
session_start();
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}

$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM users WHERE id = {$user_id}";
if (mysqli_query($connect, $sql)) {
    // redirect to homepage or goodbye page
    header("Location: index.php");
    exit;
} else {
    echo "<script>alert('Failed to delete account'); window.history.back();</script>";
}

mysqli_close($connect);
?>
