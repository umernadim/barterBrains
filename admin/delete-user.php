<?php
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
  header('Location:../index.php');
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = (int) $_GET['id'];

    $sql = "DELETE FROM users WHERE id = $user_id";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header('Location: users-table.php');
        exit;
    } else {
        echo "<script>alert('Failed to delete account'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid user ID'); window.history.back();</script>";
}
