<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard | BarterBrains</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />

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
      <div id="suggested-user-header">
        <h2>Match for you..</h2>
        <form action="">
          <input
            type="text"
            name="search"
            value=""
            placeholder="Search user..." />
          <button type="submit"><i class="ri-user-search-line"></i></button>
        </form>
      </div>

      <div id="cards-container">
        <div class="card">
          <img src="assets/profile-img.jpg" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button class="request-btn">Connect</button>
            <button>Profile</button>
          </div>
        </div>

        <div class="card">
          <img src="assets/profile-img.jpg" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>

        <div class="card">
          <img src="assets/profile-img.jpg" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>

        <div class="card">
          <img src="assets/profile-img.jpg" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>
        <div class="card">
          <img src="assets/profile-img.jpg" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>

        <div class="card">
          <img src="assets/profile-img.jpg" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>
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
          <img src="<?= !empty($row['profile_photo']) ? 'uploads/' . $row['profile_photo'] : 'assets/profile-img.jpg' ?>" alt="profile-photo" id="profile-img" />
        </div>
      </div>

      <div id="profile-content">
        <div id="buttons">
          <button>Messages</button>
          <a href="edit-profile.php">
            <button>Edit Profile</button>
          </a>
        </div>
        <h3 id="profile-name"><?= $row['first_name'] . " " . $row['last_name']; ?></h3>
        <h4>
          <span><i class="ri-graduation-cap-fill"></i></span>
          <span><?= !empty($row['profession']) ? $row['profession'] : 'profession'; ?></span>
        </h4>
        <h4>
          <span><i class="ri-map-pin-fill"></i></span>
          <span id="city"><?= !empty($row['city']) ? $row['city'] : 'city'; ?>, </span>
          <span id="country"><?= !empty($row['country']) ? $row['country'] : 'country'; ?></span>
        </h4>
        <div id="skill-badges">
          <h4>Teaching: <span id="teach"><?= $row['teach_skills']; ?></span></h4>
          <h4>Learning: <span id="learn"><?= $row['learn_skills']; ?></span></h4>
        </div>
      </div>
    </div>

    <!-- === User Profile Modal === -->
    <div id="profile-modal">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div class="modal-left">
          <img
            src="assets/profile-img.jpg"
            alt="Profile Picture"
            class="profile-pic" />
          <h2>M.Umer</h2>
          <h4>Web Developer</h4>

          <div class="modal-buttons">
            <button>Message</button>
            <button>Connect</button>
          </div>

          <div class="modal-info">
            <p><strong>Teaches:</strong> Guitar</p>
            <p><strong>Wants:</strong> English</p>
            <p><strong>Location:</strong> Karachi, Pakistan</p>
            <p>
              <strong>About:</strong> Passionate about learning and sharing
              knowledge.
            </p>
          </div>
        </div>

        <div class="modal-right">
          <h3>Reviews</h3>
          <div class="review">
            <p>Great teacher! Learned a lot.</p>
            <span>- Student A</span>
          </div>
          <div class="review">
            <p>Very helpful and patient.</p>
            <span>- Student B</span>
          </div>
        </div>
      </div>
    </div>

    <!-- modal popup of the testimonial form  -->
    <div id="feedback-modal" class="modal">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Leave Your Feedback</h2>

        <form id="feedback-form" action="submit-feedback.php" method="POST">
          <!-- Hidden: user_id -->
          <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>" />

          <label for="name">Your Name</label>
          <input type="text" value="<?= $_SESSION['first_name']; ?>" readonly />

          <label for="testimonial">Your Feedback</label>
          <textarea name="comment" id="testimonial" placeholder="Write your experience..." required></textarea>

          <label for="rating">Rating</label>
          <select name="rating" id="rating" required>
            <option value="">Select Rating</option>
            <option value="5">🌟🌟🌟🌟🌟</option>
            <option value="4">🌟🌟🌟🌟</option>
            <option value="3">🌟🌟🌟</option>
            <option value="2">🌟🌟</option>
            <option value="1">🌟</option>
          </select>

          <button type="submit" name="submit">Submit Feedback</button>
        </form>
      </div>
    </div>

        <!-- Code to show message popup after feedback -->
    <div id="toast">
        <div id="sample-toast" class="toast">Thanks for your feedback! 🙌</div>
    </div>

    <!-- REQUEST CALL MODAL -->
    <div class="modal-overlay" id="callModal">
      <div class="callModal">
        <div class="modal-content">
          <p id="modal-status">Sending request...</p>
          <button id="joinCallBtn" style="display: none">Join Call</button>
        </div>
      </div>
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

<?php if (isset($_SESSION['feedback_success'])): ?>
    <script>
        window.onload = function () {
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