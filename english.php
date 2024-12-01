<?php
session_start(); // Start session

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Fetch gallery data for English videos
$sql = "SELECT id, image_url, title, vpcode FROM gallery WHERE language = 'English' ORDER BY RAND()";
$result = $conn->query($sql);

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/logo.png" type="image/png">
    <title>Moviezoon</title>
</head>
<body>
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
            <button type="button" onclick="window.location.href='hindi.php'">Hindi</button>
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

    <div class="gallery">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="frame" id="picture-' . $row["id"] . '" onclick="window.location.href=\'video.php?vpcode=' . $row["vpcode"] . '\'">';
                echo '<img src="' . $row["image_url"] . '" alt="' . $row["title"] . '">';
                echo '<div class="title">' . $row["title"] . '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No pictures available.</p>";
        }

        $conn->close();
        ?>
    </div>

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

        // Function to handle search
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
    
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-content');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
