<?php
require_once '../config/db.php';
$stmt = $pdo->query("
    SELECT p.id, p.name, IFNULL(SUM(s.points), 0) AS total_points
    FROM participants p
    LEFT JOIN scores s ON p.id = s.participant_id
    GROUP BY p.id, p.name
    ORDER BY total_points DESC, p.name ASC
");
$participants = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Public Scoreboard</title>
    <link rel="stylesheet" href="assets/style.css" />
    <meta http-equiv="refresh" content="30"> 
</head>
<body>
    <div class="container">
        <h1>Public Scoreboard</h1>
        <table>
            <thead>
                <tr>
                    <th>Participant</th>
                    <th>Total Points</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $p): 
                    $points = (int)$p['total_points'];
                    $class = '';
                    if ($points >= 90) {
                        $class = 'highlight-green';
                    } elseif ($points >= 70) {
                        $class = 'highlight-yellow';
                    } elseif ($points > 0) {
                        $class = 'highlight-red';
                    }
                ?>
                <tr class="<?= $class ?>">
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= $points ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p style="text-align:center; font-size:12px; margin-top:15px;">Page auto-refreshes every 30 seconds</p>
    </div>
</body>
</html>
