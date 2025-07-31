<?php
session_start();
include "config.php";

if (isset($_POST['submit'])) {
  $fname = mysqli_real_escape_string($connect, $_POST['first-name']);
  $lname = mysqli_real_escape_string($connect, $_POST['last-name']);
  $email = mysqli_real_escape_string($connect, $_POST['email']);
  $password = mysqli_real_escape_string($connect, md5($_POST['password']));

  $check = "SELECT email FROM users WHERE email = '{$email}'";
  $result = mysqli_query($connect, $check);

  if (mysqli_num_rows($result) > 0) {
    echo "<div>Email already exist</div>";
  } else {
    $insert = "INSERT INTO users(first_name, last_name,email, password) VALUES ('{$fname}','{$lname}','{$email}','{$password}')";
    if (mysqli_query($connect, $insert)) {

      $user_id = mysqli_insert_id($connect);
      $_SESSION['user_id'] = $user_id;;

      header('Location:setUp-profile.php');
      exit;
    } else {
      echo "<div>Registration failed.</div>";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup | BarterBrains</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <section id="signup" class="changeTheme">
    <div id="container">
      <div id="form-content">
        <h3>Sigup to BarterBrains</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="input-row">
            <div class="input-group">
              <i class="ri-user-line"></i>
              <input type="text" placeholder="First name" name="first-name" required />
            </div>
            <div class="input-group">
              <i class="ri-user-line"></i>
              <input type="text" placeholder="Last name" name="last-name" required />
            </div>
          </div>
          <div class="input-group">
            <i class="ri-mail-line"></i>
            <input type="email" placeholder="Enter email" name="email" required />
          </div>
          <div class="input-group">
            <i class="ri-lock-2-line"></i>
            <input type="password" placeholder="Enter your password" name="password" required />
          </div>
          <button type="submit" name="submit">Signup</button>
        </form>
        <div id="links">
          <span>
            Already have an account? <a href="login.php">Login</a>
          </span>
        </div>
      </div>

      <div id="img-div">
        <img src="assets/signup-image.jpg" alt="Login Illustration" />
      </div>

    </div>
  </section>

</body>

</html>