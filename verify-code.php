<?php
include 'config.php';

session_start();

if (isset($_SESSION['email'])) {
  header("Location: index.php");
}


if (!isset($_SESSION['pincode'])) {
  header('location:forgot-password.php');
}


if (isset($_POST['verifyBtn'])) {
  $verifyCode = $_POST['verifyCode'];

  if ($verifyCode == $_SESSION['pincode']) {

    // Unset the session variable after successful verification
    unset($_SESSION['pincode']);

    // Redirect to reset password page
    header("Location: new-password.php");
    exit();
  } else {
    echo "<script>alert('Invalid verification code. Please try again.');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verification | BarterBrains</title>
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <section id="verify-code" class="changeTheme">
    <div id="container">
      <span><i class="ri-shield-check-line"></i></span>
      <h3>Verification</h3>
      <p>Enter verification code to reset your password</p>
      <div id="form-content">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="input-group">
            <i class="ri-shield-keyhole-line"></i>
            <input
              type="text"
              name="verifyCode"
              placeholder="Enter code"
              inputmode="numeric"
              pattern="[0-9]*"
              required
              maxlength="4"
              id="verification-code" />
          </div>
          <button type="submit" name="verifyBtn">Verify Code</button>
        </form>
      </div>
    </div>
  </section>


  <script>
    // code to set input field to validate only numbers 
    let codeInput = document.getElementById("verification-code")
    codeInput.addEventListener('input', () => {
      codeInput.value = codeInput.value.replace(/\D/g, '');
    })
  </script>

</body>

</html>