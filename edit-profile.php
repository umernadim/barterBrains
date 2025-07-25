<?php
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit-profile | BarterBrains</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body class="edit-profile-pg">
  <main>
    <nav>
      <div id="nav-left">
        <img src="assets/profile-img.avif" alt="" />
        <div id="user-info">
          <h4>M.Umer</h4>
          <h4>Profession</h4>
        </div>
      </div>

      <!-- Only visible on desktop -->
      <a href="dashboard.php" id="backTopdb" class="desktop-only">
        <i class="ri-arrow-left-line"></i> Back to Home
      </a>
    </nav>

    <section id="edit-profile">
      <div id="container">
        <!-- Cover Photo -->
        <div id="cover-wrapper">
          <img
            src="assets/profile-background-img.jpg"
            id="cover-img"
            alt="Cover Photo" />
          <label for="coverInput" class="camera-icon cover-camera">
            <i class="ri-camera-line"></i>
          </label>
          <input
            type="file"
            id="coverInput"
            accept="image/*"
            style="display: none" />
        </div>

        <!-- Profile Photo -->
        <div id="profile-wrapper">
          <img
            src="assets/profile-img.avif"
            id="profile-img"
            alt="Profile Photo" />
          <label for="profileInput" class="camera-icon profile-camera">
            <i class="ri-camera-line"></i>
          </label>
          <input
            type="file"
            id="profileInput"
            accept="image/*"
            style="display: none" />
        </div>

        <!-- Form Fields -->
        <!-- Form Fields -->
        <div id="form-container">
          <form>
            <div class="input-row">
              <div class="input-group">
                <input type="text" placeholder="First Name" required />
              </div>
              <div class="input-group">
                <input type="text" placeholder="Last Name" required />
              </div>
            </div>

            <div class="input-group">
              <input type="email" placeholder="Email" required />
            </div>

            <div class="input-row">
              <div class="input-group">
                <input type="text" placeholder="City" required />
              </div>
              <div class="input-group">
                <input type="text" placeholder="Country" required />
              </div>
            </div>

            <div class="input-group">
              <input
                type="text"
                placeholder="Profession (e.g: English Tutor, Developer)"
                required />
            </div>
            <div class="input-group">
              <input
                type="text"
                placeholder="Skill to Teach (e.g: Guitar, Programming)"
                required />
            </div>
            <div class="input-group">
              <input
                type="text"
                placeholder="Skill to Learn (e.g: English, Video editing)"
                required />
            </div>
            <div class="input-group">
              <textarea placeholder="About" rows="3" required></textarea>
            </div>
            <button type="submit">Save Changes</button>
          </form>
        </div>
      </div>
    </section>

    <?php
    include "components/footer.php";
    ?>
  </main>
</body>

</html>