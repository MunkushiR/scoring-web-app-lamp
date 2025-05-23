<?php
require_once '../config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $display_name = trim($_POST['display_name'] ?? '');

    if ($username === '' || $display_name === '') {
        $message = 'Both fields are required.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM judges WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $message = 'Username already exists. Choose another.';
        } else {
            $insert = $pdo->prepare("INSERT INTO judges (username, display_name) VALUES (?, ?)");
            if ($insert->execute([$username, $display_name])) {
                $message = "Judge '{$display_name}' added successfully.";
            } else {
                $message = "Error adding judge.";
            }
        }
    }
}

$judges = $pdo->query("SELECT * FROM judges ORDER BY display_name ASC")->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Panel - Add Judges</title>
    <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
    <div class="container">
        <h1>Admin Panel - Add Judges</h1>

        <?php if ($message): ?>
            <p style="color: <?= strpos($message, 'successfully') !== false ? 'green' : 'red' ?>"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Judge Username (unique):</label><br/>
            <input type="text" id="username" name="username" required /><br/><br/>

            <label for="display_name">Display Name:</label><br/>
            <input type="text" id="display_name" name="display_name" required /><br/><br/>

            <button type="submit">Add Judge</button>
        </form>

        <h2>Existing Judges</h2>
        <?php if (count($judges) === 0): ?>
            <p>No judges added yet.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($judges as $j): ?>
                    <li><?= htmlspecialchars($j['display_name']) ?> (<?= htmlspecialchars($j['username']) ?>)</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
