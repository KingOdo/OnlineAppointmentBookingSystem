<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <h2>Booking System</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="book_appointment.php">Book Appointment</a>
        <a href="my_appointments.php">My Appointments</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="dashboard">
    <h1>Welcome, <?php echo $_SESSION['full_name']; ?>!</h1>
    <p>You can book a new appointment, view your appointments, or cancel an appointment.</p>

    <div class="dashboard-cards">
        <a href="book_appointment.php" class="dash-card">
            <h3>Book Appointment</h3>
            <p>Schedule a new appointment.</p>
        </a>

        <a href="my_appointments.php" class="dash-card">
            <h3>View Appointments</h3>
            <p>Check your booked appointments.</p>
        </a>
    </div>
</div>

</body>
</html>