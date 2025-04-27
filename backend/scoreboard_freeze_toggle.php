<?php
require_once __DIR__ . "/includes/connect.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'freeze') {
        // Manually force freeze
        $stmt = $conn->prepare("UPDATE ctf_config SET freeze_override = 1 WHERE id = 1");
        $stmt->execute();

        // Freeze everyone's points
        $sql = "
        UPDATE ctf_users u
        SET u.frozen_points = (
            SELECT IFNULL(SUM(c.points), 0)
            FROM completedchallenges uc
            JOIN challenges c ON uc.challenge_id = c.id
            WHERE uc.user_id = u.id
        )
        ";
        $conn->query($sql);

    } elseif ($action === 'unfreeze') {
        // Unfreeze
        $stmt = $conn->prepare("UPDATE ctf_config SET freeze_override = 0 WHERE id = 1");
        $stmt->execute();
    } else {
        die("Invalid action.");
    }

    header("Location: ../index.php?filename=adminPanel");
    exit;
} else {
    die("Invalid request.");
}
?>
