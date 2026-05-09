<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Appointment Booking System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="hero">
    <div class="card">
        <h1>Online Appointment Booking System</h1>
        <p>Create an account, book appointments, view your bookings, and cancel when needed.</p>

        <div class="btn-group">
            <a href="signup.php" class="btn">Sign Up</a>
            <a href="login.php" class="btn secondary">Log In</a>
        </div>
    </div>
</div>
</body>
</html>