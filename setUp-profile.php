<?php 
session_start();
include "config.php";

if (!isset($_SESSION["user_id"])) {
  echo "You must signup to set up your profile";
  exit;
}

if (isset($_POST['submit'])) {
  $skillTeach = mysqli_real_escape_string($connect, $_POST['teach-skill']);
  $skillLearn = mysqli_real_escape_string($connect, $_POST['learn-skill']);

  $user_id = $_SESSION['user_id'];

    $update = "UPDATE users
              SET teach_skills='{$skillTeach}', learn_skills='{$skillLearn}' 
              WHERE id = {$user_id}";
    if (mysqli_query($connect, $update)) {
       header('Location:dashboard.php');
       exit;
    }else{
      echo "<div>Failed to update profile: " . mysqli_error($connect) . "</div>";

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Set up | BarterBrains</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <section id="setup-profile" class="changeTheme">
    <div id="container">
      <div id="img-div">
        <img src="assets/signin-image.png" alt="" />
      </div>

      <div id="form-content">
        <h3>Set up your Profile</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">   
          <div class="input-group">
            <i class="ri-presentation-fill"></i>
            <input type="text" placeholder="Skill you can teach (e.g: Guitar)" name="teach-skill" required />
          </div>
          <div class="input-group">
            <i class="ri-user-5-line"></i>
            <input type="text" placeholder="Skill you want to learn (e.g: English)" name="learn-skill" required />
          </div>
          <button type="submit" name="submit">Save</button>
        </form>
        <div id="links">
          <span>
            <a href="signup.php"><i class="ri-arrow-left-line"></i> Go Back</a>
          </span>
        </div>
      </div>
    </div>
  </section>

</body>
</html>
