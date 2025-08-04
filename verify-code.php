<?php
include 'config.php';

session_start();

if (isset($_SESSION['email'])) {
  header("Location: index.php");
}


if (!isset($_SESSION['pincode'])) {
  header('location:forgot-password.php');
}


// code to resend pin code 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // if not already included

if (isset($_POST['resendBtn'])) {
    $newCode = rand(1001, 9999);
    $_SESSION['pincode'] = $newCode;

    $email = $_SESSION['forgotPasswordEmail'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'itsumernadeem@gmail.com';
        $mail->Password   = 'tbtw qkoe infs ksjh'; // use env/config in production
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('itsumernadeem@gmail.com', 'BarterBrains');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'New Verification Code';
        $mail->Body    = "Hi,<br><br>Your new verification code is <strong>$newCode</strong>.<br><br>Ignore this email if you didn't request it.";

        $mail->send();
        echo "<script>alert('A new verification code has been sent to your email.');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Failed to resend code. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
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
          
      <button type="submit" name="resendBtn" style="margin-top: 8px;" formnovalidate>Resend Code</button>
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