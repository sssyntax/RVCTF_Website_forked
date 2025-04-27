<?php
require_once __DIR__ . "/includes/connect.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'notstarted') {
        date_default_timezone_set('Asia/Singapore'); // Force SG time
        $start_time = strtotime('2025-05-11 10:00:00');
        $end_time = $start_time + 5 * 3600; // 5 hours CTF duration
    } elseif ($action === 'running') {
        $start_time = time() - 300; // 5 minutes ago
        $end_time = time() + 5 * 3600; // 5 hours later
    } elseif ($action === 'ended') {
        $start_time = time() - 6 * 3600; // 6 hours ago
        $end_time = time() - 3600; // 1 hour ago
    } else {
        die("Invalid action.");
    }

    $stmt = $conn->prepare("UPDATE ctf_config SET start_time = ?, end_time = ? WHERE id = 1");
    $stmt->bind_param("ii", $start_time, $end_time);
    $stmt->execute();

    // Redirect back to admin panel
    header("Location: ../index.php?filename=adminPanel");
    exit;
} else {
    die("Invalid request.");
}
?>
