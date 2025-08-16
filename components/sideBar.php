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
        <?php
        if ($_SESSION['role'] === 'admin') {
        ?>
          <div class="link">
            <a href="admin/admin-panel.php">
              <i class="ri-dashboard-line"></i>
              <span>Dashboard</span>
            </a>
          </div>
        <?php } ?>
        <?php
        if ($_SESSION['role'] === 'user') {
        ?>
          <div class="link">
            <a href="messenger.php">
              <i class="ri-discuss-line"></i>
              <span>Messenger</span>
            </a>
          </div>
          <div class="link notification-icon">
            <?php
            include 'config.php';
           $user_id = $_SESSION['user_id'];
            $sql = "SELECT COUNT(receiver_id) AS notifications FROM connection_requests WHERE status = 'pending'
            AND receiver_id = $user_id";

            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <a href="#">
              <i class="ri-notification-3-line"></i>
              <span class="span">Notification</span>
              <span class="badge" id="notif-count"><?php
                if ($row['notifications'] > 0) {
                echo $row['notifications'];
                } else {
                echo " ";
                }
                ?>
              </span>
            </a>
          </div>
        <?php } ?>
        <div class="link">
          <button id="show-profile">
            <i class="ri-shield-user-line"></i>
            <span>Profile</span>
          </button>
        </div>
        <?php
        if ($_SESSION['role'] === 'user') {
        ?>
          <div class="link">
            <button id="leaveFeedbackBtn">
              <i class="ri-chat-1-line"></i>
              <span>Leave Feedback</span>
            </button>
          </div>
        <?php } ?>
        <div class="link">
          <button class="themeBtn">
            <i class="ri-sparkling-line"></i>
            <span>Dark mode</span>
          </button>
        </div>
      </div>

      <!-- Logout & Delete -->
      <?php
      if ($_SESSION['role'] === 'user') {
      ?>
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
      <?php } ?>
    </aside>