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
    <title>Dashboard | Booking System</title>
  <link rel="stylesheet" href="css/style.css?v=10">
</head>
<body>

<nav class="navbar">
    <h2>Booking System</h2>
    <div>
        <a href="dashboard.php" class="active-link">Dashboard</a>
        <a href="bookappointment.php">Book Appointment</a>
        <a href="myappointment.php">My Appointments</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<main class="dashboard-page">

    <section class="dashboard-hero">
        <div class="dashboard-text">
            <span class="dashboard-label">Appointment Management</span>
            <h1>Welcome, <?php echo $_SESSION['full_name']; ?>!</h1>
            <p>
                Book new appointments, view your scheduled bookings, and cancel appointments
                whenever necessary from one simple dashboard.
            </p>

            <div class="dashboard-actions">
                <a href="bookappointment.php" class="dashboard-btn primary-dashboard-btn">Book Appointment</a>
                <a href="myappointment.php" class="dashboard-btn secondary-dashboard-btn">View Appointments</a>
            </div>
        </div>

        <div class="dashboard-image-box">
            <img src="images/img2.jpg" alt="Online appointment booking">
        </div>
    </section>

    <section class="dashboard-section">
        <div class="section-heading">
            <h2>What would you like to do?</h2>
            <p>Choose an option below to continue managing your appointments.</p>
        </div>

        <div class="dashboard-cards">
            <a href="bookappointment.php" class="dash-card">
                <span>01</span>
                <h3>Book Appointment</h3>
                <p>
                    Schedule a new appointment for a work meeting, gym session,
                    health and wellness visit, or spa booking.
                </p>
            </a>

            <a href="myappointment.php" class="dash-card">
                <span>02</span>
                <h3>View Appointments</h3>
                <p>
                    Check your booked appointments, review appointment details,
                    and cancel bookings when needed.
                </p>
            </a>
        </div>
    </section>

</main>

</body>
</html>