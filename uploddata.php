<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random 10-character code
function generateVpcode($length = 10) {
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $link = $_POST['link'];
    $language = $_POST['language'];
    $description = $_POST['description'];
    $vpcode = generateVpcode();

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $targetFile = $targetDir . uniqid() . '.' . $imageFileType;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imageUrl = $targetFile;

            // Insert data into the database
            $sql = "INSERT INTO gallery (image_url, title, link, vpcode, language, description) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $imageUrl, $title, $link, $vpcode, $language, $description);

            if ($stmt->execute()) {
                echo "Image uploaded and data saved successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Please upload an image.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery Upload</title>
    <style>
        /* Background Gradient */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #FF5F6D, #FFC371);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Centered Card */
        .upload-card {
            background-color: white;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        label {
            font-weight: bold;
            color: #666;
            display: block;
            margin-top: 1rem;
            text-align: left;
        }

        input[type="file"], input[type="text"], input[type="url"], textarea, select {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.3rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            margin-top: 1.5rem;
            background-color: #FF5F6D;
            color: white;
            padding: 0.7rem;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #E44A53;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .upload-card {
                width: 90%;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="upload-card">
        <h2>Upload an Image to Gallery</h2>
        <form action="uploddata.php" method="POST" enctype="multipart/form-data">
            <label for="image">Choose Image:</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="link">Link:</label>
            <input type="url" name="link" id="link" required>

            <label for="language">Language:</label>
            <select name="language" id="language" required>
                <option value="English">English</option>
                <option value="Urdu">Urdu</option>
                <option value="Hindi">Hindi</option>
                <option value="Punjabi">Punjabi</option>
                <option value="H-dubbed">H-dubbed</option>
            </select>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="3" required></textarea>

            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>
