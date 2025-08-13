<?php
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
  header('Location:../index.php');
}

// Query: Count users per month
$sql = "SELECT DATE_FORMAT(created_at, '%M %Y') AS month, COUNT(*) AS total
        FROM users
        GROUP BY DATE_FORMAT(created_at, '%Y-%m')
        ORDER BY DATE_FORMAT(created_at, '%Y-%m') ASC";
        
$result = mysqli_query($connect, $sql);

$labels = [];
$values = [];

while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['month'];
    $values[] = $row['total'];
}

echo json_encode([
    'labels' => $labels,
    'values' => $values
]);
?>
