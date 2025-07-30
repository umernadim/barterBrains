<?php
include "config.php";
session_start();
if (!isset($_SESSION["email"])) {
  header("Location: index.php");
  exit();
}
$user_id = $_SESSION["user_id"];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit-profile | BarterBrains</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body class="edit-profile-pg changeTheme">
    <main>
      <nav>
        <div id="nav-left">
          <img src="assets/profile-img.jpg" alt="" />
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
          <div id="form-container">
            <?php
          include "config.php";

          $sql = "SELECT * FROM users WHERE id ={$user_id}";
          $result = mysqli_query($connect, $sql);
          if (mysqli_num_rows($result) >
            0) { $row = mysqli_fetch_assoc($result); ?>

            <form
              action="update-edit-profile.php"
              method="post"
              enctype="multipart/form-data"
            >
              <!-- Cover Photo -->
              <div id="cover-wrapper">
                <div id="cover-box">
                  <img
                    src="uploads/<?= $row['cover_photo']; ?>"
                    id="cover-img"
                    alt="Cover Photo"
                  />
                </div>
                <label for="coverInput" class="camera-icon cover-camera">
                  <i class="ri-camera-line"></i>
                </label>
                <input
                  type="file"
                  name="cover_photo"
                  id="coverInput"
                  accept="image/*"
                  style="display: none"
                />
              </div>

              <!-- Profile Photo -->
              <div id="profile-wrapper">
                <div id="profile-box">
                  <img
                    src="<?= !empty($row['profile_photo']) ? 'uploads/'.$row['profile_photo'] : 'assets/profile-img.jpg' ?>"
                    id="profile-img"
                    alt="Profile Photo"
                  />
                </div>
                <label for="profileInput" class="camera-icon profile-camera">
                  <i class="ri-camera-line"></i>
                </label>
                <input
                  type="file"
                  id="profileInput"
                  name="profile_photo"
                  accept="image/*"
                  style="display: none"
                />
              </div>

              <div id="input-fields">
                <div class="input-row">
                  <div class="input-group">
                    <label for="fname">First Name</label>
                    <input
                      type="text"
                      name="fname"
                      id="fname"
                      value="<?= $row['first_name']; ?>"
                      placeholder="Enter your first name"
                      required
                    />
                  </div>
                  <div class="input-group">
                    <label for="lname">Last Name</label>
                    <input
                      type="text"
                      name="lname"
                      id="lname"
                      value="<?= $row['last_name']; ?>"
                      placeholder="Enter your last name"
                      required
                    />
                  </div>
                </div>

                <div class="input-group">
                  <label for="email">Email</label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    value="<?= $row['email']; ?>"
                    placeholder="Enter your email"
                    required
                  />
                </div>

                <div class="input-row">
                  <div class="input-group">
                    <label for="city">City</label>
                    <input
                      type="text"
                      name="city"
                      id="city"
                      value="<?= $row['city']; ?>"
                      placeholder="Enter your city"
                      required
                    />
                  </div>
                  <div class="input-group">
                    <label for="country">Country</label>
                    <input
                      type="text"
                      name="country"
                      id="country"
                      value="<?= $row['country']; ?>"
                      placeholder="Enter your country"
                      required
                    />
                  </div>
                </div>

                <div class="input-group">
                  <label for="profession">Profession</label>
                  <input
                    type="text"
                    name="profession"
                    id="profession"
                    value="<?= $row['profession']; ?>"
                    placeholder="E.g: English Tutor, Developer"
                    required
                  />
                </div>

                <div class="input-group">
                  <label for="skill_teach">Skill to Teach</label>
                  <input
                    type="text"
                    name="skill_teach"
                    id="skill_teach"
                    value="<?= $row['teach_skills']; ?>"
                    placeholder="E.g: Guitar, Programming"
                    required
                  />
                </div>

                <div class="input-group">
                  <label for="skill_learn">Skill to Learn</label>
                  <input
                    type="text"
                    name="skill_learn"
                    id="skill_learn"
                    value="<?= $row['learn_skills']; ?>"
                    placeholder="E.g: English, Video Editing"
                    required
                  />
                </div>

                <div class="input-group">
                  <label for="about">About You</label>
                  <textarea
                    name="about"
                    id="about"
                    rows="3"
                    placeholder="Tell us something about yourself"
                    required
                  >
<?= $row['about']; ?></textarea
                  >
                </div>

                <button type="submit" name="save">Save Changes</button>
              </div>
            </form>

            <?php
            }
          ?>
          </div>
        </div>
      </section>

      <?php
    include "components/footer.php";
    ?>
    </main>

    <script src="script.js"></script>
  </body>
</html>
