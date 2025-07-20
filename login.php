<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | BarterBrains</title>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <section id="login">
    <div id="container">
      <div id="img-div">
        <img src="assets/signin-image.jpg" alt="Login Illustration" />
      </div>

      <div id="form-content">
        <h3>Login to BarterBrains</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="input-group">
            <i class="ri-mail-line"></i>
            <input type="email" placeholder="Enter your email" name="email" required />
          </div>
          <div class="input-group">
            <i class="ri-lock-2-line"></i>
            <input type="password" placeholder="Enter your password" name="password" required />
          </div>
          <button type="submit" name="login">Login</button>
        </form>
        <div id="links">
          <span>
            Don't have an account? <a href="signup.php">Signup</a>
          </span>
          <span>
            <a href="forgot-password.php">Forgot password?</a>
          </span>
        </div>

        <?php
     
        if (isset($_POST['login'])) {
          $email = mysqli_real_escape_string($connect, $_POST['email']);
          $password = mysqli_real_escape_string($connect, md5($_POST['password']));

          $query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'";
          $result = mysqli_query($connect, $query);

         if(mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
           $_SESSION["first_name"] = $row['first_name'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["user_id"] = $row['id'];

            header('Location:dashboard.html');
            exit;
        } else {
          echo "<div>Invalid login credentials.</div>";
        }
 }

        ?>

      </div>
    </div>
  </section>

</body>

</html>