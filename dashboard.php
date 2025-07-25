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
  <div id="dashboard">
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
          <img src="assets/profile-img.avif" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button class="request-btn">Connect</button>
            <button>Profile</button>
          </div>
        </div>

        <div class="card">
          <img src="assets/profile-img.avif" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>

        <div class="card">
          <img src="assets/profile-img.avif" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>

        <div class="card">
          <img src="assets/profile-img.avif" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>
        <div class="card">
          <img src="assets/profile-img.avif" alt="" />
          <h3>M.Umer</h3>
          <p>Teaches: <span id="tech-badge">Guitar</span></p>
          <p>Wants: <span id="Learn-badge">English</span></p>
          <div id="buttons">
            <button>Connect</button>
            <button>Profile</button>
          </div>
        </div>

        <div class="card">
          <img src="assets/profile-img.avif" alt="" />
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
    <div id="user-profile">
      <div id="profile-close-btn">
        <button id="closeProfileBtn">✖</button>
      </div>

      <div id="img-container">
        <img src="assets/profile-background-img.jpg" alt="" id="back-img" />
        <img src="assets/profile-img.avif" alt="" id="profile-img" />
      </div>

      <div id="profile-content">
        <div id="buttons">
          <button>Messages</button>
          <a href="edit-profile.php">
            <button>Edit Profile</button>
          </a>
        </div>
        <h3 id="profile-name">M.Umer</h3>
        <h4>
          <span id="city">Karachi, </span>
          <span id="country">Pakistan</span>
        </h4>
        <div id="skill-badges">
          <h4>Teaching: <span id="teach">Guitar</span></h4>
          <h4>Learning: <span id="learn">English</span></h4>
        </div>
      </div>
    </div>

    <!-- === User Profile Modal === -->
    <div id="profile-modal">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <div class="modal-left">
          <img
            src="assets/profile-img.avif"
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
        <form id="feedback-form">
          <label for="name">Your Name</label>
          <input type="text" id="name" placeholder="Your name" value="<?= $_SESSION['first_name']; ?>" required />

          <label for="testimonial">Your Feedback</label>
          <textarea
            id="testimonial"
            placeholder="Write your experience..."
            required></textarea>
          <button type="submit">Submit Feedback</button>
        </form>
      </div>
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
</body>

</html>