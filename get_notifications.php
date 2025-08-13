<?php
session_start();
include 'config.php';

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!isset($_SESSION['email'])) {
    header('location:index.php');
}

$sql = "SELECT cr.id, cr.status, u.first_name, u.profile_photo, cr.sent_at
        FROM connection_requests cr
        INNER JOIN users u ON cr.sender_id = u.id
        WHERE cr.receiver_id = $userId AND cr.status IN ('pending', 'accepted')
        ORDER BY cr.sent_at DESC";

$result = mysqli_query($connect, $sql);
$notifications = [
  'pending' => [],
  'accepted' => []
];

if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $notification = [
      'id' => $row['id'],
      'name' => $row['first_name'],
      'profile_photo' => !empty($row['profile_photo']) ? 'uploads/' . $row['profile_photo'] : 'assets/profile-img.jpg',
      'time' => time_elapsed_string($row['sent_at']),
    ];

    if ($row['status'] === 'pending') {
      $notifications['pending'][] = $notification;
    } elseif ($row['status'] === 'accepted') {
      $notifications['accepted'][] = $notification;
    }
  }
}

echo json_encode($notifications);


// Helper to show "x mins ago"
function time_elapsed_string($datetime, $full = false)
{
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  if ($diff->invert == 0) return 'Just now';

  $string = [
    'y' => 'year',
    'm' => 'month',
    'd' => 'day',
    'h' => 'hr',
    'i' => 'min',
    's' => 'sec',
  ];
  foreach ($string as $k => &$v) {
    if ($diff->$k) {
      $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    } else {
      unset($string[$k]);
    }
  }

  if (!$full) $string = array_slice($string, 0, 1);
  return $string ? implode(', ', $string) . ' ago' : 'Just now';
}
