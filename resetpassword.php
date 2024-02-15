<?php
include 'connection.php';

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Check if the token exists in the database
    $token_check_query = mysqli_query($conn, "SELECT * FROM `users` WHERE `reset_token`='$token'");
    if (mysqli_num_rows($token_check_query) == 1) {
        // Token is valid, allow the user to reset the password
        // Display a form to set a new password
        if (isset($_POST['submit-btn'])) {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

            if ($password === $confirm_password) {
                // Hash the new password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $update_query = mysqli_query($conn, "UPDATE `users` SET `password`='$hashed_password', `reset_token`=NULL WHERE `reset_token`='$token'");
                if ($update_query) {
                    $message = "Your password has been successfully reset.";
                } else {
                    $error = "Failed to reset password. Please try again.";
                }
            } else {
                $error = "Passwords do not match.";
            }
        }
    } else {
        $error = "Invalid or expired token.";
    }
} else {
    $error = "Token not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
    input[type="password"],
    input[type="submit"] {
        width: 60%; /* Change width to 80% */
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    .error {
        text-align: center;
        margin-bottom: 15px;
        padding: 10px;
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #ebccd1;
        border-radius: 5px;
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
    if (isset($error)) {
        echo '<div>'.$error.'</div>';
    }
    if (isset($message)) {
        echo '<div>'.$message.'</div>';
    }
    ?>
    <form method="post">
        <label>New Password:</label>
        <input type="password" name="password" required>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required>
        <input type="submit" name="submit-btn" value="Reset Password">
        <P>already have an account ? <a href="login.php">login now</a></p>
    </form>
</body>
</html>
