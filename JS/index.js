
function validateSignupForm() {
    const fullName = document.getElementById("full_name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirm_password").value.trim();

    if (fullName === "") {
        alert("Full name is required.");
        return false;
    }

    if (email === "") {
        alert("Email is required.");
        return false;
    }

    if (!email.includes("@") || !email.includes(".")) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters.");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}

function validateLoginForm() {
    const email = document.getElementById("login_email").value.trim();
    const password = document.getElementById("login_password").value.trim();

    if (email === "") {
        alert("Email is required.");
        return false;
    }

    if (password === "") {
        alert("Password is required.");
        return false;
    }

    return true;
}

function validateAppointmentForm() {
    const date = document.getElementById("appointment_date").value;
    const time = document.getElementById("appointment_time").value;
    const reason = document.getElementById("reason").value.trim();

    if (date === "") {
        alert("Please select an appointment date.");
        return false;
    }

    if (time === "") {
        alert("Please select an appointment time.");
        return false;
    }

    if (reason === "") {
        alert("Please enter the reason for the appointment.");
        return false;
    }

    const selectedDate = new Date(date);
    const today = new Date();

    today.setHours(0, 0, 0, 0);

    if (selectedDate < today) {
        alert("Appointment date cannot be in the past.");
        return false;
    }

    return true;
}