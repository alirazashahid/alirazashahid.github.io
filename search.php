<?php
session_start(); // Start session

// Database connection
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
$profilePicture = 'Images/default-pf-pic.jpg'; // Default profile picture
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

// Search query
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Search Results</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center;
        }
        .frame {
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }
        .frame:hover {
            transform: scale(1.05);
        }
        .frame img {
            width: 100%;
            height: auto;
            display: block;
        }
        .frame .title {
            padding: 10px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
        /* Request Form Styling */
        .request-form {
            margin: 50px auto;
            padding: 20px;
            max-width: 500px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .request-form h2 {
            text-align: center;
            color: #2f4ad0;
            margin-bottom: 20px;
        }
        .request-form input, .request-form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .request-form button {
            background-color: #2f4ad0;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .request-form button:hover {
            background-color: #1c3586;
        }
    </style>
    <script>
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

        // Trigger search when Enter key is pressed
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            searchInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    searchMovies();
                }
            });
        });
       
    </script>
</head>
<body>
    <!-- Navigation bar -->
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

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="playlist.php" title="Playlist" class="playlist-img"></a>
        <a href="Watched.php" title="Just Watched" class="justwatched-img"></a>
        <a href="Liked.php" title="Liked" class="liked-img"></a>
    </div>

    <h1>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h1>
    <div class="gallery">
        <?php
        if ($searchQuery) {
            $stmt = $conn->prepare("SELECT id, image_url, title, vpcode FROM gallery WHERE title LIKE ?");
            $searchTerm = '%' . $searchQuery . '%';
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="frame" onclick="window.location.href=\'video.php?vpcode=' . $row["vpcode"] . '\'">';
                    echo '<img src="' . htmlspecialchars($row["image_url"]) . '" alt="' . htmlspecialchars($row["title"]) . '">';
                    echo '<div class="title">' . htmlspecialchars($row["title"]) . '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p style="text-align: center; color: gray;">No results found. Please request the film below.</p>';
                ?>
                <div class="request-form">
                    <h2>Request the Film</h2>
                    <form action="request_film.php" method="POST">
                        <input type="text" name="film_name" placeholder="Film Name" required>
                        <input type="email" name="email" placeholder="Your Email" required>
                        <button type="submit">Request Film</button>
                    </form>
                </div>
                <?php
            }

            $stmt->close();
        } else {
            echo "<p>Please enter a search query.</p>";
        }
        $conn->close();
        ?>
    </div>
    
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-content');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
