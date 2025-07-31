<?php
session_start();
include "config.php";

if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($connect, $_POST['user_id']);
    $comment = mysqli_real_escape_string($connect, $_POST['comment']);

    $sql = "INSERT INTO reviews(user_id, comment) VALUES ($user_id, '$comment')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        $_SESSION['feedback_success'] = true;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>