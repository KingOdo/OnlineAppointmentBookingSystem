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
    <title>Sign In</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/validation.js" defer></script>
</head>
<body>

<div class="form-container">
    <form method="POST" onsubmit="return validateLoginForm()" class="form-card">
        <h2>Sign In</h2>

        <?php if ($message != ""): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <label>Email</label>
        <input type="email" name="email" id="login_email" placeholder="Enter your email">

        <label>Password</label>
        <input type="password" name="password" id="login_password" placeholder="Enter password">

        <button type="submit">Sign In</button>

        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </form>
</div>

</body>
</html>