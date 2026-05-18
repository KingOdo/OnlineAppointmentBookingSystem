<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    if (empty($appointment_date) || empty($appointment_time) || empty($reason)) {
        $message = "Please complete all fields before booking.";
        $message_type = "error";
    } else {
        $sql = "INSERT INTO appointments (user_id, appointment_date, appointment_time, reason)
                VALUES ('$user_id', '$appointment_date', '$appointment_time', '$reason')";

        if (mysqli_query($conn, $sql)) {
            $message = "Appointment booked successfully.";
            $message_type = "success";
        } else {
            $message = "Error booking appointment. Please try again.";
            $message_type = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment | Booking System</title>
  <link rel="stylesheet" href="css/style.css?v=10">
    <script src="js/index.js" defer></script>
</head>
<body>

<nav class="navbar">
    <h2>Booking System</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="bookappointment.php" class="active-link">Book Appointment</a>
        <a href="myappointment.php">My Appointments</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

<main class="booking-page">

    <section class="booking-wrapper">

        <div class="booking-info-panel">
            <div class="booking-image">
                <img src="images/onlinebooking.jpg" alt="Online appointment booking">
            </div>

            <div class="booking-info-content">
                <span class="booking-label">Easy Scheduling</span>
                <h1>Book Your Appointment</h1>
                <p>
                    Select your preferred appointment type, choose a suitable date and time,
                    then confirm your booking in just a few steps.
                </p>

                <div class="booking-services">
                    <div class="service-item">
                        <span>Work Meeting</span>
                        <small>Professional appointments and meetings</small>
                    </div>

                    <div class="service-item">
                        <span>Gym</span>
                        <small>Fitness and training sessions</small>
                    </div>

                    <div class="service-item">
                        <span>Health & Wellness</span>
                        <small>Wellness and personal care appointments</small>
                    </div>

                    <div class="service-item">
                        <span>Spa</span>
                        <small>Relaxation and spa bookings</small>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" onsubmit="return validateAppointmentForm()" class="booking-card">
            <div class="booking-form-header">
                <h2>Appointment Details</h2>
                <p>Complete the form below to schedule your appointment.</p>
            </div>

            <?php if ($message != ""): ?>
                <p class="<?php echo $message_type; ?>"><?php echo $message; ?></p>
            <?php endif; ?>

            <div class="input-group">
                <label>Appointment Type</label>
                <select name="reason" id="reason">
                    <option value="">Select appointment type</option>
                    <option value="Work Meeting">Work Meeting</option>
                    <option value="Gym">Gym</option>
                    <option value="Health & Wellness">Health & Wellness</option>
                    <option value="Spa">Spa</option>
                </select>
            </div>

            <div class="booking-date-row">
                <div class="input-group">
                    <label>Appointment Date</label>
                    <input type="date" name="appointment_date" id="appointment_date">
                </div>

                <div class="input-group">
                    <label>Appointment Time</label>
                    <input type="time" name="appointment_time" id="appointment_time">
                </div>
            </div>

            <button type="submit" class="primary-btn">Confirm Booking</button>
        </form>

    </section>

</main>

</body>
</html>