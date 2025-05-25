<?php
// Include database connection from config
require_once '../config/db.php';

// Initialize message string to communicate success/error feedback to user
$message = '';

// Fetch all judges ordered by their display name for the dropdown
$judges = $pdo->query("SELECT * FROM judges ORDER BY display_name ASC")->fetchAll();

// Fetch all participants ordered by name for the dropdown
$participants = $pdo->query("SELECT * FROM participants ORDER BY name ASC")->fetchAll();

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs from POST, casting to integer
    $judge_id = (int)($_POST['judge_id'] ?? 0);
    $participant_id = (int)($_POST['participant_id'] ?? 0);
    $points = (int)($_POST['points'] ?? 0);

    // Validate that the judge ID exists in the judges table
    $validJudge = $pdo->prepare("SELECT id FROM judges WHERE id = ?");
    $validJudge->execute([$judge_id]);
    $validJudge = $validJudge->fetch();

    // Validate that the participant ID exists in the participants table
    $validParticipant = $pdo->prepare("SELECT id FROM participants WHERE id = ?");
    $validParticipant->execute([$participant_id]);
    $validParticipant = $validParticipant->fetch();

    // Validate inputs and provide relevant error messages
    if (!$validJudge) {
        $message = 'Invalid judge selected.';
    } elseif (!$validParticipant) {
        $message = 'Invalid participant selected.';
    } elseif ($points < 1 || $points > 100) {
        $message = 'Points must be between 1 and 100.';
    } else {
        // Insert the score into the scores table if all validations pass
        $stmt = $pdo->prepare("INSERT INTO scores (judge_id, participant_id, points) VALUES (?, ?, ?)");
        if ($stmt->execute([$judge_id, $participant_id, $points])) {
            $message = 'Score recorded successfully.';
        } else {
            $message = 'Error recording score.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Judge Scoring Portal</title>
    <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
    <div class="container">
        <h1>Judge Scoring Portal</h1>

        <!-- Display message to user, color-coded based on success or error -->
        <?php if ($message): ?>
            <p style="color: <?= strpos($message, 'successfully') !== false ? 'green' : 'red' ?>">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <!-- Form for judges to select themselves, a participant, and submit points -->
        <form method="POST" action="">
            <label for="judge_id">Select Judge:</label><br/>
            <select name="judge_id" id="judge_id" required>
                <option value="" disabled selected>-- Select Judge --</option>
                <?php foreach ($judges as $judge): ?>
                    <option value="<?= $judge['id'] ?>">
                        <?= htmlspecialchars($judge['display_name']) ?> (<?= htmlspecialchars($judge['username']) ?>)
                    </option>
                <?php endforeach; ?>
            </select><br/><br/>

            <label for="participant_id">Select Participant:</label><br/>
            <select name="participant_id" id="participant_id" required>
                <option value="" disabled selected>-- Select Participant --</option>
                <?php foreach ($participants as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                <?php endforeach; ?>
            </select><br/><br/>

            <label for="points">Points (1 to 100):</label><br/>
            <input type="number" name="points" id="points" min="1" max="100" required /><br/><br/>

            <button type="submit">Submit Score</button>
        </form>
    </div>
</body>
</html>
