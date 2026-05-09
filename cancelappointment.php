<?php
session_start();
include "config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE appointments 
            SET status = 'Cancelled' 
            WHERE id = '$appointment_id' AND user_id = '$user_id'";

    mysqli_query($conn, $sql);
}

header("Location: my_appointments.php");
exit();
?>