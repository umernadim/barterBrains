<?php
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
  header('Location:../index.php');
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $feedback_id = (int) $_GET['id'];

    $sql = "DELETE FROM reviews WHERE id = $feedback_id";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header('Location: feedback-table.php');
        exit;
    } else {
        echo "<script>alert('Failed to delete feedback'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid ID'); window.history.back();</script>";
 }
