<?php
session_start(); // Start session

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Fetch user details
$userQuery = "SELECT profile_picture, name FROM users WHERE id = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($profilePicture, $username);
if (!$stmt->fetch()) {
    // If user not found, redirect to login
    header("Location: login.php");
    exit;
}
$stmt->close();

// Default profile picture if none is set
if (!$profilePicture) {
    $profilePicture = 'Images/default-pf-pic.jpg';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>.button-78 {
  align-items: center;
  appearance: none;
  background-clip: padding-box;
  background-color: initial;
  background-image: none;
  border-style: none;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-flex;
  justify-content: center;
  font-family: Eina01, sans-serif;
  font-size: 24px;  /* Adjust the font size for the icon */
  font-weight: 800;
  padding: 20px;  /* Adjust padding to make the button circular */
  min-height: 64px;
  outline: none;
  overflow: visible;
  pointer-events: auto;
  position: relative;
  text-align: center;
  text-decoration: none;
  text-transform: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
  width: 64px;  /* Fixed width and height to make it circular */
  height: 64px; /* Same as width for a circle */
  z-index: 0;
  border-radius: 50%; /* Makes the button circular */
}

@media (min-width: 768px) {
  .button-78 {
    padding: 20px;  /* Keep it consistent on larger screens */
  }
}

.button-78:before,
.button-78:after {
  border-radius: 50%;
}

.button-78:before {
  background-image: linear-gradient(92.83deg, #ff7426 0, #f93a13 100%);
  content: "";
  display: block;
  height: 100%;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: -2;
}

.button-78:after {
  background-color: initial;
  background-image: linear-gradient(#541a0f 0, #0c0d0d 100%);
  bottom: 4px;
  content: "";
  display: block;
  left: 4px;
  overflow: hidden;
  position: absolute;
  right: 4px;
  top: 4px;
  transition: all 100ms ease-out;
  z-index: -1;
}

.button-78:hover:not(:disabled):before {
  background: linear-gradient(92.83deg, rgb(255, 116, 38) 0%, rgb(249, 58, 19) 100%);
}

.button-78:hover:not(:disabled):after {
  bottom: 0;
  left: 0;
  right: 0;
  top: 0;
  transition-timing-function: ease-in;
  opacity: 0;
}

.button-78:active:not(:disabled) {
  color: #ccc;
}

.button-78:active:not(:disabled):before {
  background-image: linear-gradient(0deg, rgba(0, 0, 0, .2), rgba(0, 0, 0, .2)), linear-gradient(92.83deg, #ff7426 0, #f93a13 100%);
}

.button-78:active:not(:disabled):after {
  background-image: linear-gradient(#541a0f 0, #0c0d0d 100%);
  bottom: 4px;
  left: 4px;
  right: 4px;
  top: 4px;
}

.button-78:disabled {
  cursor: default;
  opacity: .24;
}

/* Icon styles */
.fa-home {
  font-size: 32px; /* Adjust size of the home icon */
}
</style>
</head>
<body>
    
    <div class="profile-container">
    <a href="index.php">
  <button class="button-78" role="button">
  <i class="fa fa-home"></i> <!-- Font Awesome Home Icon -->

  </button>
</a>
        <!-- Profile Picture -->
        <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="profile-picture">

        <!-- User Name -->
        <div class="profile-name"><?php echo htmlspecialchars($username); ?></div>

        <!-- Links -->
        <div class="profile-links">
            <a href="playlist.php" title="Playlist" class="playlist-img"></a>
            <a href="Watched.php" title="Just Watched" class="justwatched-img"> </a>
            <a href="Liked.php" title="Liked" class="liked-img"></a>
        </div>

        
        <!-- Logout Button -->
        <div class="logout-button">
            <form action="logout.php" method="post">
                <button class="button-85" role="button" type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
