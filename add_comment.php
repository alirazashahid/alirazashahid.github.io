<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form has been submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the POST request
    $vpcode = $_POST['vpcode'];          // Unique video identifier
    $username = $_POST['username'];      // User's name
    $comment_text = $_POST['comment_text']; // User's comment
    $created_at = date('Y-m-d H:i:s');   // Current timestamp

    // Prepare the SQL statement to insert data into the 'comments' table
    $stmt = $conn->prepare("INSERT INTO comments (vpcode, username, comment_text, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $vpcode, $username, $comment_text, $created_at);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect back to the video page with the same 'vpcode'
        header("Location: video.php?vpcode=" . $vpcode);
        exit();
    } else {
        // Display an error message if the query fails
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
