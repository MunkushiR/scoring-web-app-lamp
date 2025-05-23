<?php
require_once '../config/db.php';

$message = '';
$judges = $pdo->query("SELECT * FROM judges ORDER BY display_name ASC")->fetchAll();
$participants = $pdo->query("SELECT * FROM participants ORDER BY name ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judge_id = (int)($_POST['judge_id'] ?? 0);
    $participant_id = (int)($_POST['participant_id'] ?? 0);
    $points = (int)($_POST['points'] ?? 0);

    $validJudge = $pdo->prepare("SELECT id FROM judges WHERE id = ?");
    $validJudge->execute([$judge_id]);
    $validJudge = $validJudge->fetch();

    $validParticipant = $pdo->prepare("SELECT id FROM participants WHERE id = ?");
    $validParticipant->execute([$participant_id]);
    $validParticipant = $validParticipant->fetch();

    if (!$validJudge) {
        $message = 'Invalid judge selected.';
    } elseif (!$validParticipant) {
        $message = 'Invalid participant selected.';
    } elseif ($points < 1 || $points > 100) {
        $message = 'Points must be between 1 and 100.';
    } else {
      
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

        <?php if ($message): ?>
            <p style="color: <?= strpos($message, 'successfully') !== false ? 'green' : 'red' ?>"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="judge_id">Select Judge:</label><br/>
            <select name="judge_id" id="judge_id" required>
                <option value="" disabled selected>-- Select Judge --</option>
                <?php foreach ($judges as $judge): ?>
                    <option value="<?= $judge['id'] ?>"><?= htmlspecialchars($judge['display_name']) ?> (<?= htmlspecialchars($judge['username']) ?>)</option>
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
