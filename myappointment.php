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
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Appointments</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <h2>Appointment System</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="book_appointment.php">Book Appointment</a>
        <a href="my_appointments.php">My Appointments</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<div class="table-container">
    <h2>My Booked Appointments</h2>

    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['appointment_time']; ?></td>
                    <td><?php echo $row['reason']; ?></td>
                    <td><?php echo $row['status']; ?></td>
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
                <td colspan="5">No appointments found.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>