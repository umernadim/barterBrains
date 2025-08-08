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
            <img src="<?= !empty($row['profile_photo']) ? './uploads/'.$row['profile_photo'] : './assets/profile-img.jpg' ?>" alt="" />
            <div id="user-info">
                <h4><?= $row['first_name']." ".$row['last_name']; ?></h4>
                <h4><?= !empty($row['profession']) ? $row['profession'] : 'profession'; ?></h4>
            </div>
        </div>

        <!-- Only visible on desktop -->
        <a href="dashboard.php" id="backTopdb" class="desktop-only">
            <i class="ri-arrow-left-line"></i> Back to Home
        </a>
    </nav>