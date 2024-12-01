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

// Fetch gallery data for 'Hindi' language
$sql = "SELECT id, image_url, title, vpcode FROM gallery WHERE language = 'Hindi' ORDER BY RAND()";
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
<script>
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

    // Redirect to profile page
    function goToProfile() {
        window.location.href = 'profile.php';
    }
</script>

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
    <style>
        /* Popup and overlay styling */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9998;
            display: none; /* Hidden by default */
            border-radius: 0px;
        }

        .login-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none; /* Hidden by default */
        }

        .login-popup h3 {
            margin-bottom: 10px;
        }

        .login-popup p {
            margin-bottom: 20px;
        }

        .button-85 {
            padding: 0.6em 2em;
            border: none;
            outline: none;
            color: rgb(255, 255, 255);
            background: #111;
            cursor: pointer;
            position: relative;
            z-index: 0;
            border-radius: 10px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .button-85:before {
            content: "";
            background: linear-gradient(
                45deg,
                #ff0000,
                #ff7300,
                #fffb00,
                #48ff00,
                #00ffd5,
                #002bff,
                #7a00ff,
                #ff00c8,
                #ff0000
            );
            position: absolute;
            top: -2px;
            left: -2px;
            background-size: 400%;
            z-index: -1;
            filter: blur(5px);
            -webkit-filter: blur(5px);
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: glowing-button-85 20s linear infinite;
            transition: opacity 0.3s ease-in-out;
            border-radius: 10px;
        }

        @keyframes glowing-button-85 {
            0% {
                background-position: 0 0;
            }
            50% {
                background-position: 400% 0;
            }
            100% {
                background-position: 0 0;
            }
        }

        .button-85:after {
            z-index: -1;
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: #222;
            left: 0;
            top: 0;
            border-radius: 10px;
        }

        /* Show the popup and overlay when not logged in */
        .overlay.show, .login-popup.show {
            display: block;
        }
    </style>
</head>
<body>
<?php if (!$isLoggedIn): ?>
    <div class="overlay show"></div>
    <div class="login-popup show">
        <h3>Please Log In</h3>
        <p>You must log in to access this page.</p>
        <button class="button-85" role="button" onclick="window.location.href='login.php'">Log In</button>
    </div>
<?php endif; ?>

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
            <button class="btn" type="button" onclick="window.location.href='urdu.php'">Urdu</button>
            <button class="btn" type="button" onclick="window.location.href='punjabi.php'">Punjabi</button>
            <button class="btn" type="button" onclick="window.location.href='english.php'">English</button>
            <button class="btn" type="button" onclick="window.location.href='hindi.php'">Hindi</button>
            <button class="btn" type="button" onclick="window.location.href='h-dubbed.php'">H-Dubbed</button>
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
</script>

<script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-content');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
