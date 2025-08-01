<?php
include 'config.php';

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    $pincode = rand(1001,9999);

    $_SESSION['pincode'] = $pincode;
    $_SESSION['forgotPasswordEmail'] = $email;

    // TODO: Validate that this email exists in your DB before proceeding

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';            // Set the SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'itsumernadeem@gmail.com';      // Your Gmail address
        $mail->Password   = 'tbtw qkoe infs ksjh';       // App password or Gmail password (use app password if 2FA is on)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('itsumernadeem@gmail.com', 'BarterBrains');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Hi,<br><br> Your verification code is $pincode " . $email . "' </a><br><br>Kindly, ignore this email,If you didn't request.";

        $mail->send();
        echo "<script>alert('Reset password code has been sent to your email');</script>";
        echo "<script>window.location.href = 'verify-code.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup | BarterBrains</title>
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
    <section id="forgot-password" class="changeTheme">
      <div id="container">
        <span><i class="ri-lock-2-fill"></i></span>
        <h3>Reset password</h3>
        <p>Enter your email to reset your password</p>
        <div id="form-content">
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
           <div class="input-group">
            <i class="ri-mail-line"></i>
            <input type="email" name="email" placeholder="Enter your email" required />
          </div>
          <button type="submit">Reset Password</button>
       </form>
        </div>
      </div>
    </section>
  </body>
</html>
