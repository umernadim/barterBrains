<?php
header('Content-Type: application/json');
require 'config.php';

if (!isset($_SESSION['email'])) {
    header('location:index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestId = intval($_POST['request_id']);

    if ($requestId > 0) {
        $query = "UPDATE connection_requests SET status = 'accepted' WHERE id = $requestId";
        if (mysqli_query($connect, $query)) {
            echo json_encode([
                'success' => true,
                'message' => 'Connection accepted successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Database error: ' . mysqli_error($connect)
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid request ID'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
