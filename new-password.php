<?php
include 'config.php';

session_start();
if (isset($_SESSION['email'])) {
    header("Location: index.php");
}

$forgotPasswordEmail = $_SESSION['forgotPasswordEmail'];

if (!isset($_SESSION['forgotPasswordEmail'])) {
    header('location:forgot-password.php');
}

if (isset($_POST['updatePasswordBtn'])) {

    $password = $_POST['password'];

    $hash_password = md5($_POST['password']);


    $insert = "UPDATE `users` SET `password`='$hash_password' WHERE `email`='$forgotPasswordEmail'";

    if (mysqli_query($connect, $insert)) {
        header('location:login.php');


    } else {
        echo "<div class='alert alert-danger text-center'>Password Updation failed.</div>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Password | BarterBrains</title>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
      <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <section id="new-password" class="changeTheme">
      <div id="container">
        <span><i class="ri-lock-2-fill"></i></span>
        <h3>New password</h3>
        <p>Enter new password to reset your account</p>
        <div id="form-content">
       <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
           <div class="input-group">
            <i class="ri-lock-password-line"></i>
            <input type="password" name="password" placeholder="Enter new password" required />
          </div>
          <button type="submit" name="updatePasswordBtn">Reset Password</button>
       </form>
        </div>
      </div>
    </section>
  </body>
</html>
