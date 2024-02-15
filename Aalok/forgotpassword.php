<?php
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if (isset($_POST['submit-btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Generate a unique token
    $token = bin2hex(random_bytes(32));

    // Update the user's reset_token in the database
    $update_query = mysqli_query($conn, "UPDATE `users` SET `reset_token`='$token' WHERE `email`='$email'");
    if ($update_query) {
        // Send email with reset link
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ak1433a@gmail.com'; // Your Gmail email address
            $mail->Password   = 'ysab wsvh guxo mlll'; // Your app-specific password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('ak1433a@gmail.com', 'aalok'); // Sender's email address and name
            $mail->addAddress($email); // Recipient's email address

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password';
            $mail->Body    = "To reset your password, please click the following link: <a href='http://localhost/aalok11-2-2024/aalok3_project/resetpassword.php?token=$token'>Reset Password</a>";
            
            $mail->send();
            $message[] = "Password reset link has been sent to your email.";
        } catch (Exception $e) {
            $message[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $message[] = "Failed to generate reset link. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="email"],
        input[type="submit"] {
            width: 50%;
            padding: 12px; /* Adjust the padding for the input field */
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px; /* Adjust the font size for the input field */
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px; /* Adjust the font size for the button */
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div>'.$msg.'</div>';
        }
    }
    ?>
    <form method="post">
        <label>Email:</label>
        <input type="email" name="email" required>
        <input type="submit" name="submit-btn" value="Submit">
        <P>already have an account ? <a href="login.php">login now</a></p>
    </form>
</body>
</html>
