

 <?php
                    $sender_id = (int)$currentUserId;
                    $receiver_id = (int)$row['id'];

                    // Check if already connected
                    $checkConnection = "SELECT * FROM connection_requests 
                    WHERE ((sender_id = $sender_id AND receiver_id = $receiver_id)
                        OR (sender_id = $receiver_id AND receiver_id = $sender_id))
                      AND status = 'accepted'";
                    $connResult = mysqli_query($connect, $checkConnection);
                    $isConnected = mysqli_num_rows($connResult) > 0;

                    // Check if request already sent and pending
                    $checkPending = "SELECT * FROM connection_requests 
                    WHERE sender_id = $sender_id AND receiver_id = $receiver_id AND status = 'pending'";
                    $pendingResult = mysqli_query($connect, $checkPending);
                    $alreadyRequested = mysqli_num_rows($pendingResult) > 0;
                    ?>


                    <?php if ($isConnected): ?>
                      <button class="request-btn connected-btn" disabled>Connected</button>
                    <?php elseif ($alreadyRequested): ?>
                      <button class="request-btn connect-btn" data-requested="true" disabled>Requested</button>
                    <?php else: ?>
                      <button class="request-btn connect-btn" data-receiver-id="<?= $receiver_id ?>">Connect</button>
                    <?php endif; ?>

send_request.php page code..

<?php
include 'config.php'; 
session_start();

if (!isset($_SESSION['user_id'])) {
  http_response_code(401);
  echo json_encode(['error' => 'Not authenticated']);
  exit;
}

$sender_id = $_SESSION['user_id'];
$receiver_id = isset($_POST['receiver_id']) ? intval($_POST['receiver_id']) : 0;

if (!$receiver_id || $receiver_id === $sender_id) {
  http_response_code(400);
  echo json_encode(['error' => 'Invalid request']);
  exit;
}

// Check if request already exists
$check_query = "SELECT * FROM connection_requests WHERE sender_id = ? AND receiver_id = ?";
$stmt = mysqli_prepare($connect, $check_query);
mysqli_stmt_bind_param($stmt, 'ii', $sender_id, $receiver_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
  echo json_encode(['message' => 'Request already sent']);
  exit;
}

// Insert new request
$insert_query = "INSERT INTO connection_requests (sender_id, receiver_id, status, sent_at) VALUES (?, ?, 'pending', NOW())";
$stmt = mysqli_prepare($connect, $insert_query);
mysqli_stmt_bind_param($stmt, 'ii', $sender_id, $receiver_id);

if (mysqli_stmt_execute($stmt)) {
  echo json_encode(['message' => 'Request sent']);
} else {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to send request']);
}
?>



handle_connection_action.php page code

<?php
session_start();
include 'config.php';

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$userId) {
  echo json_encode(['error' => 'Not logged in']);
  exit;
}

$requestId = isset($_POST['request_id']) ? intval($_POST['request_id']) : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;

if (!$requestId || ($action !== 'accept' && $action !== 'reject')) {
  echo json_encode(['error' => 'Invalid request']);
  exit;
}

$status = $action === 'accept' ? 'accepted' : 'rejected';

// Get sender and receiver IDs for this request
$getQuery = "SELECT sender_id, receiver_id FROM connection_requests WHERE id = ? AND receiver_id = ?";
$stmt = mysqli_prepare($connect, $getQuery);
mysqli_stmt_bind_param($stmt, 'ii', $requestId, $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$request = mysqli_fetch_assoc($result);

if (!$request) {
  echo json_encode(['error' => 'Request not found or unauthorized']);
  exit;
}

$senderId = $request['sender_id'];

// Update status
$updateQuery = "UPDATE connection_requests SET status = ? WHERE id = ?";
$stmt = mysqli_prepare($connect, $updateQuery);
mysqli_stmt_bind_param($stmt, 'si', $status, $requestId);

if (!mysqli_stmt_execute($stmt)) {
  echo json_encode(['error' => 'Failed to update request']);
  exit;
}

// If accepted, insert into connections table
if ($status === 'accepted') {
  $connQuery = "INSERT INTO connections (user1_id, user2_id, connected_at) VALUES (?, ?, NOW())";
  $stmt = mysqli_prepare($connect, $connQuery);
  mysqli_stmt_bind_param($stmt, 'ii', $senderId, $userId);
  if (!mysqli_stmt_execute($stmt)) {
    echo json_encode(['error' => 'Failed to save connection']);
    exit;
  }
}

echo json_encode(['success' => true, 'new_status' => $status]);
?>

get_notifications.php page code...
<?php
session_start();
include 'config.php';

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$userId) {
  echo json_encode(['error' => 'Not logged in']);
  exit;
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


js code...

const panel = document.getElementById("notification-panel");

// Load notifications from the server when the DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  fetchNotifications();
});

// Function to fetch and display notifications
function fetchNotifications() {
  fetch("get_notifications.php")
    .then((res) => res.json())
    .then((data) => {
      if (data.error) {
        console.error("Error loading notifications:", data.error);
        return;
      }

      panel.innerHTML = ""; // Clear existing

      // Show pending requests with Accept/Reject
      if (Array.isArray(data.pending)) {
        data.pending.forEach((n) => {
          showNotification(n.name, n.time, n.profile_photo, n.id, "pending");
        });
      }

      // Show accepted requests as connected
      if (Array.isArray(data.accepted)) {
        data.accepted.forEach((n) => {
          showNotification(n.name, n.time, n.profile_photo, n.id, "accepted");
        });
      }
    });
}

// Function to display a notification in the panel
function showNotification(
  userName,
  timeAgo = "Just now",
  profilePhoto = "assets/profile-img.jpg",
  requestId,
  status = "pending"
) {
  const notificationItem = document.createElement("div");
  notificationItem.className = "notification-item";

  let actionsHTML = "";

  if (status === "pending") {
    actionsHTML = `
      <button class="accept-btn" data-id="${requestId}">Accept</button>
      <button class="reject-btn" data-id="${requestId}">Reject</button>
    `;
  } else if (status === "accepted") {
    actionsHTML = `<span class="accepted-label">✅ Connected</span>`;
  }

  notificationItem.innerHTML = `
    <img src="${profilePhoto}" alt="${userName}">
    <div class="notification-text">
      <strong>${userName}</strong> wants to connect with you.
      <div class="notification-actions">
        ${actionsHTML}
      </div>
      <small>${timeAgo}</small>
    </div>
  `;

  panel.appendChild(notificationItem);
}

document.addEventListener("click", function (e) {
  if (
    e.target.classList.contains("accept-btn") ||
    e.target.classList.contains("reject-btn")
  ) {
    const requestId = e.target.getAttribute("data-id");
    const action = e.target.classList.contains("accept-btn") ? "accept" : "reject";
    const notificationItem = e.target.closest(".notification-item");

    fetch("handle_connection_action.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `request_id=${requestId}&action=${action}`,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          const actionsDiv = notificationItem.querySelector(".notification-actions");

          if (action === "accept") {
            if (actionsDiv) {
              actionsDiv.innerHTML = `<span class="accepted-label">✅ Connected</span>`;
            }

            notificationItem.classList.add("connected");

            // ✅ Update user card button (Connect -> Connected)
            const userCardBtn = document.querySelector(
              `.connect-btn[data-receiver-id="${requestId}"]`
            );
            if (userCardBtn) {
              userCardBtn.outerHTML =
                '<button class="request-btn connected-btn" disabled>Connected</button>';
            }
          } else {
            // Remove rejected notification
            notificationItem.remove();
          }
        } else {
          alert(data.error || "Something went wrong");
        }
      });
  }

  // Send connection request
  if (e.target.classList.contains("connect-btn")) {
    const button = e.target;
    const receiverId = button.dataset.receiverId;

    fetch("send_request.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `receiver_id=${receiverId}`,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.message) {
          button.innerText = "Requested";
          button.disabled = true;
        } else {
          alert(data.error || "Something went wrong");
        }
      });
  }
});





