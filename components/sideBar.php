    <aside id="sidebar">
  <!-- Sidebar Header -->
  <div id="sidebar-header">
    <h2>BarterBrains</h2>
    <i id="menuBtn" class="ri-menu-3-line"></i>
  </div>

  <!-- Sidebar Links -->
  <div id="sidebar-links">
    <div class="link">
      <a href="dashboard.php">
        <i class="ri-home-9-line"></i>
        <span>Home</span>
      </a>
    </div>
    <div class="link">
      <a href="#">
        <i class="ri-discuss-line"></i>
        <span>Messages</span>
      </a>
    </div>
    <div class="link">
      <a href="#">
        <i class="ri-notification-3-line"></i>
        <span>Notification</span>
      </a>
    </div>
    <div class="link">
      <button id="show-profile">
        <i class="ri-shield-user-line"></i>
        <span>Profile</span>
      </button>
    </div>
    <div class="link">
      <button id="leaveFeedbackBtn">
        <i class="ri-chat-1-line"></i>
        <span>Leave Feedback</span>
      </button>
    </div>
    <div class="link">
      <button class="themeBtn">
        <i class="ri-sparkling-line"></i>
        <span>Dark mode</span>
      </button>
    </div>
  </div>

  <!-- Logout & Delete -->
  <div id="logout">
    <a href="logout.php" onclick="confirmLogout(event)">
      <i class="ri-logout-circle-r-line"></i>
      <span>Logout</span>
    </a>
    <a href="delete-user.php" onclick="confirmDelete(event)">
      <i class="ri-delete-bin-4-line"></i>
      <span>Delete account</span>
    </a>
  </div>
</aside>
