<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    if (empty($appointment_date) || empty($appointment_time) || empty($reason)) {
        $message = "All fields are required.";
    } else {
        $sql = "INSERT INTO appointments (user_id, appointment_date, appointment_time, reason)
                VALUES ('$user_id', '$appointment_date', '$appointment_time', '$reason')";

        if (mysqli_query($conn, $sql)) {
            $message = "Appointment booked successfully.";
        } else {
            $message = "Error booking appointment.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/validation.js" defer></script>
</head>
<body>

<nav class="navbar">
    <h2>Appointment System</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="bookappointment.php">Book Appointment</a>
        <a href="myappointment.php">My Appointments</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="form-container">
    <form method="POST" onsubmit="return validateAppointmentForm()" class="form-card">
        <h2>Book Appointment</h2>

        <?php if ($message != ""): ?>
            <p class="success"><?php echo $message; ?></p>
        <?php endif; ?>

        <label>Appointment Date</label>
        <input type="date" name="appointment_date" id="appointment_date">

        <label>Appointment Time</label>
        <input type="time" name="appointment_time" id="appointment_time">

        <label>Reason for Appointment</label>
        <textarea name="reason" id="reason" placeholder="Enter appointment reason"></textarea>

        <button type="submit">Book Appointment</button>
    </form>
</div>

</body>
</html>