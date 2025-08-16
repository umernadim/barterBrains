<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
$currentUserId = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Messenger | BarterBrains</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section id="messenger" class="changeTheme">
    <!-- Sidebar -->

    <div class="chat-sidebar">
      <div class="sidebar-header">
        <a href="dashboard.php" class="dashboard-back-btn">
            <button>
            ← Back
              </button>
          </a>
        <input type="text" placeholder="Search users..." class="search-users" />
        <h2>Chats</h2>
      </div>
      <div class="chat-users" id="user-list">
        <!-- Users will be loaded here by loadUsers() -->
      </div>

    </div>

    <!-- Chat area -->
    <div class="chat-main">
      <div class="chat-header">
        <button class="back-btn" onclick="goBack()">←</button>
        <img src="assets/profile-img.jpg" alt="User" />
        <span id="chat-with">Select a chat</span>
        <button class="video-call-btn" onclick="startVideoCall()">
          <i class="ri-video-on-line"></i>
        </button>
      </div>
      <div class="chat-messages" id="chat-messages">
        <!-- Messages will load here -->
      </div>
      <div class="chat-input">
        <input type="text" id="message-input" placeholder="Type a message..." />
        <button id="send-btn">Send</button>
      </div>
    </div>
  </section>

  <script>
    let currentUserId = <?php echo $currentUserId; ?>;
    let receiverId = null;
    const chatBox = document.getElementById("chat-messages");
    const input = document.getElementById("message-input");
    const sendBtn = document.getElementById("send-btn");

    // Open Chat
    function openChat(id, name) {
      receiverId = id;
      document.querySelector(".chat-sidebar").classList.add("hidden");
      document.querySelector(".chat-main").classList.add("active");
      document.getElementById("chat-with").innerText = name;
      loadMessages();
    }

    // Go Back
    function goBack() {
      document.querySelector(".chat-sidebar").classList.remove("hidden");
      document.querySelector(".chat-main").classList.remove("active");
    }

    // Send Message
    function sendMessage() {
      if (!receiverId) return;
      let message = input.value.trim();
      if (message !== "") {
        fetch("send_message.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "receiver_id=" + receiverId + "&message=" + encodeURIComponent(message),
        }).then(() => {
          input.value = "";
          loadMessages(); // refresh chat
        });
      }
    }

    sendBtn.addEventListener("click", sendMessage);

    // Send on Enter
    input.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        sendMessage();
      }
    });

    // Load Messages
    function loadMessages() {
      if (!receiverId) return;
      fetch("get_messages.php?receiver_id=" + receiverId)
        .then((res) => res.json())
        .then((data) => {
          chatBox.innerHTML = "";
          data.forEach((msg) => {
            let div = document.createElement("div");
            div.className =
              "message " + (msg.sender_id == currentUserId ? "sent" : "received");
            div.textContent = msg.message;
            chatBox.appendChild(div);
          });
          chatBox.scrollTop = chatBox.scrollHeight;
        });
    }

    // Refresh messages every 2 seconds
    setInterval(loadMessages, 2000);

    function startVideoCall() {
      alert("Starting video call...");
    }


    function loadUsers() {
      fetch("get_users.php")
        .then((res) => res.json())
        .then((users) => {
          const userList = document.getElementById("user-list");
          userList.innerHTML = "";
          if (users.length === 0) {
            userList.innerHTML = "<p>No connections yet.</p>";
            return;
          }
          users.forEach((user) => {
            const div = document.createElement("div");
            div.className = "chat-user";
            div.onclick = () => openChat(user.id, user.first_name);
            div.innerHTML = `
          <img src="${user.profile_image || 'assets/profile-img.jpg'}" alt="User"/>
          <span>${user.first_name}</span>
        `;
            userList.appendChild(div);
          });
        });
    }

    loadUsers();

    // 🔍 Search filter (optional)
    function filterUsers() {
      let input = document.querySelector(".search-users").value.toLowerCase();
      let users = document.querySelectorAll(".chat-user span");
      users.forEach(u => {
        let parent = u.closest(".chat-user");
        if (u.textContent.toLowerCase().includes(input)) {
          parent.style.display = "flex";
        } else {
          parent.style.display = "none";
        }
      });
    }
  </script>
</body>

</html>