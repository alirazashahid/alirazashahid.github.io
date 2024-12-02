<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filmName = isset($_POST['film_name']) ? trim($_POST['film_name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    // Validate inputs
    if (!empty($filmName) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO film_requests (film_name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $filmName, $email);

        if ($stmt->execute()) {
            echo "<h2 style='text-align: center; color: green;'>Your request for '$filmName' has been received. You will get it within 11 hours!</h2>";
        } else {
            echo "<h2 style='text-align: center; color: red;'>An error occurred while submitting your request. Please try again later.</h2>";
        }

        $stmt->close();
    } else {
        echo "<h2 style='text-align: center; color: red;'>Invalid input. Please go back and enter valid details.</h2>";
    }
} else {
    echo "<h2 style='text-align: center; color: red;'>Invalid access. Please submit the form properly.</h2>";
}

$conn->close();
?>
