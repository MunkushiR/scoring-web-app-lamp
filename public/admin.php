<?php
// Include database connection file which sets up $pdo object for DB interaction
require_once '../config/db.php';

// Initialize message variable to hold success/error messages for user feedback
$message = '';

// Check if form was submitted via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and trim whitespace from submitted username and display name fields
    $username = trim($_POST['username'] ?? '');
    $display_name = trim($_POST['display_name'] ?? '');

    // Validate that both username and display name fields are not empty
    if ($username === '' || $display_name === '') {
        $message = 'Both fields are required.';
    } else {
        // Prepare a SELECT statement to check if the username already exists in 'judges' table
        $stmt = $pdo->prepare("SELECT id FROM judges WHERE username = ?");
        $stmt->execute([$username]);

        // If username exists, set an error message to notify user
        if ($stmt->fetch()) {
            $message = 'Username already exists. Choose another.';
        } else {
            // Username is unique, proceed to insert the new judge record into the database
            $insert = $pdo->prepare("INSERT INTO judges (username, display_name) VALUES (?, ?)");

            // Execute the insert statement with the provided username and display name
            if ($insert->execute([$username, $display_name])) {
                // Success message confirming judge addition
                $message = "Judge '{$display_name}' added successfully.";
            } else {
                // Generic error message if insertion fails
                $message = "Error adding judge.";
            }
        }
    }
}

// Retrieve all judges ordered alphabetically by display name to display in the list
$judges = $pdo->query("SELECT * FROM judges ORDER BY display_name ASC")->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Panel - Add Judges</title>
    <!-- Link to external CSS stylesheet -->
    <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
    <div class="container">
        <h1>Admin Panel - Add Judges</h1>

        <!-- Display feedback message; green for success, red for errors -->
        <?php if ($message): ?>
            <p style="color: <?= strpos($message, 'successfully') !== false ? 'green' : 'red' ?>">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <!-- Form to add a new judge with username and display name inputs -->
        <form method="POST" action="">
            <label for="username">Judge Username (unique):</label><br/>
            <input type="text" id="username" name="username" required /><br/><br/>

            <label for="display_name">Display Name:</label><br/>
            <input type="text" id="display_name" name="display_name" required /><br/><br/>

            <button type="submit">Add Judge</button>
        </form>

        <h2>Existing Judges</h2>
        <!-- Check if there are any judges to display -->
        <?php if (count($judges) === 0): ?>
            <p>No judges added yet.</p>
        <?php else: ?>
            <!-- List all existing judges with their display names and usernames -->
            <ul>
                <?php foreach ($judges as $j): ?>
                    <li><?= htmlspecialchars($j['display_name']) ?> (<?= htmlspecialchars($j['username']) ?>)</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
