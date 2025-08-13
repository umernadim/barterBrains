<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | BarterBrains</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div id="dashboard" class="changeTheme">
    <!-- code for NavBar  -->
    <?php
    include "components/navBar.php"
    ?>

    <!-- code for sideBar  -->
    <?php
    include "components/sideBar.php"
    ?>

    <!-- code for suggested-user  -->
    <div id="suggested-user">

      <?php
      include "config.php";
      $user_id = $_SESSION["user_id"];
      $currentUserId = $_SESSION['user_id'];

      $user_query = mysqli_query($connect, "SELECT teach_skills, learn_skills FROM users WHERE id = $user_id");
      $user_data = mysqli_fetch_assoc($user_query);

      $user_teach = mysqli_real_escape_string($connect, $user_data['teach_skills']);
      $user_learn = mysqli_real_escape_string($connect, $user_data['learn_skills']);

      // 2. Get search input
      $search = '';
      if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($connect, $_GET['search']);
      }

      // 3. Query matched users
      $match_sql = "SELECT id, first_name, last_name, profile_photo, teach_skills, learn_skills, role 
              FROM users 
              WHERE id != $user_id 
              AND role != 'admin'
              AND (
                  teach_skills LIKE '%$user_learn%' 
                  OR learn_skills LIKE '%$user_teach%'
              )";


      if (!empty($search)) {
        $match_sql .= " AND (
      first_name LIKE '%$search%' OR
      last_name LIKE '%$search%' OR
      teach_skills LIKE '%$search%' OR
      learn_skills LIKE '%$search%'
    )";
      }

      $match_result = mysqli_query($connect, $match_sql);
      $matched_ids = [];

      while ($row = mysqli_fetch_assoc($match_result)) {
        $matched_users[] = $row;
        $matched_ids[] = $row['id'];
      }

      // 4. Query suggested users (excluding matched and self)
      $exclude_ids = implode(',', array_merge([$user_id], $matched_ids));
      $suggest_sql = "SELECT id, first_name, last_name, profile_photo, teach_skills, learn_skills 
      FROM users 
      WHERE id NOT IN ($exclude_ids) AND role !='admin'";

      if (!empty($search)) {
        $suggest_sql .= " AND (
      first_name LIKE '%$search%' OR
      last_name LIKE '%$search%' OR
      teach_skills LIKE '%$search%' OR
      learn_skills LIKE '%$search%'
    )";
      }

      $suggest_result = mysqli_query($connect, $suggest_sql);
      ?>

      <div id="suggested-user-header">
        <?php if (!empty($search)) : ?>
          <a href="dashboard.php" class="clear-search-btn">← Back to All</a>
        <?php endif; ?>

        <h2><?= (!empty($matched_users) || mysqli_num_rows($suggest_result) < 0) ? '🎯Best Matches for You..' : '🥺No matched found' ?></h2>

        <form action="" method="get">
          <input type="text" name="search" value="<?= htmlspecialchars($search); ?>" placeholder="Search user..." />
          <button type="submit"><i class="ri-user-search-line"></i></button>
        </form>
      </div>

      <div id="cards-container">
        <?php if (!empty($matched_users)) {  ?>
          <div id="matching-users">
            <div class="card-group">
              <?php foreach ($matched_users as $row) {  ?>
                <div class="card">
                  <img src="<?= !empty($row['profile_photo']) ? 'uploads/' . $row['profile_photo'] : 'assets/profile-img.jpg' ?>" alt="" />
                  <h3><?= $row['first_name'] . ' ' . $row['last_name']; ?></h3>
                  <p>Teaches: <span id="tech-badge"><?= $row['teach_skills']; ?></span></p>
                  <p>Wants: <span id="Learn-badge"><?= $row['learn_skills']; ?></span></p>
                  <div id="buttons">
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

                    <a href="user-profile.php?profileId=<?= $row['id']; ?>">
                      <button>Profile</button>
                    </a>
                  </div>
                </div>
              <?php  }; ?>
            </div>
          </div>
        <?php  } ?>

        <?php if (mysqli_num_rows($suggest_result) > 0) {   ?>
          <div id="suggested-users">
            <h3 class="section-heading">🌐Suggested People..</h3>
            <div class="card-group">
              <?php while ($row = mysqli_fetch_assoc($suggest_result)) {   ?>
                <div class="card">
                  <img src="<?= !empty($row['profile_photo']) ? 'uploads/' . $row['profile_photo'] : 'assets/profile-img.jpg' ?>" alt="" />
                  <h3><?= $row['first_name'] . ' ' . $row['last_name']; ?></h3>
                  <p>Teaches: <span id="tech-badge"><?= $row['teach_skills']; ?></span></p>
                  <p>Wants: <span id="Learn-badge"><?= $row['learn_skills']; ?></span></p>
                  <div id="buttons">

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


                    <a href="user-profile.php?profileId=<?= $row['id']; ?>">
                      <button>Profile</button>
                    </a>
                  </div>
                </div>
              <?php  } ?>
            </div>
          </div>
        <?php  } ?>
      </div>

    </div>


    <!-- code for user-profile -->

    <?php
    include "config.php";
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT first_name, last_name,profession, city, country, profile_photo, cover_photo, teach_skills, learn_skills FROM users WHERE id = {$user_id}";

    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }
    ?>
    <div id="user-profile">
      <div id="profile-close-btn">
        <button id="closeProfileBtn">✖</button>
      </div>

      <div id="img-container">
        <img src="uploads/<?= $row['cover_photo'] ?>" alt="cover-photo" id="back-img" />
        <div class="profile-box">
          <img
            src="<?= !empty($row['profile_photo']) ? 'uploads/' . $row['profile_photo'] : 'assets/profile-img.jpg' ?>"
            alt="profile-photo" id="profile-img" />
        </div>
      </div>

      <div id="profile-content">
        <div id="buttons">
          <button>Messages</button>
          <a href="edit-profile.php">
            <button>Edit Profile</button>
          </a>
        </div>
        <h3 id="profile-name">
          <?= $row['first_name'] . " " . $row['last_name']; ?>
        </h3>
        <h4>
          <span><i class="ri-graduation-cap-fill"></i></span>
          <span>
            <?= !empty($row['profession']) ? $row['profession'] : 'profession'; ?>
          </span>
        </h4>
        <h4>
          <span><i class="ri-map-pin-fill"></i></span>
          <span id="city">
            <?= !empty($row['city']) ? $row['city'] : 'city'; ?>,
          </span>
          <span id="country">
            <?= !empty($row['country']) ? $row['country'] : 'country'; ?>
          </span>
        </h4>
        <div id="skill-badges">
          <h4>Teaching: <span id="teach">
              <?= $row['teach_skills']; ?>
            </span></h4>
          <h4>Learning: <span id="learn">
              <?= $row['learn_skills']; ?>
            </span></h4>
        </div>
      </div>
    </div>


    <?php
    include "config.php";
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT first_name, last_name, profession, city, country, profile_photo, teach_skills, learn_skills, about FROM users";

    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
    }
    ?>

    <!-- modal popup of the testimonial form  -->
    <div id="feedback-modal" class="modal">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Leave Your Feedback</h2>

        <form id="feedback-form" action="submit-feedback.php" method="POST">
          <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>" />

          <label for="name">Your Name</label>
          <input type="text" value="<?= ($_SESSION['first_name'] ?? '') . ' ' . ($_SESSION['last_name'] ?? '') ?>"
            readonly />


          <label for="testimonial">Your Feedback</label>
          <textarea name="comment" id="testimonial" placeholder="Write your experience..." required></textarea>

          <button type="submit" name="submit">Submit Feedback</button>

        </form>

      </div>
    </div>


    <!-- === notification Modal === -->
    <div id="notification-panel" class="notification-panel">
      <h4>Notifications</h4>


    </div>

    <!-- Code to show message popup after feedback -->
    <div id="toast">
      <div id="sample-toast" class="toast">Thanks for your feedback! 🙌</div>
    </div>


  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
  <script src="script.js"></script>

  <script>
    // function to confirm delete account
    function confirmDelete(event) {
      event.preventDefault(); // prevent default navigation
      const confirmed = confirm("Are you sure you want to delete your account?");
      if (confirmed) {
        window.location.href = "delete-user.php";
      }
    }

    // function to confirm logout account
    function confirmLogout(event) {
      event.preventDefault();
      const confirmed = confirm("Are you sure you want to logout your account?");
      if (confirmed) {
        window.location.href = "logout.php";
      }
    }
  </script>

  <!-- code to show toast after submitting feedback form  -->
  <?php if (isset($_SESSION['feedback_success'])): ?>
    <script>
      window.onload = function() {
        const toast = document.getElementById('sample-toast');
        toast.classList.add('show');

        setTimeout(() => {
          toast.classList.remove('show');
        }, 3000);
      };
    </script>
    <?php unset($_SESSION['feedback_success']); ?>
  <?php endif; ?>


</body>

</html>