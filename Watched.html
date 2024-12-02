<?php
session_start(); // Start session

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Fetch user's profile picture if logged in
$profilePicture = 'Images/default-pf-pic.jpg'; // Default picture
if ($isLoggedIn && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $profileQuery = "SELECT profile_picture FROM user_database.users WHERE id = ?";
    $stmt = $conn->prepare($profileQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($profilePictureFromDb);
    if ($stmt->fetch() && $profilePictureFromDb) {
        $profilePicture = $profilePictureFromDb;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="images/logo.png" type="image/png">
    <title>Moviezoon</title>
    <style>
        /* Existing styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f4f4f4;
        }
        .main-video { width: 80%; height: 500px; margin-top: 20px; border-radius:20px; background-color: #000; }
        .video-thumbnails { display: flex; flex-direction: column; gap: 20px; margin-top: 20px; width: 80%; }
        .video-thumbnail { display: flex; flex-direction: row; gap: 10px; align-items: center; cursor: pointer; }
        .video-thumbnail img { width: 120px; height: 80px; object-fit: cover; border-radius: 6px; }
        .video-thumbnail .video-info { font-size: 14px; color: #333; }
        .video-thumbnail .video-info .title { font-weight: bold; margin-bottom: 5px; }
        @media (max-width: 768px) { .main-video { width: 100%; height: 300px; } .video-thumbnails { width: 90%; } .video-thumbnail img { width: 100px; height: 60px; } }
    </style>
</head>
<body>
<script>
    // Prevent automatic scroll restoration by disabling it
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual'; // Disable scroll restoration
    }
    window.onload = function () {
        window.scrollTo(0, 0); // Always scroll to top on page load
    };

    // Redirect to profile page
    function goToProfile() {
        window.location.href = 'profile.php';
    }

    // Search functionality
    function searchMovies() {
        const searchInput = document.getElementById('search-input').value;
        if (searchInput.trim() !== "") {
            window.location.href = `search.php?query=${encodeURIComponent(searchInput)}`;
        }
    }

    // Trigger search on Enter key press
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                searchMovies();
            }
        });
    });
</script>

<nav class="navbar">
    <!-- Logo -->
    <a href="index.php" style="text-decoration: none;">
        <div class="logo" title="Moviezoon">M</div>
    </a>

    <!-- Search Bar -->
    <div class="search-bar">
        <input id="search-input" type="text" placeholder="Search...">
        <button onclick="searchMovies()">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
        </button>
    </div>

    <!-- Language Dropdown -->
    <div class="language-dropdown">
        <button type="button" onclick="window.location.href='urdu.php'">Urdu</button>
        <button type="button" onclick="window.location.href='punjabi.php'">Punjabi</button>
        <button type="button" onclick="window.location.href='english.php'">English</button>
        <button type="button" onclick="window.location.href='hindi.php'">Punjabi</button>
        <button type="button" onclick="window.location.href='h-dubbed.php'">H-Dubbed</button>
    </div>

        <!-- Language Dropdown for Mobile -->
        <div class="mobile-language-dropdown">
            <button class="btn dropdown-toggle" onclick="toggleDropdown()">Language</button>
            <div class="dropdown-content" id="dropdown-content">
                <a href="urdu.php">Urdu</a>
                <a href="punjabi.php">Punjabi</a>
                <a href="english.php">English</a>
                <a href="hindi.php">Hindi</a>
                <a href="h-dubbed.php">H-Dubbed</a>
            </div>
        </div>

    <!-- Profile Icon -->
    <div class="profile" onclick="goToProfile()">
        <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture">
    </div>
</nav>

<div class="sidebar">
    <a href="playlist.php" title="Playlist" class="playlist-img"></a>
    <a href="Watched.php" title="Just Watched" class="justwatched-img"></a>
    <a href="Liked.php" title="Liked" class="liked-img"></a>
</div>    

<div class="playlist-container">
    <h1> Coming Soon....</h1>

    </div>


<script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-content');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
