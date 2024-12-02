<?php
session_start(); // Start session

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
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
$conn->close();
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
        /* Video player styling */
        .video-container {
            display: flex;
            justify-content: center;
            padding-top: 65px;
            width: 100%; /* Use 100% width to be responsive */
            max-width: 910px; /* Set a max width */
            aspect-ratio: 16 / 9; /* Maintain 16:9 aspect ratio */
        }

        /* Ensure the iframe fills the container */
        .video-container iframe {
            width: 100%;
            height: 100%;
            border: none;
            aspect-ratio: 16 / 9;
        }
 

        /* Popup and overlay styling */
 

    </style>
</head>
<body>
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
</script>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve vpcode from URL parameter
if (isset($_GET['vpcode'])) {
    $vpcode = $_GET['vpcode'];
    $stmt = $conn->prepare("SELECT link FROM gallery WHERE vpcode = ?");
    $stmt->bind_param("s", $vpcode);
    $stmt->execute();
    $stmt->bind_result($videoLink);
    $stmt->fetch();
    $stmt->close();
} else {
    echo "<p>Video code not provided!</p>";
    exit;
}
$conn->close();

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve video details and comments
$vpcode = $_GET['vpcode'] ?? null;
if ($vpcode) {
    // Get video data
    $stmt = $conn->prepare("SELECT link, title, description FROM gallery WHERE vpcode = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $vpcode);
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    $stmt->bind_result($videoLink, $videoTitle, $videoDescription);
    $stmt->fetch();
    $stmt->close();

    // Get comments
    $commentsStmt = $conn->prepare("SELECT username, comment_text FROM comments WHERE vpcode = ? ORDER BY created_at ASC");
    if (!$commentsStmt) {
        die("Error preparing comments statement: " . $conn->error);
    }

    $commentsStmt->bind_param("s", $vpcode);
    if (!$commentsStmt->execute()) {
        die("Error executing comments statement: " . $commentsStmt->error);
    }

    $comments = $commentsStmt->get_result();
    $commentsStmt->close();
} else {
    echo "<p>Video code not provided!</p>";
    exit;
}
$conn->close();

?>


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
    <div class="language-dropdown ">
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

<div class="video-container">
    <?php if (isset($videoLink)): ?>
        <?php 
            // Adjust the video URL if necessary
            // Check if the link is from ok.ru and modify to use the embed format
            if (strpos($videoLink, 'ok.ru/video/') !== false) {
                // Extract video ID from the link and format it to use with the embed URL
                preg_match('/ok\.ru\/video\/(\d+)/', $videoLink, $matches);
                $videoID = $matches[1] ?? null;
                if ($videoID) {
                    $embedLink = "//ok.ru/videoembed/$videoID?nochat=1";
                } else {
                    $embedLink = htmlspecialchars($videoLink); // Default to original link if ID not found
                }
            } else {
                $embedLink = htmlspecialchars($videoLink); // Use original link for non-ok.ru videos
            }
        ?>
        <iframe class="lazy-loaded" width="640" height="360" data-lazy-type="iframe" 
                data-src="<?php echo $embedLink; ?>" 
                frameborder="0" allow="autoplay" allowfullscreen="" 
                src="<?php echo $embedLink; ?>">
        </iframe>
    <?php else: ?>
        <p>Video not found!</p>
    <?php endif; ?>

</div>

<!-- Title Bar -->
<div class="title-bar">
    <?= htmlspecialchars($videoTitle ?? 'Unknown Video') ?>
</div>
<div class="action-bar">
  <!-- <button class="btn"><i class="fas fa-thumbs-up"></i> Like</button> --> 
    <button class="btn" id="share-button"><i class="fas fa-share-alt"></i> Share</button>
  <!--  <button class="btn"><i class="fas fa-folder-plus"></i> Save to Playlist</button> -->
</div>

<script>
    document.getElementById('share-button').addEventListener('click', function () {
        const pageUrl = window.location.href; // Get current page URL
        // Copy the URL to clipboard
        navigator.clipboard.writeText(pageUrl).then(() => {
            alert("Page link copied to clipboard!");
        }).catch(() => {
            alert("Failed to copy link. Please try manually.");
        });
        const actionBar = document.querySelector('.action-bar');
        actionBar.insertAdjacentHTML('beforeend', shareOptions);
    });
     // Redirect to profile page
     function goToProfile() {
        window.location.href = 'profile.php';
    }
</script>

<!-- Description Box -->
<div class="description-box">
    <p><?= htmlspecialchars($videoDescription ?? 'No description available.') ?></p>
    <span class="see-more" onclick="toggleDescription()">See more</span>
</div>

<script>
    function toggleDescription() {
        const description = document.querySelector('.description-box p');
        const seeMore = document.querySelector('.description-box .see-more');
        if (description.style.display === '-webkit-box') {
            description.style.display = 'block';
            seeMore.textContent = 'See less';
        } else {
            description.style.display = '-webkit-box';
            seeMore.textContent = 'See more';
        }
    }
</script>
    <!-- Comment Form -->

<form method="POST" action="add_comment.php" style="display: flex; flex-direction: column; gap: 10px;">
        <input type="hidden" name="vpcode" value="<?= htmlspecialchars($vpcode) ?>">
        <input type="text" name="username" placeholder="Your Name" required 
               style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; width: 100%;">
        <textarea name="comment_text" placeholder="Write a comment..." required 
                  style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; width: 100%; min-height: 80px;"></textarea>
        <button type="submit" style="background: #2f4ad0; color: #fff; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">
            Post Comment
        </button>
    </form>
<!-- Comments Section -->
<div class="comments-section" style="margin: 20px auto; max-width: 800px; padding: 10px;">
    <h3 style="text-align: center;">Comments</h3>

    <!-- Display Existing Comments -->
    <div class="comments-list" style="margin-bottom: 20px;">
        <?php if ($comments->num_rows > 0): ?>
            <?php while ($comment = $comments->fetch_assoc()): ?>
                <div class="comment" style="margin-bottom: 15px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                    <strong><?= htmlspecialchars($comment['username']) ?>:</strong>
                    <p><?= htmlspecialchars($comment['comment_text']) ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; color: gray;">No comments yet. Be the first to comment!</p>
        <?php endif; ?>
    </div>

    
</div>

<script>
     function goToProfile() {
        window.location.href = 'profile.php';
    }

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

