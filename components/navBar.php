<?php
include "./config.php";
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
  exit;
}
$user_id = $_SESSION["user_id"];

$sql = "SELECT first_name, last_name ,profile_photo, profession FROM users WHERE id = {$user_id}";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
}
?>


<nav>
  <div id="nav-left">
    <img src="./uploads/<?= $row['profile_photo']; ?>" alt="" />
    <div id="user-info">
      <h4><?= $row['first_name']." ".$row['last_name']; ?></h4>
      <h4><?= $row['profession']; ?></h4>
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