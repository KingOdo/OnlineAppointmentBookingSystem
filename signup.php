<?php 
session_start();
include 'config/db.php';
$message='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        $message = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $check = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {
            $message = "Email already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (full_name, email, password) 
                    VALUES ('$full_name', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {
                header("Location: login.php");
                exit();
            } else {
                $message = "Error creating account.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
    <form method="POST" onsubmit="return validateSignupForm()" class="form-card">
        <h2>Create Account</h2>

        <?php if ($message != ""): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <label>Full Name</label>
        <input type="text" name="full_name" id="full_name" placeholder="Enter your full name">

        <label>Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email">

        <label>Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password">

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">

        <button type="submit">Sign Up</button>

        <p>Already have an account? <a href="login.php">Sign In</a></p>
    </form>
</div>
    
<script src="js/script.js" defer></script>
</body>
</html>