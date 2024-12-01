<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "videos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $deleteId = intval($_POST['delete_id']);
    $deleteStmt = $conn->prepare("DELETE FROM film_requests WHERE id = ?");
    $deleteStmt->bind_param("i", $deleteId);

    if ($deleteStmt->execute()) {
        $message = "Request deleted successfully.";
    } else {
        $message = "Failed to delete the request. Please try again.";
    }
    $deleteStmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Film Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
        }

        .message {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }

        .delete-btn {
            background-color: #d9534f;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

<h1>Film Requests</h1>

<?php if (isset($message)): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Film Name</th>
            <th>Email</th>
            <th>Requested At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch all requests
        $sql = "SELECT * FROM film_requests ORDER BY requested_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['film_name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['requested_at']) ?></td>
            <td>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="delete_id" value="<?= htmlspecialchars($row['id']) ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </td>
        </tr>
        <?php
            endwhile;
        else:
        ?>
        <tr>
            <td colspan="5" style="text-align: center;">No requests found.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$conn->close();
?>

</body>
</html>
