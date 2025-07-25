<?php
include "./config.php";
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit;
}
?>


<nav>
  <div id="nav-left">
    <img src="assets/profile-img.avif" alt="" />
    <div id="user-info">
      <h4><?php echo $_SESSION['first_name']; ?></h4>
      <h4>Profession</h4>
    </div>
  </div>


  <a href="#" id="mobileMenuBtn" class="mobile-menu-btn">
    <i class="ri-menu-line"></i>
  </a>

  <!-- Only visible on desktop -->
  <a href="logout.php" id="logoutLink" class="desktop-only">
    Logout <i class="ri-logout-circle-r-line"></i>
  </a>
</nav>