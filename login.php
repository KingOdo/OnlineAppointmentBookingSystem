<?php
session_start();
include "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $message = "Email and password are required.";
    } else {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];

                header("Location: dashboard.php");
                exit();
            } else {
                $message = "Incorrect password.";
            }
        } else {
            $message = "No account found with that email.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign In | Booking System</title>
    <link rel="stylesheet" href="css/style.css?v=10">
    <script src="js/index.js" defer></script>
</head>
<body>

<div class="login-page">

    <div class="login-image-section">
        <img src="images/onlinebooking.jpg" alt="Online booking system">

        <div class="login-overlay"></div>

        <div class="login-image-text">
            <h1>Welcome Back</h1>
            <p>
                Sign in to manage your bookings, view your appointments, and keep your schedule organized.
            </p>
        </div>
    </div>

    <div class="login-form-section">
        <form method="POST" onsubmit="return validateLoginForm()" class="login-card">
            <div class="login-header">
                <h2>Sign In</h2>
                <p>Access your appointment dashboard</p>
            </div>

            <?php if ($message != ""): ?>
                <p class="error"><?php echo $message; ?></p>
            <?php endif; ?>

            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" id="login_email" placeholder="Enter your email">
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" id="login_password" placeholder="Enter your password">
            </div>

            <button type="submit" class="primary-btn">Sign In</button>

            <p class="switch-text">
                Don't have an account? <a href="signup.php">Create one</a>
            </p>
        </form>
    </div>

</div>

</body>
</html>