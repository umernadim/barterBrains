<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>user-profile | BarterBrains</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body id="profile-pg" class="changeTheme">

  <?php include 'components/navBar2.php'; ?>

  <?php
  include 'config.php';
  $id = $_GET['profileId'];

  $sql = "SELECT first_name, last_name, profession, city, country, teach_skills, learn_skills, profile_photo, cover_photo FROM users WHERE id = $id";
  $result = mysqli_query($connect, $sql);
  if ($row = mysqli_fetch_assoc($result)) {

  ?>
    <section id="profile">
      <div class="profile-container">
        <div class="profile-left">
          <div class="cover-img">
            <img src="<?= !empty($row['cover_photo']) ? 'uploads/' . $row['cover_photo'] : 'assets/profile-background-img.jpg' ?>" alt="Cover Image">
          </div>
          <div class="profile-img">
            <img src="<?= !empty($row['profile_photo']) ? 'uploads/' . $row['profile_photo'] : 'assets/profile-img.jpg' ?>" alt="Profile Image" />
          </div>
          <h2 class="user-name"><?= $row['first_name'] . ' ' . $row['last_name']; ?></h2>
          <p class="user-role"><?= $row['profession']; ?></p>
          <div class="profile-buttons">
            <button class="connect-btn">Connect</button>
            <button class="message-btn">Message</button>
          </div>
        </div>

        <div class="profile-right">
          <h3>Bio & Details</h3>
          <div class="details-grid">
            <div><strong>Teaches:</strong> <?= $row['teach_skills']; ?></div>
            <div><strong>Wants:</strong> <?= $row['learn_skills']; ?></div>
            <div><strong>Location:</strong><?= !empty($row['city']) && !empty($row['country']) ? $row['city'] . ', ' . $row['country'] : 'city, country'; ?></div>
            <div><strong>About:</strong> <?= !empty($row['about']) ? $row['about'] : 'Hey there! i am here to exchange my skill.' ?></div>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>



  <?php
  include 'components/footer.php';
  ?>


<script src="script.js"></script>
</body>

</html>