<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM appointments 
        WHERE user_id = '$user_id' 
        ORDER BY appointment_date ASC, appointment_time ASC";

$result = mysqli_query($conn, $sql);

$total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM appointments WHERE user_id = '$user_id'");
$total_row = mysqli_fetch_assoc($total_query);

$booked_query = mysqli_query($conn, "SELECT COUNT(*) AS booked FROM appointments WHERE user_id = '$user_id' AND status = 'Booked'");
$booked_row = mysqli_fetch_assoc($booked_query);

$cancelled_query = mysqli_query($conn, "SELECT COUNT(*) AS cancelled FROM appointments WHERE user_id = '$user_id' AND status = 'Cancelled'");
$cancelled_row = mysqli_fetch_assoc($cancelled_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Appointments | Booking System</title>
    <link rel="stylesheet" href="css/style.css?v=10">
</head>
<body>

<nav class="navbar">
    <h2>Booking System</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="bookappointment.php">Book Appointment</a>
        <a href="myappointment.php" class="active-link">My Appointments</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<main class="appointments-page">

    <section class="appointments-header">
        <div>
            <span class="appointments-label">Appointment Records</span>
            <h1>My Appointments</h1>
            <p>View your booked appointments, track appointment status, and cancel bookings when necessary.</p>
        </div>

        <a href="bookappointment.php" class="appointments-action-btn">Book New Appointment</a>
    </section>

    <section class="appointments-summary">
        <div class="summary-box">
            <span>Total Appointments</span>
            <h3><?php echo $total_row['total']; ?></h3>
        </div>

        <div class="summary-box">
            <span>Booked</span>
            <h3><?php echo $booked_row['booked']; ?></h3>
        </div>

        <div class="summary-box">
            <span>Cancelled</span>
            <h3><?php echo $cancelled_row['cancelled']; ?></h3>
        </div>
    </section>

    <section class="appointments-table-card">
        <div class="table-title">
            <h2>Appointment List</h2>
            <p>All your appointment details are shown below.</p>
        </div>

        <div class="table-wrapper">
            <table>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Appointment Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['appointment_date']; ?></td>
                            <td><?php echo $row['appointment_time']; ?></td>
                            <td><?php echo $row['reason']; ?></td>
                            <td>
                                <?php if ($row['status'] == "Booked"): ?>
                                    <span class="status-badge booked-badge">Booked</span>
                                <?php else: ?>
                                    <span class="status-badge cancelled-badge">Cancelled</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($row['status'] == "Booked"): ?>
                                    <a 
                                        href="cancel_appointment.php?id=<?php echo $row['id']; ?>" 
                                        class="cancel-btn"
                                        onclick="return confirm('Are you sure you want to cancel this appointment?')"
                                    >
                                        Cancel
                                    </a>
                                <?php else: ?>
                                    <span class="cancelled-text">Cancelled</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="empty-table-message">
                            No appointments found. You have not booked any appointment yet.
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </section>

</main>

</body>
</html>